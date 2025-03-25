<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Exercises\AddService;
use App\Service\Exercises\ViewService;
use App\Service\Exercises\EditService;
use App\Service\Exercises\DeleteService;
use App\Service\Exercises\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class ExercisesController extends AppController
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
        if (!$this->checkPermission('Exercises/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $equipment_id = $this->request->getQuery('equipment_id');
        $muscle_group_id = $this->request->getQuery('muscle_group_id');

        $conditions = [];

        if ($search) {
            $conditions['Exercises.name LIKE'] = '%' . $search . '%';
        }

        if ($equipment_id) {
            $conditions['Exercises.equipment_id'] = $equipment_id;
        }

        if ($muscle_group_id) {
            $conditions['Exercises.muscle_group_id'] = $muscle_group_id;
        }

        $query = $this->Exercises->find('all', [
            'conditions' => $conditions,
            'contain' => ['Equipments', 'MuscleGroups', 'ExerciseTrainingDivision'],
        ]);

        $exercises = $this->paginate($query);

        $equipments = $this->Exercises->Equipments->find('list', ['limit' => 200])->orderAsc('name')->all();
        $muscleGroups = $this->Exercises->MuscleGroups->find('list', ['limit' => 200])->orderAsc('name')->all();

        $this->set(compact('exercises', 'equipments', 'muscleGroups'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Exercises/index')) {
            return;
        }

        $id = (int)$id;

        $service = new ViewService($this->Exercises);
        $exercise = $service->run($id);

        $this->set(compact('exercise'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Exercises/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->Exercises);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('exercise', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Exercises/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->Exercises);

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
        if (!$this->checkPermission('Exercises/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->Exercises);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Exercises/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->Exercises);
        return $service->run();
    }
}
