<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ItemTypes\AddService;
use App\Service\ItemTypes\ViewService;
use App\Service\ItemTypes\EditService;
use App\Service\ItemTypes\DeleteService;
use App\Service\ItemTypes\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class ItemTypesController extends AppController
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
        if (!$this->checkPermission('ItemTypes/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(ItemTypes.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemTypes.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemTypes.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemTypes.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemTypes.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemTypes.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->ItemTypes->find('all', [
            'conditions' => $conditions,
            'contain' => ['Items', 'ItemsFields'],
        ]);

        $itemTypes = $this->paginate($query);

        $this->set(compact('itemTypes'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('ItemTypes/index')) {
            return;
        }

        $id = (int)$id;

        $service = new ViewService($this->ItemTypes);
        $itemType = $service->run($id);

        $this->set(compact('itemType'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('ItemTypes/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->ItemTypes);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('itemType', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('ItemTypes/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->ItemTypes);

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
        if (!$this->checkPermission('ItemTypes/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->ItemTypes);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('ItemTypes/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->ItemTypes);
        return $service->run();
    }
}
