<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class OrdersController extends AppController
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
        if (!$this->checkPermission('Orders/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Orders.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Orders.order_number AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Orders.order_date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Orders.total_amount AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Orders.status AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Orders.token AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Orders.payment_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Orders.delivery AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Orders.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Orders.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Orders->find('all', [
            'conditions' => $conditions,
            'contain' => ['FormPayments', 'OrderInvoices', 'OrderItems'],
        ]);

        $orders = $this->paginate($query);

        $formPayments = $this->Orders->FormPayments->find('list', ['limit' => 200])->all();

        $this->set(compact('orders', 'formPayments'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Orders/index')) {
            return;
        }

        $order = $this->Orders->get($id, [
            'contain' => ['FormPayments', 'OrderInvoices', 'OrderItems'],
        ]);

        $this->set(compact('order'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Orders/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $order = $this->Orders->newEmptyEntity();

        if ($this->request->is('post')) {

            $order = $this->Orders->patchEntity($order, $this->request->getData());

            if ($this->Orders->save($order)) {
                $this->Flash->success(__('O order foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O order não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $formPayments = $this->Orders->FormPayments->find('list', ['limit' => 200])->all();

        $this->set(compact('order', 'formPayments'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Orders/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $order = $this->Orders->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $order = $this->Orders->patchEntity($order, $this->request->getData());

            if ($this->Orders->save($order)) {
                $this->Flash->success(__('O order foi editado com sucesso.'));
                $this->log('O order foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O order não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $formPayments = $this->Orders->FormPayments->find('list', ['limit' => 200])->all();

        $this->set(compact('order', 'formPayments'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Orders/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $order = $this->Orders->get($id);

        if ($this->Orders->delete($order)) {
            $this->log('O order foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O order foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O order não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Orders/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $orders = $this->Orders->find('all', [
            'contain' => ['FormPayments', 'OrderInvoices', 'OrderItems'],
        ]);

        $csvData = [];
        $header = ['id', 'order_number', 'order_date', 'total_amount', 'status', 'token', 'payment_id', 'delivery', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($orders as $Orders) {
            $csvData[] = [
                $Orders->id,
                $Orders->order_number,
                $Orders->order_date,
                $Orders->total_amount,
                $Orders->status,
                $Orders->token,
                $Orders->payment_id,
                $Orders->delivery,
                $Orders->created,
                $Orders->modified
            ];
        }

        $filename = 'orders_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/OrdersController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/orders
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class OrdersController extends AppController
        {
            public function fetchOrders(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Orders->find('all')->toArray();
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

            public function fetchorder($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Orders->get($id);
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

            public function addOrders(): Response
            {
                $this->request->allowMethod(['post']);

                $order = $this->Orders->newEmptyEntity();
                $order = $this->Orders->patchEntity($order, $this->request->getData());

                if ($this->Orders->save($order)) {
                    $response = [
                        'status' => 'success',
                        'data' => $order
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add order'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editOrders($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $order = $this->Orders->get($id);
                $order = $this->Orders->patchEntity($order, $this->request->getData());

                if ($this->Orders->save($order)) {
                    $response = [
                        'status' => 'success',
                        'data' => $order
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update order'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteOrders($id): Response
            {
                $this->request->allowMethod(['delete']);

                $order = $this->Orders->get($id);

                if ($this->Orders->delete($order)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'order deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete order'
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
        # Orders routes template prefix API   

        # Orders routes API
        $routes->connect('/Orders', ['controller' => 'Orders', 'action' => 'fetchOrders', 'method' => 'GET']);
        $routes->connect('/Orders/:id', ['controller' => 'Orders', 'action' => 'fetchorder', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Orders-add', ['controller' => 'Orders', 'action' => 'addOrders', 'method' => 'POST']);
        $routes->connect('/Orders-edit/:id', ['controller' => 'Orders', 'action' => 'editOrders', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Orders-delete/:id', ['controller' => 'Orders', 'action' => 'deleteOrders', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # orders routes simple template prefix /
        
        # orders routes
        $routes->connect('/Orders', ['controller' => 'Orders', 'action' => 'index']);
        $routes->connect('/Orders/view/:id', ['controller' => 'Orders', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
