<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\StorageLocations\AddService;
use App\Service\StorageLocations\ViewService;
use App\Service\StorageLocations\EditService;
use App\Service\StorageLocations\DeleteService;
use App\Service\StorageLocations\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class StorageLocationsController extends AppController
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
        if (!$this->checkPermission('StorageLocations/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(StorageLocations.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StorageLocations.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StorageLocations.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StorageLocations.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StorageLocations.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StorageLocations.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->StorageLocations->find('all', [
            'conditions' => $conditions,
            'contain' => ['Items'],
        ]);

        $storageLocations = $this->paginate($query);

        $this->set(compact('storageLocations'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('StorageLocations/index')) {
            return;
        }

        $id = (int)$id;

        $service = new ViewService($this->StorageLocations);
        $storageLocation = $service->run($id);

        $this->set(compact('storageLocation'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('StorageLocations/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->StorageLocations);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('storageLocation', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('StorageLocations/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->StorageLocations);

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
        if (!$this->checkPermission('StorageLocations/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->StorageLocations);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('StorageLocations/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->StorageLocations);
        return $service->run();
    }
}
