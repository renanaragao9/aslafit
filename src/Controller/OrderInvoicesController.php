<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class OrderInvoicesController extends AppController
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
        if (!$this->checkPermission('OrderInvoices/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(OrderInvoices.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderInvoices.order_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderInvoices.status AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderInvoices.paid AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderInvoices.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderInvoices.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->OrderInvoices->find('all', [
            'conditions' => $conditions,
            'contain' => ['Orders'],
        ]);

        $orderInvoices = $this->paginate($query);

        $orders = $this->OrderInvoices->Orders->find('list', ['limit' => 200])->all();

        $this->set(compact('orderInvoices', 'orders'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('OrderInvoices/index')) {
            return;
        }

        $orderInvoice = $this->OrderInvoices->get($id, [
            'contain' => ['Orders'],
        ]);

        $this->set(compact('orderInvoice'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('OrderInvoices/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $orderInvoice = $this->OrderInvoices->newEmptyEntity();

        if ($this->request->is('post')) {

            $orderInvoice = $this->OrderInvoices->patchEntity($orderInvoice, $this->request->getData());

            if ($this->OrderInvoices->save($orderInvoice)) {
                $this->Flash->success(__('O order invoice foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O order invoice não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $orders = $this->OrderInvoices->Orders->find('list', ['limit' => 200])->all();

        $this->set(compact('orderInvoice', 'orders'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('OrderInvoices/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $orderInvoice = $this->OrderInvoices->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $orderInvoice = $this->OrderInvoices->patchEntity($orderInvoice, $this->request->getData());

            if ($this->OrderInvoices->save($orderInvoice)) {
                $this->Flash->success(__('O order invoice foi editado com sucesso.'));
                $this->log('O order invoice foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O order invoice não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $orders = $this->OrderInvoices->Orders->find('list', ['limit' => 200])->all();

        $this->set(compact('orderInvoice', 'orders'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('OrderInvoices/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $orderInvoice = $this->OrderInvoices->get($id);

        if ($this->OrderInvoices->delete($orderInvoice)) {
            $this->log('O order invoice foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O order invoice foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O order invoice não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('OrderInvoices/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $orderInvoices = $this->OrderInvoices->find('all', [
            'contain' => ['Orders'],
        ]);

        $csvData = [];
        $header = ['id', 'order_id', 'status', 'paid', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($orderInvoices as $OrderInvoices) {
            $csvData[] = [
                $OrderInvoices->id,
                $OrderInvoices->order_id,
                $OrderInvoices->status,
                $OrderInvoices->paid,
                $OrderInvoices->created,
                $OrderInvoices->modified
            ];
        }

        $filename = 'orderInvoices_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/OrderInvoicesController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/orderInvoices
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class OrderInvoicesController extends AppController
        {
            public function fetchOrderInvoices(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->OrderInvoices->find('all')->toArray();
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

            public function fetchorderInvoice($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->OrderInvoices->get($id);
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

            public function addOrderInvoices(): Response
            {
                $this->request->allowMethod(['post']);

                $orderInvoice = $this->OrderInvoices->newEmptyEntity();
                $orderInvoice = $this->OrderInvoices->patchEntity($orderInvoice, $this->request->getData());

                if ($this->OrderInvoices->save($orderInvoice)) {
                    $response = [
                        'status' => 'success',
                        'data' => $orderInvoice
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add order invoice'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editOrderInvoices($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $orderInvoice = $this->OrderInvoices->get($id);
                $orderInvoice = $this->OrderInvoices->patchEntity($orderInvoice, $this->request->getData());

                if ($this->OrderInvoices->save($orderInvoice)) {
                    $response = [
                        'status' => 'success',
                        'data' => $orderInvoice
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update order invoice'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteOrderInvoices($id): Response
            {
                $this->request->allowMethod(['delete']);

                $orderInvoice = $this->OrderInvoices->get($id);

                if ($this->OrderInvoices->delete($orderInvoice)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'order invoice deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete order invoice'
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
        # OrderInvoices routes template prefix API   

        # OrderInvoices routes API
        $routes->connect('/OrderInvoices', ['controller' => 'OrderInvoices', 'action' => 'fetchOrderInvoices', 'method' => 'GET']);
        $routes->connect('/OrderInvoices/:id', ['controller' => 'OrderInvoices', 'action' => 'fetchorderInvoice', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/OrderInvoices-add', ['controller' => 'OrderInvoices', 'action' => 'addOrderInvoices', 'method' => 'POST']);
        $routes->connect('/OrderInvoices-edit/:id', ['controller' => 'OrderInvoices', 'action' => 'editOrderInvoices', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/OrderInvoices-delete/:id', ['controller' => 'OrderInvoices', 'action' => 'deleteOrderInvoices', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # orderInvoices routes simple template prefix /
        
        # orderInvoices routes
        $routes->connect('/OrderInvoices', ['controller' => 'OrderInvoices', 'action' => 'index']);
        $routes->connect('/OrderInvoices/view/:id', ['controller' => 'OrderInvoices', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
