<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class ItemsController extends AppController
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
        if (!$this->checkPermission('Items/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Items.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.quantity AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.unit_price AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.available_for_use AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.for_sale AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.local_storage AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.item_type_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.supplier_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.storage_location_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Items.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Items->find('all', [
            'conditions' => $conditions,
            'contain' => ['ItemTypes', 'Suppliers', 'StorageLocations', 'ItemLogs', 'ItemValues', 'OrderItems'],
        ]);

        $items = $this->paginate($query);

        $itemTypes = $this->Items->ItemTypes->find('list', ['limit' => 200])->all();
        $suppliers = $this->Items->Suppliers->find('list', ['limit' => 200])->all();
        $storageLocations = $this->Items->StorageLocations->find('list', ['limit' => 200])->all();

        $this->set(compact('items', 'itemTypes', 'suppliers', 'storageLocations'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Items/index')) {
            return;
        }

        $item = $this->Items->get($id, [
            'contain' => ['ItemTypes', 'Suppliers', 'StorageLocations', 'ItemLogs', 'ItemValues', 'OrderItems'],
        ]);

        $this->set(compact('item'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Items/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $item = $this->Items->newEmptyEntity();

        if ($this->request->is('post')) {

            $item = $this->Items->patchEntity($item, $this->request->getData());

            if ($this->Items->save($item)) {
                $this->Flash->success(__('O item foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O item não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $itemTypes = $this->Items->ItemTypes->find('list', ['limit' => 200])->all();
        $suppliers = $this->Items->Suppliers->find('list', ['limit' => 200])->all();
        $storageLocations = $this->Items->StorageLocations->find('list', ['limit' => 200])->all();

        $this->set(compact('item', 'itemTypes', 'suppliers', 'storageLocations'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Items/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $item = $this->Items->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $item = $this->Items->patchEntity($item, $this->request->getData());

            if ($this->Items->save($item)) {
                $this->Flash->success(__('O item foi editado com sucesso.'));
                $this->log('O item foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O item não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $itemTypes = $this->Items->ItemTypes->find('list', ['limit' => 200])->all();
        $suppliers = $this->Items->Suppliers->find('list', ['limit' => 200])->all();
        $storageLocations = $this->Items->StorageLocations->find('list', ['limit' => 200])->all();

        $this->set(compact('item', 'itemTypes', 'suppliers', 'storageLocations'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Items/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $item = $this->Items->get($id);

        if ($this->Items->delete($item)) {
            $this->log('O item foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O item foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O item não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Items/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $items = $this->Items->find('all', [
            'contain' => ['ItemTypes', 'Suppliers', 'StorageLocations', 'ItemLogs', 'ItemValues', 'OrderItems'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'description', 'quantity', 'unit_price', 'available_for_use', 'for_sale', 'local_storage', 'item_type_id', 'supplier_id', 'storage_location_id', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($items as $Items) {
            $csvData[] = [
                $Items->id,
                $Items->name,
                $Items->description,
                $Items->quantity,
                $Items->unit_price,
                $Items->available_for_use,
                $Items->for_sale,
                $Items->local_storage,
                $Items->item_type_id,
                $Items->supplier_id,
                $Items->storage_location_id,
                $Items->created,
                $Items->modified
            ];
        }

        $filename = 'items_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/ItemsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/items
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class ItemsController extends AppController
        {
            public function fetchItems(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Items->find('all')->toArray();
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

            public function fetchitem($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Items->get($id);
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

            public function addItems(): Response
            {
                $this->request->allowMethod(['post']);

                $item = $this->Items->newEmptyEntity();
                $item = $this->Items->patchEntity($item, $this->request->getData());

                if ($this->Items->save($item)) {
                    $response = [
                        'status' => 'success',
                        'data' => $item
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add item'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editItems($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $item = $this->Items->get($id);
                $item = $this->Items->patchEntity($item, $this->request->getData());

                if ($this->Items->save($item)) {
                    $response = [
                        'status' => 'success',
                        'data' => $item
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update item'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteItems($id): Response
            {
                $this->request->allowMethod(['delete']);

                $item = $this->Items->get($id);

                if ($this->Items->delete($item)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'item deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete item'
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
        # Items routes template prefix API   

        # Items routes API
        $routes->connect('/Items', ['controller' => 'Items', 'action' => 'fetchItems', 'method' => 'GET']);
        $routes->connect('/Items/:id', ['controller' => 'Items', 'action' => 'fetchitem', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Items-add', ['controller' => 'Items', 'action' => 'addItems', 'method' => 'POST']);
        $routes->connect('/Items-edit/:id', ['controller' => 'Items', 'action' => 'editItems', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Items-delete/:id', ['controller' => 'Items', 'action' => 'deleteItems', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # items routes simple template prefix /
        
        # items routes
        $routes->connect('/Items', ['controller' => 'Items', 'action' => 'index']);
        $routes->connect('/Items/view/:id', ['controller' => 'Items', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
