<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\DietPlans\AddService;
use App\Service\DietPlans\CreateService;
use App\Service\DietPlans\ViewService;
use App\Service\DietPlans\EditService;
use App\Service\DietPlans\DeleteService;
use App\Service\DietPlans\ExportService;
use App\Service\DietPlans\UpdateService;
use Cake\Datasource\Exception\RecordNotFoundException;
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

    public function create(?int $fichaId = null): ?Response
    {
        if (!$this->checkPermission('DietPlans/add')) {
            return $this->redirect(['action' => 'add']);
        }

        $service = new CreateService($this->DietPlans);

        if ($this->request->is('post')) {
            $mealsData = json_decode($this->request->getData('meals'), true);

            if (empty($mealsData)) {
                $this->Flash->error('Nenhum alimento selecionado para salvar.');
                return $this->redirect($this->referer());
            }

            $result = $service->run($mealsData, $fichaId);

            if ($result['success']) {
                $this->Flash->success($result['message']);
                return $this->redirect(['controller' => 'Fichas', 'action' => 'view', $result['fichaId']]);
            } else {
                $this->Flash->error($result['message']);
                return $this->redirect($this->referer());
            }
        }

        $ficha = $this->DietPlans->Fichas->get($fichaId, [
            'contain' => ['Students']
        ]);

        $this->set('ficha', $ficha);
        $this->set('dietPlan', $service->getNewEntity());

        $this->set($service->getViewData());
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

    public function update(?int $fichaId = null): ?Response
    {
        if (!$this->checkPermission('DietPlans/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new UpdateService($this->DietPlans);

        if ($this->request->is(['post', 'put'])) {
            $mealsData = json_decode($this->request->getData('meals'), true);

            if (empty($mealsData)) {
                $this->Flash->error('Nenhum alimento selecionado para atualizar.');
                return $this->redirect($this->referer());
            }

            $result = $service->run($mealsData, $fichaId);

            if ($result['success']) {
                $this->Flash->success($result['message']);
                return $this->redirect(['controller' => 'Fichas', 'action' => 'view', $result['fichaId']]);
            } else {
                $this->Flash->error($result['message']);
                return $this->redirect($this->referer());
            }
        }

        try {
            $ficha = $this->DietPlans->Fichas->get($fichaId, [
                'contain' => ['Students', 'DietPlans' => ['Foods', 'MealTypes']]
            ]);
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Ficha não encontrada.');
            return $this->redirect(['controller' => 'Fichas', 'action' => 'index']);
        }

        $existingMeals = [];
        foreach ($ficha->diet_plans as $dp) {
            $existingMeals[] = [
                'id' => $dp->food_id,
                'name' => $dp->food->name,
                'food_data[meal_type_id]' => $dp->meal_type_id,
                'food_data[description]' => $dp->description,
            ];
        }

        $this->set(compact('ficha', 'existingMeals'));
        $this->set($service->getViewData());

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
