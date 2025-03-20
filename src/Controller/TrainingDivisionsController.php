<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

/*
    # Permissoes de acesso TrainingDivisionsController
    # Copie o conteudo e cole no arquivo de permissoes de acesso
    # Arquivo de permissoes de acesso: config/Seeds/PermissionsSeed.php

    #***** ATENÇÃO *****#
    # Caso já tenha o sistema em produção, vá no sistema em Cadastros -> Perfis -> Administrador -> View e adicione as permissões manualmente
*/

/*
    
*/

class TrainingDivisionsController extends AppController
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
    if (!$this->checkPermission('TrainingDivisions/index')) {
        return;
    }

    $search = $this->request->getQuery('search');
    $conditions = [];

    if ($search) {
        $conditions = [
            'OR' => [
                                    'CAST(TrainingDivisions.id AS CHAR) LIKE' => '%' . $search . '%',
                                    'CAST(TrainingDivisions.name AS CHAR) LIKE' => '%' . $search . '%',
                                    'CAST(TrainingDivisions.active AS CHAR) LIKE' => '%' . $search . '%',
                                    'CAST(TrainingDivisions.created AS CHAR) LIKE' => '%' . $search . '%',
                                    'CAST(TrainingDivisions.modified AS CHAR) LIKE' => '%' . $search . '%',
                            ],
        ];
    }

    $query = $this->TrainingDivisions->find('all', [
        'conditions' => $conditions,
        'contain' => ['ExerciseTrainingDivision'],
    ]);

    $trainingDivisions = $this->paginate($query);

            
    $this->set(compact('trainingDivisions', ));
}

public function view($id = null)
{
    if (!$this->checkPermission('TrainingDivisions/index')) {
        return;
    }
    
    $trainingDivision = $this->TrainingDivisions->get($id, [
        'contain' => ['ExerciseTrainingDivision'],
    ]);

    $this->set(compact('trainingDivision'));
}

public function add(): ?Response
{
    if (!$this->checkPermission('TrainingDivisions/add')) {
        return $this->redirect(['action' => 'index']);
    }

    $trainingDivision = $this->TrainingDivisions->newEmptyEntity();
    
    if ($this->request->is('post')) {
        
        $trainingDivision = $this->TrainingDivisions->patchEntity($trainingDivision, $this->request->getData());
        
        if ($this->TrainingDivisions->save($trainingDivision)) {
            $this->Flash->success(__('O training division foi salvo com sucesso.'));
            return $this->redirect(['action' => 'index']);
        }
        else {
            $this->Flash->error(__('O training division não pode ser salvo. Por favor, tente novamente.'));            
            return $this->redirect(['action' => 'index']);
        }
    }
    
    $this->set(compact('trainingDivision'));
    return null;
}

public function edit(?int $id = null): ?Response
{
    if (!$this->checkPermission('TrainingDivisions/edit')) {
        return $this->redirect(['action' => 'index']);
    }

    $trainingDivision = $this->TrainingDivisions->get($id, [
        'contain' => [],
    ]);
    
    if ($this->request->is(['patch', 'post', 'put'])) {
        
        $trainingDivision = $this->TrainingDivisions->patchEntity($trainingDivision, $this->request->getData());
        
        if ($this->TrainingDivisions->save($trainingDivision)) {
            $this->Flash->success(__('O training division foi editado com sucesso.'));
            $this->log('O training division foi editado com sucesso.', 'info');
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('O training division não pode ser editado. Por favor, tente novamente.'));
            return $this->redirect(['action' => 'index']);
        }
    }
    
    $this->set(compact('trainingDivision'));
    return null;
}

public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('TrainingDivisions/delete')) {
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->allowMethod(['post', 'delete']);
        
        $trainingDivision = $this->TrainingDivisions->get($id);
        
        if ($this->TrainingDivisions->delete($trainingDivision)) {
            $this->log('O training division foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O training division foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O training division não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('TrainingDivisions/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $trainingDivisions = $this->TrainingDivisions->find('all', [
            'contain' => ['ExerciseTrainingDivision'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($trainingDivisions as $TrainingDivisions) {
            $csvData[] = [
                $TrainingDivisions->id, $TrainingDivisions->name, $TrainingDivisions->active, $TrainingDivisions->created, $TrainingDivisions->modified     ];
        }

        $filename = 'trainingDivisions_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/TrainingDivisionsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/trainingDivisions
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class TrainingDivisionsController extends AppController
        {
            public function fetchTrainingDivisions(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->TrainingDivisions->find('all')->toArray();
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

            public function fetchtrainingDivision($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->TrainingDivisions->get($id);
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

            public function addTrainingDivisions(): Response
            {
                $this->request->allowMethod(['post']);

                $trainingDivision = $this->TrainingDivisions->newEmptyEntity();
                $trainingDivision = $this->TrainingDivisions->patchEntity($trainingDivision, $this->request->getData());

                if ($this->TrainingDivisions->save($trainingDivision)) {
                    $response = [
                        'status' => 'success',
                        'data' => $trainingDivision
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add training division'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editTrainingDivisions($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $trainingDivision = $this->TrainingDivisions->get($id);
                $trainingDivision = $this->TrainingDivisions->patchEntity($trainingDivision, $this->request->getData());

                if ($this->TrainingDivisions->save($trainingDivision)) {
                    $response = [
                        'status' => 'success',
                        'data' => $trainingDivision
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update training division'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteTrainingDivisions($id): Response
            {
                $this->request->allowMethod(['delete']);

                $trainingDivision = $this->TrainingDivisions->get($id);

                if ($this->TrainingDivisions->delete($trainingDivision)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'training division deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete training division'
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
        # TrainingDivisions routes template prefix API   

        # TrainingDivisions routes API
        $routes->connect('/TrainingDivisions', ['controller' => 'TrainingDivisions', 'action' => 'fetchTrainingDivisions', 'method' => 'GET']);
        $routes->connect('/TrainingDivisions/:id', ['controller' => 'TrainingDivisions', 'action' => 'fetchtrainingDivision', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/TrainingDivisions-add', ['controller' => 'TrainingDivisions', 'action' => 'addTrainingDivisions', 'method' => 'POST']);
        $routes->connect('/TrainingDivisions-edit/:id', ['controller' => 'TrainingDivisions', 'action' => 'editTrainingDivisions', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/TrainingDivisions-delete/:id', ['controller' => 'TrainingDivisions', 'action' => 'deleteTrainingDivisions', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # trainingDivisions routes simple template prefix /
        
        # trainingDivisions routes
        $routes->connect('/TrainingDivisions', ['controller' => 'TrainingDivisions', 'action' => 'index']);
        $routes->connect('/TrainingDivisions/view/:id', ['controller' => 'TrainingDivisions', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */}