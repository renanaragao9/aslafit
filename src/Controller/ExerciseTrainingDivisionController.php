<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ExerciseTrainingDivision\AddService;
use App\Service\ExerciseTrainingDivision\CreateService;
use App\Service\ExerciseTrainingDivision\ViewService;
use App\Service\ExerciseTrainingDivision\EditService;
use App\Service\ExerciseTrainingDivision\DeleteService;
use App\Service\ExerciseTrainingDivision\ExportService;
use App\Service\ExerciseTrainingDivision\UpdateService;
use App\Utility\AccessChecker;
use Cake\Http\Response;
use Cake\Datasource\Exception\RecordNotFoundException;

class ExerciseTrainingDivisionController extends AppController
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
        if (!$this->checkPermission('ExerciseTrainingDivision/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $ficha_id = $this->request->getQuery('ficha_id');
        $exercise_id = $this->request->getQuery('exercise_id');
        $training_division_id = $this->request->getQuery('training_division_id');

        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(ExerciseTrainingDivision.id AS CHAR) LIKE' => '%' . $search . '%',
                    'Students.name LIKE' => '%' . $search . '%',
                ],
            ];
        }

        foreach (['ficha_id', 'exercise_id', 'training_division_id'] as $field) {
            $value = $this->request->getQuery($field);
            if ($value) {
                $conditions["ExerciseTrainingDivision.$field"] = $value;
            }
        }

        $query = $this->ExerciseTrainingDivision->find('all', [
            'conditions' => $conditions,
            'contain' => ['Fichas.Students', 'Exercises', 'TrainingDivisions'],
        ]);

        $exerciseTrainingDivision = $this->paginate($query);

        $fichas = $this->ExerciseTrainingDivision->Fichas->find('list', [
            'keyField' => 'id',
            'valueField' => function ($ficha) {
                return $ficha->student->name;
            }
        ])
            ->where(['Fichas.active' => 1])
            ->contain(['Students']);
        $exercises = $this->ExerciseTrainingDivision->Exercises->find('list', [
            'limit' => 200,
            'order' => ['name' => 'ASC']
        ])->all();
        $trainingDivisions = $this->ExerciseTrainingDivision->TrainingDivisions->find('list', [
            'limit' => 200,
            'order' => ['name' => 'ASC']
        ])->all();

        $this->set(compact('exerciseTrainingDivision', 'fichas', 'exercises', 'trainingDivisions'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/index')) {
            return;
        }

        $service = new ViewService($this->ExerciseTrainingDivision);
        $exerciseTrainingDivision = $service->run((int)$id);

        $this->set(compact('exerciseTrainingDivision'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->ExerciseTrainingDivision);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('exerciseTrainingDivision', $service->getNewEntity());
        return null;
    }

    public function create(?int $fichaId = null): ?Response
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new CreateService($this->ExerciseTrainingDivision);

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $exercises = json_decode($data['exercises'], true) ?? [];

            $result = $service->run([
                'ficha_id' => $fichaId,
                'exercises' => $exercises,
            ]);

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);

            return $this->redirect(['controller' => 'Fichas', 'action' => 'view', $fichaId]);
        }


        $ficha = $this->ExerciseTrainingDivision->Fichas->get($fichaId, [
            'contain' => ['Students']
        ]);

        $this->set('ficha', $ficha);

        $this->set($service->getViewData());

        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->ExerciseTrainingDivision);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = $service->run($id, $this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['controller' => 'Fichas', 'action' => 'view', $fichaId]);
        }

        $this->set($service->getEditData($id));
        return null;
    }

    public function update(?int $fichaId = null): ?Response
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new UpdateService($this->ExerciseTrainingDivision);

        if ($this->request->is(['post', 'put'])) {
            $exerciseData = json_decode($this->request->getData('exercises'), true);

            if (empty($exerciseData)) {
                $this->Flash->error('Nenhum exercício selecionado para atualizar.');
                return $this->redirect($this->referer());
            }

            $result = $service->run($exerciseData, $fichaId);

            if ($result['success']) {
                $this->Flash->success($result['message']);
                return $this->redirect(['controller' => 'Fichas', 'action' => 'view', $fichaId]);
            } else {
                $this->Flash->error($result['message']);
                return $this->redirect($this->referer());
            }
        }

        $ficha = $this->ExerciseTrainingDivision->Fichas->get($fichaId, [
            'contain' => [
                'Students',
                'ExerciseTrainingDivision' => ['Exercises', 'TrainingDivisions']
            ]
        ]);

        $existingExercises = $service->getExistingExercises($fichaId);

        $this->set(compact('ficha', 'existingExercises'));
        $this->set($service->getViewData());

        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->ExerciseTrainingDivision);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->ExerciseTrainingDivision);
        return $service->run();
    }
}
