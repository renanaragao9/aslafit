<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\WorkLogs\AddService;
use App\Service\WorkLogs\ViewService;
use App\Service\WorkLogs\EditService;
use App\Service\WorkLogs\DeleteService;
use App\Service\WorkLogs\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class WorkLogsController extends AppController
{
    private $identity;

    public function initialize(): void
    {
        parent::initialize();
        $this->identity = $this->request->getSession()->read('Auth.User.id');
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
        if (!$this->checkPermission('WorkLogs/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(WorkLogs.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.collaborator_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.log_date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.log_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.log_time AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.log_address AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.latitude AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.longitude AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->WorkLogs->find('all', [
            'conditions' => $conditions,
            'contain' => ['Collaborators'],
        ]);

        $workLogs = $this->paginate($query);

        $collaborators = $this->WorkLogs->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('workLogs', 'collaborators'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('WorkLogs/index')) {
            return;
        }

        $id = (int)$id;

        $service = new ViewService($this->WorkLogs);
        $workLog = $service->run($id);

        $this->set(compact('workLog'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('WorkLogs/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->WorkLogs);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('workLog', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('WorkLogs/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->WorkLogs);

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
        if (!$this->checkPermission('WorkLogs/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->WorkLogs);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('WorkLogs/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->WorkLogs);
        return $service->run();
    }
}
