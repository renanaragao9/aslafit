<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class PositionsController extends AppController
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
        if (!$this->checkPermission('Positions/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Positions.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.base_salary AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Positions.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Positions->find('all', [
            'conditions' => $conditions,
            'contain' => ['Collaborators'],
        ]);

        $positions = $this->paginate($query);


        $this->set(compact('positions',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Positions/index')) {
            return;
        }

        $position = $this->Positions->get($id, [
            'contain' => ['Collaborators'],
        ]);

        $this->set(compact('position'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Positions/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $position = $this->Positions->newEmptyEntity();

        if ($this->request->is('post')) {

            $position = $this->Positions->patchEntity($position, $this->request->getData());

            if ($this->Positions->save($position)) {
                $this->Flash->success(__('O position foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O position não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('position'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Positions/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $position = $this->Positions->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $position = $this->Positions->patchEntity($position, $this->request->getData());

            if ($this->Positions->save($position)) {
                $this->Flash->success(__('O position foi editado com sucesso.'));
                $this->log('O position foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O position não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('position'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Positions/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $position = $this->Positions->get($id);

        if ($this->Positions->delete($position)) {
            $this->log('O position foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O position foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O position não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Positions/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $positions = $this->Positions->find('all', [
            'contain' => ['Collaborators'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'description', 'base_salary', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($positions as $Positions) {
            $csvData[] = [
                $Positions->id,
                $Positions->name,
                $Positions->description,
                $Positions->base_salary,
                $Positions->active,
                $Positions->created,
                $Positions->modified
            ];
        }

        $filename = 'positions_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/PositionsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/positions
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class PositionsController extends AppController
        {
            public function fetchPositions(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Positions->find('all')->toArray();
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

            public function fetchposition($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Positions->get($id);
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

            public function addPositions(): Response
            {
                $this->request->allowMethod(['post']);

                $position = $this->Positions->newEmptyEntity();
                $position = $this->Positions->patchEntity($position, $this->request->getData());

                if ($this->Positions->save($position)) {
                    $response = [
                        'status' => 'success',
                        'data' => $position
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add position'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editPositions($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $position = $this->Positions->get($id);
                $position = $this->Positions->patchEntity($position, $this->request->getData());

                if ($this->Positions->save($position)) {
                    $response = [
                        'status' => 'success',
                        'data' => $position
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update position'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deletePositions($id): Response
            {
                $this->request->allowMethod(['delete']);

                $position = $this->Positions->get($id);

                if ($this->Positions->delete($position)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'position deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete position'
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
        # Positions routes template prefix API   

        # Positions routes API
        $routes->connect('/Positions', ['controller' => 'Positions', 'action' => 'fetchPositions', 'method' => 'GET']);
        $routes->connect('/Positions/:id', ['controller' => 'Positions', 'action' => 'fetchposition', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Positions-add', ['controller' => 'Positions', 'action' => 'addPositions', 'method' => 'POST']);
        $routes->connect('/Positions-edit/:id', ['controller' => 'Positions', 'action' => 'editPositions', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Positions-delete/:id', ['controller' => 'Positions', 'action' => 'deletePositions', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # positions routes simple template prefix /
        
        # positions routes
        $routes->connect('/Positions', ['controller' => 'Positions', 'action' => 'index']);
        $routes->connect('/Positions/view/:id', ['controller' => 'Positions', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
