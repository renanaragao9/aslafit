<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\DietPlans\AddService;
use App\Service\DietPlans\ViewService;
use App\Service\DietPlans\EditService;
use App\Service\DietPlans\DeleteService;
use App\Service\DietPlans\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class DietPlansController extends AppController
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
        if (!$this->checkPermission('DietPlans/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $ficha_id = $this->request->getQuery('ficha_id');
        $meal_type_id = $this->request->getQuery('meal_type_id');
        $food_id = $this->request->getQuery('food_id');

        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(DietPlans.id AS CHAR) LIKE' => '%' . $search . '%',
                    'Foods.name LIKE' => '%' . $search . '%',
                    'MealTypes.name LIKE' => '%' . $search . '%',
                    'Students.name LIKE' => '%' . $search . '%',
                    'CAST(DietPlans.ficha_id AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        if ($ficha_id) {
            $conditions['DietPlans.ficha_id'] = $ficha_id;
        }

        if ($meal_type_id) {
            $conditions['DietPlans.meal_type_id'] = $meal_type_id;
        }

        if ($food_id) {
            $conditions['DietPlans.food_id'] = $food_id;
        }

        $query = $this->DietPlans->find('all', [
            'conditions' => $conditions,
            'contain' => ['MealTypes', 'Foods', 'Fichas.Students'],
        ]);

        $dietPlans = $this->paginate($query);

        $mealTypes = $this->DietPlans->MealTypes->find('list', ['limit' => 200])->all();
        $foods = $this->DietPlans->Foods->find('list', ['limit' => 200])->all();
        $fichas = $this->DietPlans->Fichas->find('list', [
            'keyField' => 'id',
            'valueField' => function ($ficha) {
                return $ficha->student->name;
            }
        ])
            ->where(['Fichas.active' => 1])
            ->contain(['Students']);

        $this->set(compact('dietPlans', 'mealTypes', 'foods', 'fichas'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('DietPlans/index')) {
            return;
        }

        $service = new ViewService($this->DietPlans);
        $dietPlan = $service->run((int)$id);

        $this->set(compact('dietPlan'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('DietPlans/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->DietPlans);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('dietPlan', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('DietPlans/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->DietPlans);

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
        if (!$this->checkPermission('DietPlans/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->DietPlans);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('DietPlans/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->DietPlans);
        return $service->run();
    }
}
