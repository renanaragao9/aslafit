<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class FormPaymentsController extends AppController
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
        if (!$this->checkPermission('FormPayments/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(FormPayments.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FormPayments.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FormPayments.flag AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FormPayments.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FormPayments.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FormPayments.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->FormPayments->find('all', [
            'conditions' => $conditions,
            'contain' => [],
        ]);

        $formPayments = $this->paginate($query);


        $this->set(compact('formPayments',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('FormPayments/index')) {
            return;
        }

        $formPayment = $this->FormPayments->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('formPayment'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('FormPayments/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $formPayment = $this->FormPayments->newEmptyEntity();

        if ($this->request->is('post')) {

            $formPayment = $this->FormPayments->patchEntity($formPayment, $this->request->getData());

            if ($this->FormPayments->save($formPayment)) {
                $this->Flash->success(__('O form payment foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O form payment não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('formPayment'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('FormPayments/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $formPayment = $this->FormPayments->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $formPayment = $this->FormPayments->patchEntity($formPayment, $this->request->getData());

            if ($this->FormPayments->save($formPayment)) {
                $this->Flash->success(__('O form payment foi editado com sucesso.'));
                $this->log('O form payment foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O form payment não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('formPayment'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('FormPayments/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $formPayment = $this->FormPayments->get($id);

        if ($this->FormPayments->delete($formPayment)) {
            $this->log('O form payment foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O form payment foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O form payment não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('FormPayments/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $formPayments = $this->FormPayments->find('all', [
            'contain' => [],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'flag', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($formPayments as $FormPayments) {
            $csvData[] = [
                $FormPayments->id,
                $FormPayments->name,
                $FormPayments->flag,
                $FormPayments->active,
                $FormPayments->created,
                $FormPayments->modified
            ];
        }

        $filename = 'formPayments_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/FormPaymentsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/formPayments
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class FormPaymentsController extends AppController
        {
            public function fetchFormPayments(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->FormPayments->find('all')->toArray();
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

            public function fetchformPayment($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->FormPayments->get($id);
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

            public function addFormPayments(): Response
            {
                $this->request->allowMethod(['post']);

                $formPayment = $this->FormPayments->newEmptyEntity();
                $formPayment = $this->FormPayments->patchEntity($formPayment, $this->request->getData());

                if ($this->FormPayments->save($formPayment)) {
                    $response = [
                        'status' => 'success',
                        'data' => $formPayment
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add form payment'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editFormPayments($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $formPayment = $this->FormPayments->get($id);
                $formPayment = $this->FormPayments->patchEntity($formPayment, $this->request->getData());

                if ($this->FormPayments->save($formPayment)) {
                    $response = [
                        'status' => 'success',
                        'data' => $formPayment
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update form payment'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteFormPayments($id): Response
            {
                $this->request->allowMethod(['delete']);

                $formPayment = $this->FormPayments->get($id);

                if ($this->FormPayments->delete($formPayment)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'form payment deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete form payment'
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
        # FormPayments routes template prefix API   

        # FormPayments routes API
        $routes->connect('/FormPayments', ['controller' => 'FormPayments', 'action' => 'fetchFormPayments', 'method' => 'GET']);
        $routes->connect('/FormPayments/:id', ['controller' => 'FormPayments', 'action' => 'fetchformPayment', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/FormPayments-add', ['controller' => 'FormPayments', 'action' => 'addFormPayments', 'method' => 'POST']);
        $routes->connect('/FormPayments-edit/:id', ['controller' => 'FormPayments', 'action' => 'editFormPayments', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/FormPayments-delete/:id', ['controller' => 'FormPayments', 'action' => 'deleteFormPayments', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # formPayments routes simple template prefix /
        
        # formPayments routes
        $routes->connect('/FormPayments', ['controller' => 'FormPayments', 'action' => 'index']);
        $routes->connect('/FormPayments/view/:id', ['controller' => 'FormPayments', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
