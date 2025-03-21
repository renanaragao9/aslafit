<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Equipments\AddService;
use App\Service\Equipments\ViewService;
use App\Service\Equipments\EditService;
use App\Service\Equipments\DeleteService;
use App\Service\Equipments\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class EquipmentsController extends AppController
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
        if (!$this->checkPermission('equipments/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Equipments.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Equipments.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Equipments.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Equipments.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Equipments.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Equipments->find('all', [
            'conditions' => $conditions,
            'contain' => ['Exercises'],
        ]);

        $equipments = $this->paginate($query);

        $this->set(compact('equipments'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('equipments/index')) {
            return;
        }

        $id = (int)$id;
        $service = new ViewService($this->Equipments);
        $equipment = $service->run($id);

        $this->set(compact('equipment'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('equipments/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->Equipments);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('equipment', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('equipments/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->Equipments);

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
        if (!$this->checkPermission('equipments/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->Equipments);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('equipments/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->Equipments);
        return $service->run();
    }
}
