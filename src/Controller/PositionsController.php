<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Positions\AddService;
use App\Service\Positions\ViewService;
use App\Service\Positions\EditService;
use App\Service\Positions\DeleteService;
use App\Service\Positions\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class PositionsController extends AppController
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
        if (!$this->checkPermission('Positions/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Positions.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.base_salary AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Positions->find('all', [
            'conditions' => $conditions,
            'contain' => ['Collaborators'],
        ]);

        $positions = $this->paginate($query);

        $this->set(compact('positions'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Positions/index')) {
            return;
        }

        $id = (int)$id;

        $service = new ViewService($this->Positions);
        $position = $service->run($id);

        $this->set(compact('position'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Positions/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->Positions);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('position', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Positions/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->Positions);

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
        if (!$this->checkPermission('Positions/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->Positions);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Positions/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->Positions);
        return $service->run();
    }
}
