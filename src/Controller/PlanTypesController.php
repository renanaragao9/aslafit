<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class PlanTypesController extends AppController
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
        if (!$this->checkPermission('PlanTypes/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(PlanTypes.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.value AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.months AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->PlanTypes->find('all', [
            'conditions' => $conditions,
            'contain' => ['MonthlyPlans'],
        ]);

        $planTypes = $this->paginate($query);


        $this->set(compact('planTypes',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('PlanTypes/index')) {
            return;
        }

        $planType = $this->PlanTypes->get($id, [
            'contain' => ['MonthlyPlans'],
        ]);

        $this->set(compact('planType'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('PlanTypes/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $planType = $this->PlanTypes->newEmptyEntity();

        if ($this->request->is('post')) {

            $planType = $this->PlanTypes->patchEntity($planType, $this->request->getData());

            if ($this->PlanTypes->save($planType)) {
                $this->Flash->success(__('O plan type foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O plan type não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('planType'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('PlanTypes/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $planType = $this->PlanTypes->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $planType = $this->PlanTypes->patchEntity($planType, $this->request->getData());

            if ($this->PlanTypes->save($planType)) {
                $this->Flash->success(__('O plan type foi editado com sucesso.'));
                $this->log('O plan type foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O plan type não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('planType'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('PlanTypes/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $planType = $this->PlanTypes->get($id);

        if ($this->PlanTypes->delete($planType)) {
            $this->log('O plan type foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O plan type foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O plan type não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('PlanTypes/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $planTypes = $this->PlanTypes->find('all', [
            'contain' => ['MonthlyPlans'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'value', 'months', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($planTypes as $PlanTypes) {
            $csvData[] = [
                $PlanTypes->id,
                $PlanTypes->name,
                $PlanTypes->value,
                $PlanTypes->months,
                $PlanTypes->active,
                $PlanTypes->created,
                $PlanTypes->modified
            ];
        }

        $filename = 'planTypes_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/PlanTypesController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/planTypes
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class PlanTypesController extends AppController
        {
            public function fetchPlanTypes(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->PlanTypes->find('all')->toArray();
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

            public function fetchplanType($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->PlanTypes->get($id);
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

            public function addPlanTypes(): Response
            {
                $this->request->allowMethod(['post']);

                $planType = $this->PlanTypes->newEmptyEntity();
                $planType = $this->PlanTypes->patchEntity($planType, $this->request->getData());

                if ($this->PlanTypes->save($planType)) {
                    $response = [
                        'status' => 'success',
                        'data' => $planType
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add plan type'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editPlanTypes($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $planType = $this->PlanTypes->get($id);
                $planType = $this->PlanTypes->patchEntity($planType, $this->request->getData());

                if ($this->PlanTypes->save($planType)) {
                    $response = [
                        'status' => 'success',
                        'data' => $planType
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update plan type'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deletePlanTypes($id): Response
            {
                $this->request->allowMethod(['delete']);

                $planType = $this->PlanTypes->get($id);

                if ($this->PlanTypes->delete($planType)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'plan type deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete plan type'
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
        # PlanTypes routes template prefix API   

        # PlanTypes routes API
        $routes->connect('/PlanTypes', ['controller' => 'PlanTypes', 'action' => 'fetchPlanTypes', 'method' => 'GET']);
        $routes->connect('/PlanTypes/:id', ['controller' => 'PlanTypes', 'action' => 'fetchplanType', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/PlanTypes-add', ['controller' => 'PlanTypes', 'action' => 'addPlanTypes', 'method' => 'POST']);
        $routes->connect('/PlanTypes-edit/:id', ['controller' => 'PlanTypes', 'action' => 'editPlanTypes', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/PlanTypes-delete/:id', ['controller' => 'PlanTypes', 'action' => 'deletePlanTypes', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # planTypes routes simple template prefix /
        
        # planTypes routes
        $routes->connect('/PlanTypes', ['controller' => 'PlanTypes', 'action' => 'index']);
        $routes->connect('/PlanTypes/view/:id', ['controller' => 'PlanTypes', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
