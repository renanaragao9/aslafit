<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class MealTypesController extends AppController
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
        if (!$this->checkPermission('MealTypes/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(MealTypes.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MealTypes.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MealTypes.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MealTypes.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MealTypes.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->MealTypes->find('all', [
            'conditions' => $conditions,
            'contain' => ['DietPlans'],
        ]);

        $mealTypes = $this->paginate($query);


        $this->set(compact('mealTypes',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('MealTypes/index')) {
            return;
        }

        $mealType = $this->MealTypes->get($id, [
            'contain' => ['DietPlans'],
        ]);

        $this->set(compact('mealType'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('MealTypes/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $mealType = $this->MealTypes->newEmptyEntity();

        if ($this->request->is('post')) {

            $mealType = $this->MealTypes->patchEntity($mealType, $this->request->getData());

            if ($this->MealTypes->save($mealType)) {
                $this->Flash->success(__('O meal type foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O meal type não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('mealType'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('MealTypes/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $mealType = $this->MealTypes->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $mealType = $this->MealTypes->patchEntity($mealType, $this->request->getData());

            if ($this->MealTypes->save($mealType)) {
                $this->Flash->success(__('O meal type foi editado com sucesso.'));
                $this->log('O meal type foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O meal type não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('mealType'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('MealTypes/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $mealType = $this->MealTypes->get($id);

        if ($this->MealTypes->delete($mealType)) {
            $this->log('O meal type foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O meal type foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O meal type não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('MealTypes/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $mealTypes = $this->MealTypes->find('all', [
            'contain' => ['DietPlans'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($mealTypes as $MealTypes) {
            $csvData[] = [
                $MealTypes->id,
                $MealTypes->name,
                $MealTypes->active,
                $MealTypes->created,
                $MealTypes->modified
            ];
        }

        $filename = 'mealTypes_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/MealTypesController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/mealTypes
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class MealTypesController extends AppController
        {
            public function fetchMealTypes(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->MealTypes->find('all')->toArray();
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

            public function fetchmealType($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->MealTypes->get($id);
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

            public function addMealTypes(): Response
            {
                $this->request->allowMethod(['post']);

                $mealType = $this->MealTypes->newEmptyEntity();
                $mealType = $this->MealTypes->patchEntity($mealType, $this->request->getData());

                if ($this->MealTypes->save($mealType)) {
                    $response = [
                        'status' => 'success',
                        'data' => $mealType
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add meal type'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editMealTypes($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $mealType = $this->MealTypes->get($id);
                $mealType = $this->MealTypes->patchEntity($mealType, $this->request->getData());

                if ($this->MealTypes->save($mealType)) {
                    $response = [
                        'status' => 'success',
                        'data' => $mealType
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update meal type'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteMealTypes($id): Response
            {
                $this->request->allowMethod(['delete']);

                $mealType = $this->MealTypes->get($id);

                if ($this->MealTypes->delete($mealType)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'meal type deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete meal type'
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
        # MealTypes routes template prefix API   

        # MealTypes routes API
        $routes->connect('/MealTypes', ['controller' => 'MealTypes', 'action' => 'fetchMealTypes', 'method' => 'GET']);
        $routes->connect('/MealTypes/:id', ['controller' => 'MealTypes', 'action' => 'fetchmealType', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/MealTypes-add', ['controller' => 'MealTypes', 'action' => 'addMealTypes', 'method' => 'POST']);
        $routes->connect('/MealTypes-edit/:id', ['controller' => 'MealTypes', 'action' => 'editMealTypes', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/MealTypes-delete/:id', ['controller' => 'MealTypes', 'action' => 'deleteMealTypes', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # mealTypes routes simple template prefix /
        
        # mealTypes routes
        $routes->connect('/MealTypes', ['controller' => 'MealTypes', 'action' => 'index']);
        $routes->connect('/MealTypes/view/:id', ['controller' => 'MealTypes', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
