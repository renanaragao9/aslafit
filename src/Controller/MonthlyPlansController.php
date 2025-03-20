<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class MonthlyPlansController extends AppController
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
        if (!$this->checkPermission('MonthlyPlans/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(MonthlyPlans.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MonthlyPlans.date_payment AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MonthlyPlans.date_venciment AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MonthlyPlans.value AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MonthlyPlans.observation AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MonthlyPlans.payment_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MonthlyPlans.plan_type_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MonthlyPlans.student_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MonthlyPlans.collaborator_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MonthlyPlans.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MonthlyPlans.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->MonthlyPlans->find('all', [
            'conditions' => $conditions,
            'contain' => ['FormPayments', 'PlanTypes', 'Students', 'Collaborators'],
        ]);

        $monthlyPlans = $this->paginate($query);

        $formPayments = $this->MonthlyPlans->FormPayments->find('list', ['limit' => 200])->all();
        $planTypes = $this->MonthlyPlans->PlanTypes->find('list', ['limit' => 200])->all();
        $students = $this->MonthlyPlans->Students->find('list', ['limit' => 200])->all();
        $collaborators = $this->MonthlyPlans->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('monthlyPlans', 'formPayments', 'planTypes', 'students', 'collaborators'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('MonthlyPlans/index')) {
            return;
        }

        $monthlyPlan = $this->MonthlyPlans->get($id, [
            'contain' => ['FormPayments', 'PlanTypes', 'Students', 'Collaborators'],
        ]);

        $this->set(compact('monthlyPlan'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('MonthlyPlans/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $monthlyPlan = $this->MonthlyPlans->newEmptyEntity();

        if ($this->request->is('post')) {

            $monthlyPlan = $this->MonthlyPlans->patchEntity($monthlyPlan, $this->request->getData());

            if ($this->MonthlyPlans->save($monthlyPlan)) {
                $this->Flash->success(__('O monthly plan foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O monthly plan não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $formPayments = $this->MonthlyPlans->FormPayments->find('list', ['limit' => 200])->all();
        $planTypes = $this->MonthlyPlans->PlanTypes->find('list', ['limit' => 200])->all();
        $students = $this->MonthlyPlans->Students->find('list', ['limit' => 200])->all();
        $collaborators = $this->MonthlyPlans->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('monthlyPlan', 'formPayments', 'planTypes', 'students', 'collaborators'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('MonthlyPlans/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $monthlyPlan = $this->MonthlyPlans->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $monthlyPlan = $this->MonthlyPlans->patchEntity($monthlyPlan, $this->request->getData());

            if ($this->MonthlyPlans->save($monthlyPlan)) {
                $this->Flash->success(__('O monthly plan foi editado com sucesso.'));
                $this->log('O monthly plan foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O monthly plan não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $formPayments = $this->MonthlyPlans->FormPayments->find('list', ['limit' => 200])->all();
        $planTypes = $this->MonthlyPlans->PlanTypes->find('list', ['limit' => 200])->all();
        $students = $this->MonthlyPlans->Students->find('list', ['limit' => 200])->all();
        $collaborators = $this->MonthlyPlans->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('monthlyPlan', 'formPayments', 'planTypes', 'students', 'collaborators'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('MonthlyPlans/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $monthlyPlan = $this->MonthlyPlans->get($id);

        if ($this->MonthlyPlans->delete($monthlyPlan)) {
            $this->log('O monthly plan foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O monthly plan foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O monthly plan não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('MonthlyPlans/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $monthlyPlans = $this->MonthlyPlans->find('all', [
            'contain' => ['FormPayments', 'PlanTypes', 'Students', 'Collaborators'],
        ]);

        $csvData = [];
        $header = ['id', 'date_payment', 'date_venciment', 'value', 'observation', 'payment_id', 'plan_type_id', 'student_id', 'collaborator_id', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($monthlyPlans as $MonthlyPlans) {
            $csvData[] = [
                $MonthlyPlans->id,
                $MonthlyPlans->date_payment,
                $MonthlyPlans->date_venciment,
                $MonthlyPlans->value,
                $MonthlyPlans->observation,
                $MonthlyPlans->payment_id,
                $MonthlyPlans->plan_type_id,
                $MonthlyPlans->student_id,
                $MonthlyPlans->collaborator_id,
                $MonthlyPlans->created,
                $MonthlyPlans->modified
            ];
        }

        $filename = 'monthlyPlans_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/MonthlyPlansController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/monthlyPlans
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class MonthlyPlansController extends AppController
        {
            public function fetchMonthlyPlans(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->MonthlyPlans->find('all')->toArray();
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

            public function fetchmonthlyPlan($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->MonthlyPlans->get($id);
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

            public function addMonthlyPlans(): Response
            {
                $this->request->allowMethod(['post']);

                $monthlyPlan = $this->MonthlyPlans->newEmptyEntity();
                $monthlyPlan = $this->MonthlyPlans->patchEntity($monthlyPlan, $this->request->getData());

                if ($this->MonthlyPlans->save($monthlyPlan)) {
                    $response = [
                        'status' => 'success',
                        'data' => $monthlyPlan
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add monthly plan'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editMonthlyPlans($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $monthlyPlan = $this->MonthlyPlans->get($id);
                $monthlyPlan = $this->MonthlyPlans->patchEntity($monthlyPlan, $this->request->getData());

                if ($this->MonthlyPlans->save($monthlyPlan)) {
                    $response = [
                        'status' => 'success',
                        'data' => $monthlyPlan
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update monthly plan'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteMonthlyPlans($id): Response
            {
                $this->request->allowMethod(['delete']);

                $monthlyPlan = $this->MonthlyPlans->get($id);

                if ($this->MonthlyPlans->delete($monthlyPlan)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'monthly plan deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete monthly plan'
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
        # MonthlyPlans routes template prefix API   

        # MonthlyPlans routes API
        $routes->connect('/MonthlyPlans', ['controller' => 'MonthlyPlans', 'action' => 'fetchMonthlyPlans', 'method' => 'GET']);
        $routes->connect('/MonthlyPlans/:id', ['controller' => 'MonthlyPlans', 'action' => 'fetchmonthlyPlan', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/MonthlyPlans-add', ['controller' => 'MonthlyPlans', 'action' => 'addMonthlyPlans', 'method' => 'POST']);
        $routes->connect('/MonthlyPlans-edit/:id', ['controller' => 'MonthlyPlans', 'action' => 'editMonthlyPlans', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/MonthlyPlans-delete/:id', ['controller' => 'MonthlyPlans', 'action' => 'deleteMonthlyPlans', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # monthlyPlans routes simple template prefix /
        
        # monthlyPlans routes
        $routes->connect('/MonthlyPlans', ['controller' => 'MonthlyPlans', 'action' => 'index']);
        $routes->connect('/MonthlyPlans/view/:id', ['controller' => 'MonthlyPlans', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
