<?php

declare(strict_types=1);

namespace App\Controller;

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
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(DietPlans.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(DietPlans.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(DietPlans.student_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(DietPlans.meal_type_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(DietPlans.food_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(DietPlans.ficha_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(DietPlans.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(DietPlans.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(DietPlans.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->DietPlans->find('all', [
            'conditions' => $conditions,
            'contain' => ['Students', 'MealTypes', 'Foods', 'Fichas'],
        ]);

        $dietPlans = $this->paginate($query);

        $students = $this->DietPlans->Students->find('list', ['limit' => 200])->all();
        $mealTypes = $this->DietPlans->MealTypes->find('list', ['limit' => 200])->all();
        $foods = $this->DietPlans->Foods->find('list', ['limit' => 200])->all();
        $fichas = $this->DietPlans->Fichas->find('list', ['limit' => 200])->all();

        $this->set(compact('dietPlans', 'students', 'mealTypes', 'foods', 'fichas'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('DietPlans/index')) {
            return;
        }

        $dietPlan = $this->DietPlans->get($id, [
            'contain' => ['Students', 'MealTypes', 'Foods', 'Fichas'],
        ]);

        $this->set(compact('dietPlan'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('DietPlans/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $dietPlan = $this->DietPlans->newEmptyEntity();

        if ($this->request->is('post')) {

            $dietPlan = $this->DietPlans->patchEntity($dietPlan, $this->request->getData());

            if ($this->DietPlans->save($dietPlan)) {
                $this->Flash->success(__('O diet plan foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O diet plan não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $students = $this->DietPlans->Students->find('list', ['limit' => 200])->all();
        $mealTypes = $this->DietPlans->MealTypes->find('list', ['limit' => 200])->all();
        $foods = $this->DietPlans->Foods->find('list', ['limit' => 200])->all();
        $fichas = $this->DietPlans->Fichas->find('list', ['limit' => 200])->all();

        $this->set(compact('dietPlan', 'students', 'mealTypes', 'foods', 'fichas'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('DietPlans/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $dietPlan = $this->DietPlans->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $dietPlan = $this->DietPlans->patchEntity($dietPlan, $this->request->getData());

            if ($this->DietPlans->save($dietPlan)) {
                $this->Flash->success(__('O diet plan foi editado com sucesso.'));
                $this->log('O diet plan foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O diet plan não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $students = $this->DietPlans->Students->find('list', ['limit' => 200])->all();
        $mealTypes = $this->DietPlans->MealTypes->find('list', ['limit' => 200])->all();
        $foods = $this->DietPlans->Foods->find('list', ['limit' => 200])->all();
        $fichas = $this->DietPlans->Fichas->find('list', ['limit' => 200])->all();

        $this->set(compact('dietPlan', 'students', 'mealTypes', 'foods', 'fichas'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('DietPlans/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $dietPlan = $this->DietPlans->get($id);

        if ($this->DietPlans->delete($dietPlan)) {
            $this->log('O diet plan foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O diet plan foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O diet plan não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('DietPlans/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $dietPlans = $this->DietPlans->find('all', [
            'contain' => ['Students', 'MealTypes', 'Foods', 'Fichas'],
        ]);

        $csvData = [];
        $header = ['id', 'description', 'student_id', 'meal_type_id', 'food_id', 'ficha_id', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($dietPlans as $DietPlans) {
            $csvData[] = [
                $DietPlans->id,
                $DietPlans->description,
                $DietPlans->student_id,
                $DietPlans->meal_type_id,
                $DietPlans->food_id,
                $DietPlans->ficha_id,
                $DietPlans->active,
                $DietPlans->created,
                $DietPlans->modified
            ];
        }

        $filename = 'dietPlans_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/DietPlansController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/dietPlans
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class DietPlansController extends AppController
        {
            public function fetchDietPlans(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->DietPlans->find('all')->toArray();
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

            public function fetchdietPlan($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->DietPlans->get($id);
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

            public function addDietPlans(): Response
            {
                $this->request->allowMethod(['post']);

                $dietPlan = $this->DietPlans->newEmptyEntity();
                $dietPlan = $this->DietPlans->patchEntity($dietPlan, $this->request->getData());

                if ($this->DietPlans->save($dietPlan)) {
                    $response = [
                        'status' => 'success',
                        'data' => $dietPlan
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add diet plan'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editDietPlans($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $dietPlan = $this->DietPlans->get($id);
                $dietPlan = $this->DietPlans->patchEntity($dietPlan, $this->request->getData());

                if ($this->DietPlans->save($dietPlan)) {
                    $response = [
                        'status' => 'success',
                        'data' => $dietPlan
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update diet plan'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteDietPlans($id): Response
            {
                $this->request->allowMethod(['delete']);

                $dietPlan = $this->DietPlans->get($id);

                if ($this->DietPlans->delete($dietPlan)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'diet plan deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete diet plan'
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
        # DietPlans routes template prefix API   

        # DietPlans routes API
        $routes->connect('/DietPlans', ['controller' => 'DietPlans', 'action' => 'fetchDietPlans', 'method' => 'GET']);
        $routes->connect('/DietPlans/:id', ['controller' => 'DietPlans', 'action' => 'fetchdietPlan', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/DietPlans-add', ['controller' => 'DietPlans', 'action' => 'addDietPlans', 'method' => 'POST']);
        $routes->connect('/DietPlans-edit/:id', ['controller' => 'DietPlans', 'action' => 'editDietPlans', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/DietPlans-delete/:id', ['controller' => 'DietPlans', 'action' => 'deleteDietPlans', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # dietPlans routes simple template prefix /
        
        # dietPlans routes
        $routes->connect('/DietPlans', ['controller' => 'DietPlans', 'action' => 'index']);
        $routes->connect('/DietPlans/view/:id', ['controller' => 'DietPlans', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
