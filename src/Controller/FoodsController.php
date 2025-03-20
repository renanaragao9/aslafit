<?php

declare(strict_types=1);

namespace App\Controller;

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
                    'CAST(Foods.link AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Foods.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Foods.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Foods.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Foods->find('all', [
            'conditions' => $conditions,
            'contain' => ['DietPlans'],
        ]);

        $foods = $this->paginate($query);


        $this->set(compact('foods',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Foods/index')) {
            return;
        }

        $food = $this->Foods->get($id, [
            'contain' => ['DietPlans'],
        ]);

        $this->set(compact('food'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Foods/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $food = $this->Foods->newEmptyEntity();

        if ($this->request->is('post')) {

            $food = $this->Foods->patchEntity($food, $this->request->getData());

            if ($this->Foods->save($food)) {
                $this->Flash->success(__('O food foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O food não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('food'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Foods/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $food = $this->Foods->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $food = $this->Foods->patchEntity($food, $this->request->getData());

            if ($this->Foods->save($food)) {
                $this->Flash->success(__('O food foi editado com sucesso.'));
                $this->log('O food foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O food não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('food'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Foods/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $food = $this->Foods->get($id);

        if ($this->Foods->delete($food)) {
            $this->log('O food foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O food foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O food não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Foods/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $foods = $this->Foods->find('all', [
            'contain' => ['DietPlans'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'link', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($foods as $Foods) {
            $csvData[] = [
                $Foods->id,
                $Foods->name,
                $Foods->link,
                $Foods->active,
                $Foods->created,
                $Foods->modified
            ];
        }

        $filename = 'foods_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/FoodsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/foods
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class FoodsController extends AppController
        {
            public function fetchFoods(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Foods->find('all')->toArray();
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

            public function fetchfood($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Foods->get($id);
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

            public function addFoods(): Response
            {
                $this->request->allowMethod(['post']);

                $food = $this->Foods->newEmptyEntity();
                $food = $this->Foods->patchEntity($food, $this->request->getData());

                if ($this->Foods->save($food)) {
                    $response = [
                        'status' => 'success',
                        'data' => $food
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add food'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editFoods($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $food = $this->Foods->get($id);
                $food = $this->Foods->patchEntity($food, $this->request->getData());

                if ($this->Foods->save($food)) {
                    $response = [
                        'status' => 'success',
                        'data' => $food
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update food'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteFoods($id): Response
            {
                $this->request->allowMethod(['delete']);

                $food = $this->Foods->get($id);

                if ($this->Foods->delete($food)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'food deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete food'
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
        # Foods routes template prefix API   

        # Foods routes API
        $routes->connect('/Foods', ['controller' => 'Foods', 'action' => 'fetchFoods', 'method' => 'GET']);
        $routes->connect('/Foods/:id', ['controller' => 'Foods', 'action' => 'fetchfood', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Foods-add', ['controller' => 'Foods', 'action' => 'addFoods', 'method' => 'POST']);
        $routes->connect('/Foods-edit/:id', ['controller' => 'Foods', 'action' => 'editFoods', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Foods-delete/:id', ['controller' => 'Foods', 'action' => 'deleteFoods', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # foods routes simple template prefix /
        
        # foods routes
        $routes->connect('/Foods', ['controller' => 'Foods', 'action' => 'index']);
        $routes->connect('/Foods/view/:id', ['controller' => 'Foods', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
