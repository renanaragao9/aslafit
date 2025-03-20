<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class MuscleGroupsController extends AppController
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
        if (!$this->checkPermission('MuscleGroups/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(MuscleGroups.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MuscleGroups.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MuscleGroups.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MuscleGroups.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MuscleGroups.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->MuscleGroups->find('all', [
            'conditions' => $conditions,
            'contain' => ['Exercises'],
        ]);

        $muscleGroups = $this->paginate($query);


        $this->set(compact('muscleGroups',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('MuscleGroups/index')) {
            return;
        }

        $muscleGroup = $this->MuscleGroups->get($id, [
            'contain' => ['Exercises'],
        ]);

        $this->set(compact('muscleGroup'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('MuscleGroups/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $muscleGroup = $this->MuscleGroups->newEmptyEntity();

        if ($this->request->is('post')) {

            $muscleGroup = $this->MuscleGroups->patchEntity($muscleGroup, $this->request->getData());

            if ($this->MuscleGroups->save($muscleGroup)) {
                $this->Flash->success(__('O muscle group foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O muscle group não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('muscleGroup'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('MuscleGroups/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $muscleGroup = $this->MuscleGroups->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $muscleGroup = $this->MuscleGroups->patchEntity($muscleGroup, $this->request->getData());

            if ($this->MuscleGroups->save($muscleGroup)) {
                $this->Flash->success(__('O muscle group foi editado com sucesso.'));
                $this->log('O muscle group foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O muscle group não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('muscleGroup'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('MuscleGroups/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $muscleGroup = $this->MuscleGroups->get($id);

        if ($this->MuscleGroups->delete($muscleGroup)) {
            $this->log('O muscle group foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O muscle group foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O muscle group não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('MuscleGroups/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $muscleGroups = $this->MuscleGroups->find('all', [
            'contain' => ['Exercises'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($muscleGroups as $MuscleGroups) {
            $csvData[] = [
                $MuscleGroups->id,
                $MuscleGroups->name,
                $MuscleGroups->active,
                $MuscleGroups->created,
                $MuscleGroups->modified
            ];
        }

        $filename = 'muscleGroups_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/MuscleGroupsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/muscleGroups
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class MuscleGroupsController extends AppController
        {
            public function fetchMuscleGroups(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->MuscleGroups->find('all')->toArray();
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

            public function fetchmuscleGroup($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->MuscleGroups->get($id);
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

            public function addMuscleGroups(): Response
            {
                $this->request->allowMethod(['post']);

                $muscleGroup = $this->MuscleGroups->newEmptyEntity();
                $muscleGroup = $this->MuscleGroups->patchEntity($muscleGroup, $this->request->getData());

                if ($this->MuscleGroups->save($muscleGroup)) {
                    $response = [
                        'status' => 'success',
                        'data' => $muscleGroup
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add muscle group'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editMuscleGroups($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $muscleGroup = $this->MuscleGroups->get($id);
                $muscleGroup = $this->MuscleGroups->patchEntity($muscleGroup, $this->request->getData());

                if ($this->MuscleGroups->save($muscleGroup)) {
                    $response = [
                        'status' => 'success',
                        'data' => $muscleGroup
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update muscle group'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteMuscleGroups($id): Response
            {
                $this->request->allowMethod(['delete']);

                $muscleGroup = $this->MuscleGroups->get($id);

                if ($this->MuscleGroups->delete($muscleGroup)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'muscle group deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete muscle group'
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
        # MuscleGroups routes template prefix API   

        # MuscleGroups routes API
        $routes->connect('/MuscleGroups', ['controller' => 'MuscleGroups', 'action' => 'fetchMuscleGroups', 'method' => 'GET']);
        $routes->connect('/MuscleGroups/:id', ['controller' => 'MuscleGroups', 'action' => 'fetchmuscleGroup', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/MuscleGroups-add', ['controller' => 'MuscleGroups', 'action' => 'addMuscleGroups', 'method' => 'POST']);
        $routes->connect('/MuscleGroups-edit/:id', ['controller' => 'MuscleGroups', 'action' => 'editMuscleGroups', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/MuscleGroups-delete/:id', ['controller' => 'MuscleGroups', 'action' => 'deleteMuscleGroups', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # muscleGroups routes simple template prefix /
        
        # muscleGroups routes
        $routes->connect('/MuscleGroups', ['controller' => 'MuscleGroups', 'action' => 'index']);
        $routes->connect('/MuscleGroups/view/:id', ['controller' => 'MuscleGroups', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
