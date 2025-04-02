<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\FoodTypes\AddService;
use App\Service\FoodTypes\ViewService;
use App\Service\FoodTypes\EditService;
use App\Service\FoodTypes\DeleteService;
use App\Service\FoodTypes\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class FoodTypesController extends AppController
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
        if (!$this->checkPermission('FoodTypes/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(FoodTypes.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FoodTypes.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FoodTypes.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FoodTypes.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FoodTypes.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FoodTypes.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->FoodTypes->find('all', [
            'conditions' => $conditions,
            'contain' => ['Foods'],
        ]);

        $foodTypes = $this->paginate($query);

        $this->set(compact('foodTypes'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('FoodTypes/index')) {
            return;
        }

        $service = new ViewService($this->FoodTypes);
        $foodType = $service->run((int)$id);

        $this->set(compact('foodType'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('FoodTypes/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->FoodTypes);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('foodType', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('FoodTypes/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->FoodTypes);

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
        if (!$this->checkPermission('FoodTypes/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->FoodTypes);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('FoodTypes/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->FoodTypes);
        return $service->run();
    }
}
