<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

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
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(ExerciseTrainingDivision.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.order AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.series AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.repetitions AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.weight AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.rest AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.ficha_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.exercise_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.training_division_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExerciseTrainingDivision.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->ExerciseTrainingDivision->find('all', [
            'conditions' => $conditions,
            'contain' => ['Fichas', 'Exercises', 'TrainingDivisions'],
        ]);

        $exerciseTrainingDivision = $this->paginate($query);

        $fichas = $this->ExerciseTrainingDivision->Fichas->find('list', ['limit' => 200])->all();
        $exercises = $this->ExerciseTrainingDivision->Exercises->find('list', ['limit' => 200])->all();
        $trainingDivisions = $this->ExerciseTrainingDivision->TrainingDivisions->find('list', ['limit' => 200])->all();

        $this->set(compact('exerciseTrainingDivision', 'fichas', 'exercises', 'trainingDivisions'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/index')) {
            return;
        }

        $exerciseTrainingDivision = $this->ExerciseTrainingDivision->get($id, [
            'contain' => ['Fichas', 'Exercises', 'TrainingDivisions'],
        ]);

        $this->set(compact('exerciseTrainingDivision'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $exerciseTrainingDivision = $this->ExerciseTrainingDivision->newEmptyEntity();

        if ($this->request->is('post')) {

            $exerciseTrainingDivision = $this->ExerciseTrainingDivision->patchEntity($exerciseTrainingDivision, $this->request->getData());

            if ($this->ExerciseTrainingDivision->save($exerciseTrainingDivision)) {
                $this->Flash->success(__('O exercise training division foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O exercise training division não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $fichas = $this->ExerciseTrainingDivision->Fichas->find('list', ['limit' => 200])->all();
        $exercises = $this->ExerciseTrainingDivision->Exercises->find('list', ['limit' => 200])->all();
        $trainingDivisions = $this->ExerciseTrainingDivision->TrainingDivisions->find('list', ['limit' => 200])->all();

        $this->set(compact('exerciseTrainingDivision', 'fichas', 'exercises', 'trainingDivisions'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $exerciseTrainingDivision = $this->ExerciseTrainingDivision->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $exerciseTrainingDivision = $this->ExerciseTrainingDivision->patchEntity($exerciseTrainingDivision, $this->request->getData());

            if ($this->ExerciseTrainingDivision->save($exerciseTrainingDivision)) {
                $this->Flash->success(__('O exercise training division foi editado com sucesso.'));
                $this->log('O exercise training division foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O exercise training division não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $fichas = $this->ExerciseTrainingDivision->Fichas->find('list', ['limit' => 200])->all();
        $exercises = $this->ExerciseTrainingDivision->Exercises->find('list', ['limit' => 200])->all();
        $trainingDivisions = $this->ExerciseTrainingDivision->TrainingDivisions->find('list', ['limit' => 200])->all();

        $this->set(compact('exerciseTrainingDivision', 'fichas', 'exercises', 'trainingDivisions'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $exerciseTrainingDivision = $this->ExerciseTrainingDivision->get($id);

        if ($this->ExerciseTrainingDivision->delete($exerciseTrainingDivision)) {
            $this->log('O exercise training division foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O exercise training division foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O exercise training division não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('ExerciseTrainingDivision/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $exerciseTrainingDivision = $this->ExerciseTrainingDivision->find('all', [
            'contain' => ['Fichas', 'Exercises', 'TrainingDivisions'],
        ]);

        $csvData = [];
        $header = ['id', 'order', 'series', 'repetitions', 'weight', 'rest', 'description', 'ficha_id', 'exercise_id', 'training_division_id', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($exerciseTrainingDivision as $ExerciseTrainingDivision) {
            $csvData[] = [
                $ExerciseTrainingDivision->id,
                $ExerciseTrainingDivision->order,
                $ExerciseTrainingDivision->series,
                $ExerciseTrainingDivision->repetitions,
                $ExerciseTrainingDivision->weight,
                $ExerciseTrainingDivision->rest,
                $ExerciseTrainingDivision->description,
                $ExerciseTrainingDivision->ficha_id,
                $ExerciseTrainingDivision->exercise_id,
                $ExerciseTrainingDivision->training_division_id,
                $ExerciseTrainingDivision->active,
                $ExerciseTrainingDivision->created,
                $ExerciseTrainingDivision->modified
            ];
        }

        $filename = 'exerciseTrainingDivision_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/ExerciseTrainingDivisionController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/exerciseTrainingDivision
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class ExerciseTrainingDivisionController extends AppController
        {
            public function fetchExerciseTrainingDivision(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ExerciseTrainingDivision->find('all')->toArray();
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

            public function fetchexerciseTrainingDivision($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ExerciseTrainingDivision->get($id);
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

            public function addExerciseTrainingDivision(): Response
            {
                $this->request->allowMethod(['post']);

                $exerciseTrainingDivision = $this->ExerciseTrainingDivision->newEmptyEntity();
                $exerciseTrainingDivision = $this->ExerciseTrainingDivision->patchEntity($exerciseTrainingDivision, $this->request->getData());

                if ($this->ExerciseTrainingDivision->save($exerciseTrainingDivision)) {
                    $response = [
                        'status' => 'success',
                        'data' => $exerciseTrainingDivision
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add exercise training division'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editExerciseTrainingDivision($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $exerciseTrainingDivision = $this->ExerciseTrainingDivision->get($id);
                $exerciseTrainingDivision = $this->ExerciseTrainingDivision->patchEntity($exerciseTrainingDivision, $this->request->getData());

                if ($this->ExerciseTrainingDivision->save($exerciseTrainingDivision)) {
                    $response = [
                        'status' => 'success',
                        'data' => $exerciseTrainingDivision
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update exercise training division'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteExerciseTrainingDivision($id): Response
            {
                $this->request->allowMethod(['delete']);

                $exerciseTrainingDivision = $this->ExerciseTrainingDivision->get($id);

                if ($this->ExerciseTrainingDivision->delete($exerciseTrainingDivision)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'exercise training division deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete exercise training division'
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
        # ExerciseTrainingDivision routes template prefix API   

        # ExerciseTrainingDivision routes API
        $routes->connect('/ExerciseTrainingDivision', ['controller' => 'ExerciseTrainingDivision', 'action' => 'fetchExerciseTrainingDivision', 'method' => 'GET']);
        $routes->connect('/ExerciseTrainingDivision/:id', ['controller' => 'ExerciseTrainingDivision', 'action' => 'fetchexerciseTrainingDivision', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ExerciseTrainingDivision-add', ['controller' => 'ExerciseTrainingDivision', 'action' => 'addExerciseTrainingDivision', 'method' => 'POST']);
        $routes->connect('/ExerciseTrainingDivision-edit/:id', ['controller' => 'ExerciseTrainingDivision', 'action' => 'editExerciseTrainingDivision', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ExerciseTrainingDivision-delete/:id', ['controller' => 'ExerciseTrainingDivision', 'action' => 'deleteExerciseTrainingDivision', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # exerciseTrainingDivision routes simple template prefix /
        
        # exerciseTrainingDivision routes
        $routes->connect('/ExerciseTrainingDivision', ['controller' => 'ExerciseTrainingDivision', 'action' => 'index']);
        $routes->connect('/ExerciseTrainingDivision/view/:id', ['controller' => 'ExerciseTrainingDivision', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
