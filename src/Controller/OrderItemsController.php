<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class OrderItemsController extends AppController
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
        if (!$this->checkPermission('OrderItems/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(OrderItems.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderItems.order_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderItems.item_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderItems.quantity AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderItems.unit_price AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderItems.total_price AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderItems.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(OrderItems.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->OrderItems->find('all', [
            'conditions' => $conditions,
            'contain' => ['Orders', 'Items'],
        ]);

        $orderItems = $this->paginate($query);

        $orders = $this->OrderItems->Orders->find('list', ['limit' => 200])->all();
        $items = $this->OrderItems->Items->find('list', ['limit' => 200])->all();

        $this->set(compact('orderItems', 'orders', 'items'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('OrderItems/index')) {
            return;
        }

        $orderItem = $this->OrderItems->get($id, [
            'contain' => ['Orders', 'Items'],
        ]);

        $this->set(compact('orderItem'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('OrderItems/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $orderItem = $this->OrderItems->newEmptyEntity();

        if ($this->request->is('post')) {

            $orderItem = $this->OrderItems->patchEntity($orderItem, $this->request->getData());

            if ($this->OrderItems->save($orderItem)) {
                $this->Flash->success(__('O order item foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O order item não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $orders = $this->OrderItems->Orders->find('list', ['limit' => 200])->all();
        $items = $this->OrderItems->Items->find('list', ['limit' => 200])->all();

        $this->set(compact('orderItem', 'orders', 'items'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('OrderItems/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $orderItem = $this->OrderItems->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $orderItem = $this->OrderItems->patchEntity($orderItem, $this->request->getData());

            if ($this->OrderItems->save($orderItem)) {
                $this->Flash->success(__('O order item foi editado com sucesso.'));
                $this->log('O order item foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O order item não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $orders = $this->OrderItems->Orders->find('list', ['limit' => 200])->all();
        $items = $this->OrderItems->Items->find('list', ['limit' => 200])->all();

        $this->set(compact('orderItem', 'orders', 'items'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('OrderItems/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $orderItem = $this->OrderItems->get($id);

        if ($this->OrderItems->delete($orderItem)) {
            $this->log('O order item foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O order item foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O order item não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('OrderItems/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $orderItems = $this->OrderItems->find('all', [
            'contain' => ['Orders', 'Items'],
        ]);

        $csvData = [];
        $header = ['id', 'order_id', 'item_id', 'quantity', 'unit_price', 'total_price', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($orderItems as $OrderItems) {
            $csvData[] = [
                $OrderItems->id,
                $OrderItems->order_id,
                $OrderItems->item_id,
                $OrderItems->quantity,
                $OrderItems->unit_price,
                $OrderItems->total_price,
                $OrderItems->created,
                $OrderItems->modified
            ];
        }

        $filename = 'orderItems_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/OrderItemsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/orderItems
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class OrderItemsController extends AppController
        {
            public function fetchOrderItems(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->OrderItems->find('all')->toArray();
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

            public function fetchorderItem($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->OrderItems->get($id);
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

            public function addOrderItems(): Response
            {
                $this->request->allowMethod(['post']);

                $orderItem = $this->OrderItems->newEmptyEntity();
                $orderItem = $this->OrderItems->patchEntity($orderItem, $this->request->getData());

                if ($this->OrderItems->save($orderItem)) {
                    $response = [
                        'status' => 'success',
                        'data' => $orderItem
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add order item'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editOrderItems($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $orderItem = $this->OrderItems->get($id);
                $orderItem = $this->OrderItems->patchEntity($orderItem, $this->request->getData());

                if ($this->OrderItems->save($orderItem)) {
                    $response = [
                        'status' => 'success',
                        'data' => $orderItem
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update order item'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteOrderItems($id): Response
            {
                $this->request->allowMethod(['delete']);

                $orderItem = $this->OrderItems->get($id);

                if ($this->OrderItems->delete($orderItem)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'order item deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete order item'
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
        # OrderItems routes template prefix API   

        # OrderItems routes API
        $routes->connect('/OrderItems', ['controller' => 'OrderItems', 'action' => 'fetchOrderItems', 'method' => 'GET']);
        $routes->connect('/OrderItems/:id', ['controller' => 'OrderItems', 'action' => 'fetchorderItem', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/OrderItems-add', ['controller' => 'OrderItems', 'action' => 'addOrderItems', 'method' => 'POST']);
        $routes->connect('/OrderItems-edit/:id', ['controller' => 'OrderItems', 'action' => 'editOrderItems', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/OrderItems-delete/:id', ['controller' => 'OrderItems', 'action' => 'deleteOrderItems', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # orderItems routes simple template prefix /
        
        # orderItems routes
        $routes->connect('/OrderItems', ['controller' => 'OrderItems', 'action' => 'index']);
        $routes->connect('/OrderItems/view/:id', ['controller' => 'OrderItems', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
