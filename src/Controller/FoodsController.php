<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Foods\AddService;
use App\Service\Foods\ViewService;
use App\Service\Foods\EditService;
use App\Service\Foods\DeleteService;
use App\Service\Foods\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class FoodsController extends AppController
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
        if (!$this->checkPermission('Foods/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Foods.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Foods.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FoodTypes.name AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Foods->find('all', [
            'conditions' => $conditions,
            'contain' => ['DietPlans', 'FoodTypes'],
        ]);

        $foods = $this->paginate($query);

        $foodTypes = $this->Foods->FoodTypes->find('list', [
            'limit' => 200,
            'order' => ['name' => 'ASC']
        ])->all();

        $this->set(compact('foods', 'foodTypes'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Foods/index')) {
            return;
        }

        $id = (int)$id;
        $service = new ViewService($this->Foods);
        $food = $service->run($id);

        $this->set(compact('food'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Foods/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->Foods);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('food', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Foods/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->Foods);

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
        if (!$this->checkPermission('Foods/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->Foods);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Foods/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->Foods);
        return $service->run();
    }
}
