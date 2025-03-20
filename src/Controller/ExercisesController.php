<?php

declare(strict_types=1);

namespace App\Controller;

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
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Exercises.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Exercises.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Exercises.image AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Exercises.gif AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Exercises.link AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Exercises.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Exercises.equipment_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Exercises.muscle_group_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Exercises.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Exercises.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Exercises->find('all', [
            'conditions' => $conditions,
            'contain' => ['Equipments', 'MuscleGroups', 'ExerciseTrainingDivision'],
        ]);

        $exercises = $this->paginate($query);

        $equipments = $this->Exercises->Equipments->find('list', ['limit' => 200])->all();
        $muscleGroups = $this->Exercises->MuscleGroups->find('list', ['limit' => 200])->all();

        $this->set(compact('exercises', 'equipments', 'muscleGroups'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Exercises/index')) {
            return;
        }

        $exercise = $this->Exercises->get($id, [
            'contain' => ['Equipments', 'MuscleGroups', 'ExerciseTrainingDivision'],
        ]);

        $this->set(compact('exercise'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Exercises/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $exercise = $this->Exercises->newEmptyEntity();

        if ($this->request->is('post')) {

            $exercise = $this->Exercises->patchEntity($exercise, $this->request->getData());

            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('O exercise foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O exercise não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $equipments = $this->Exercises->Equipments->find('list', ['limit' => 200])->all();
        $muscleGroups = $this->Exercises->MuscleGroups->find('list', ['limit' => 200])->all();

        $this->set(compact('exercise', 'equipments', 'muscleGroups'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Exercises/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $exercise = $this->Exercises->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $exercise = $this->Exercises->patchEntity($exercise, $this->request->getData());

            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('O exercise foi editado com sucesso.'));
                $this->log('O exercise foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O exercise não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $equipments = $this->Exercises->Equipments->find('list', ['limit' => 200])->all();
        $muscleGroups = $this->Exercises->MuscleGroups->find('list', ['limit' => 200])->all();

        $this->set(compact('exercise', 'equipments', 'muscleGroups'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Exercises/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $exercise = $this->Exercises->get($id);

        if ($this->Exercises->delete($exercise)) {
            $this->log('O exercise foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O exercise foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O exercise não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Exercises/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $exercises = $this->Exercises->find('all', [
            'contain' => ['Equipments', 'MuscleGroups', 'ExerciseTrainingDivision'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'image', 'gif', 'link', 'active', 'equipment_id', 'muscle_group_id', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($exercises as $Exercises) {
            $csvData[] = [
                $Exercises->id,
                $Exercises->name,
                $Exercises->image,
                $Exercises->gif,
                $Exercises->link,
                $Exercises->active,
                $Exercises->equipment_id,
                $Exercises->muscle_group_id,
                $Exercises->created,
                $Exercises->modified
            ];
        }

        $filename = 'exercises_' . date('Y-m-d_H-i-s') . '.csv';
        $filePath = TMP . $filename;

        $file = fopen($filePath, 'w');
        foreach ($csvData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);

        $response = $this->response->withFile(
            $filePath,
            ['download' => true, 'name' => $filename]
        );

        return $response;
    }

    /*
        # Controller API Template
        # Path: src/Controllers/API/ExercisesController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/exercises
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class ExercisesController extends AppController
        {
            public function fetchExercises(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Exercises->find('all')->toArray();
                    $response = [
                        'status' => 'success',
                        'data' => $data
                    ];
                } catch (\Exception $e) {
                    $response = [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ];
                }
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function fetchexercise($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Exercises->get($id);
                    $response = [
                        'status' => 'success',
                        'data' => $data
                    ];
                } catch (\Exception $e) {
                    $response = [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ];
                }
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function addExercises(): Response
            {
                $this->request->allowMethod(['post']);

                $exercise = $this->Exercises->newEmptyEntity();
                $exercise = $this->Exercises->patchEntity($exercise, $this->request->getData());

                if ($this->Exercises->save($exercise)) {
                    $response = [
                        'status' => 'success',
                        'data' => $exercise
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add exercise'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editExercises($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $exercise = $this->Exercises->get($id);
                $exercise = $this->Exercises->patchEntity($exercise, $this->request->getData());

                if ($this->Exercises->save($exercise)) {
                    $response = [
                        'status' => 'success',
                        'data' => $exercise
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update exercise'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteExercises($id): Response
            {
                $this->request->allowMethod(['delete']);

                $exercise = $this->Exercises->get($id);

                if ($this->Exercises->delete($exercise)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'exercise deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete exercise'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }
        }
    */

    /*
        # Rotas API Template
        # Path: src/Config/routes.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
    */

    /*
        # Exercises routes template prefix API   

        # Exercises routes API
        $routes->connect('/Exercises', ['controller' => 'Exercises', 'action' => 'fetchExercises', 'method' => 'GET']);
        $routes->connect('/Exercises/:id', ['controller' => 'Exercises', 'action' => 'fetchexercise', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Exercises-add', ['controller' => 'Exercises', 'action' => 'addExercises', 'method' => 'POST']);
        $routes->connect('/Exercises-edit/:id', ['controller' => 'Exercises', 'action' => 'editExercises', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Exercises-delete/:id', ['controller' => 'Exercises', 'action' => 'deleteExercises', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # exercises routes simple template prefix /
        
        # exercises routes
        $routes->connect('/Exercises', ['controller' => 'Exercises', 'action' => 'index']);
        $routes->connect('/Exercises/view/:id', ['controller' => 'Exercises', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
