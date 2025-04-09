<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Collaborators\AddService;
use App\Service\Collaborators\ViewService;
use App\Service\Collaborators\EditService;
use App\Service\Collaborators\DeleteService;
use App\Service\Collaborators\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class CollaboratorsController extends AppController
{
    private $identity;

    public function initialize(): void
    {
        parent::initialize();
        $this->identity = $this->request->getSession()->read('Auth.User.id');
        $this->loadModel('Roles');
    }

    private function checkPermission(string $permission): bool
    {
        if (!$this->identity || !AccessChecker::hasPermission($this->identity, $permission)) {
            $this->Flash->error('Você não tem permissão para acessar esta área.');
            $this->redirect('/');
            return false;
        }
        return true;
    }

    public function index(): void
    {
        if (!$this->checkPermission('Collaborators/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $position_id = $this->request->getQuery('position_id');

        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Collaborators.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.entry_date AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        if ($position_id) {
            $conditions['Collaborators.position_id'] = $position_id;
        }

        $query = $this->Collaborators->find('all', [
            'conditions' => $conditions,
            'contain' => ['Positions', 'Users', 'Calleds', 'Events', 'Medias', 'MonthlyPlans', 'WorkLogs'],
        ]);

        $collaborators = $this->paginate($query);

        $positions = $this->Collaborators->Positions->find('list', ['limit' => 200])->all();
        $roles = $this->Collaborators->Users->Roles->find('list', ['limit' => 200])->all();
        $users = $this->Collaborators->Users->find('list', ['limit' => 200])->all();
        $roles = $this->Roles->find('list', ['limit' => 200])->all();

        $this->set(compact('collaborators', 'positions', 'users', 'roles'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Collaborators/index')) {
            return;
        }

        $id = (int)$id;

        $service = new ViewService($this->Collaborators);
        $collaborator = $service->run($id);

        $this->set(compact('collaborator'));
    }

    public function add()
    {
        $collaboratorsTable = $this->getTableLocator()->get('Collaborators');
        $usersTable = $this->getTableLocator()->get('Users');

        $addService = new AddService($collaboratorsTable, $usersTable);

        $data = $this->request->getData();
        $result = $addService->run($data);

        if ($result['success']) {
            $this->Flash->success($result['message']);
        } else {
            $this->Flash->error($result['message']);
        }

        return $this->redirect(['action' => 'index']);
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Collaborators/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->Collaborators);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = $service->run($id, $this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set($service->getEditData($id));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Collaborators/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->Collaborators);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Collaborators/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->Collaborators);
        return $service->run();
    }
}
