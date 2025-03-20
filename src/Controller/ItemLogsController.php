<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class ItemLogsController extends AppController
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
        if (!$this->checkPermission('ItemLogs/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(ItemLogs.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemLogs.item_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemLogs.location_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemLogs.available_for_use AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemLogs.for_sale AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemLogs.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemLogs.sold AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemLogs.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemLogs.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->ItemLogs->find('all', [
            'conditions' => $conditions,
            'contain' => ['Items', 'StorageLocations'],
        ]);

        $itemLogs = $this->paginate($query);

        $items = $this->ItemLogs->Items->find('list', ['limit' => 200])->all();
        $storageLocations = $this->ItemLogs->StorageLocations->find('list', ['limit' => 200])->all();

        $this->set(compact('itemLogs', 'items', 'storageLocations'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('ItemLogs/index')) {
            return;
        }

        $itemLog = $this->ItemLogs->get($id, [
            'contain' => ['Items', 'StorageLocations'],
        ]);

        $this->set(compact('itemLog'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('ItemLogs/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemLog = $this->ItemLogs->newEmptyEntity();

        if ($this->request->is('post')) {

            $itemLog = $this->ItemLogs->patchEntity($itemLog, $this->request->getData());

            if ($this->ItemLogs->save($itemLog)) {
                $this->Flash->success(__('O item log foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O item log não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $items = $this->ItemLogs->Items->find('list', ['limit' => 200])->all();
        $storageLocations = $this->ItemLogs->StorageLocations->find('list', ['limit' => 200])->all();

        $this->set(compact('itemLog', 'items', 'storageLocations'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('ItemLogs/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemLog = $this->ItemLogs->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $itemLog = $this->ItemLogs->patchEntity($itemLog, $this->request->getData());

            if ($this->ItemLogs->save($itemLog)) {
                $this->Flash->success(__('O item log foi editado com sucesso.'));
                $this->log('O item log foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O item log não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $items = $this->ItemLogs->Items->find('list', ['limit' => 200])->all();
        $storageLocations = $this->ItemLogs->StorageLocations->find('list', ['limit' => 200])->all();

        $this->set(compact('itemLog', 'items', 'storageLocations'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('ItemLogs/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $itemLog = $this->ItemLogs->get($id);

        if ($this->ItemLogs->delete($itemLog)) {
            $this->log('O item log foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O item log foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O item log não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('ItemLogs/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemLogs = $this->ItemLogs->find('all', [
            'contain' => ['Items', 'StorageLocations'],
        ]);

        $csvData = [];
        $header = ['id', 'item_id', 'location_id', 'available_for_use', 'for_sale', 'active', 'sold', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($itemLogs as $ItemLogs) {
            $csvData[] = [
                $ItemLogs->id,
                $ItemLogs->item_id,
                $ItemLogs->location_id,
                $ItemLogs->available_for_use,
                $ItemLogs->for_sale,
                $ItemLogs->active,
                $ItemLogs->sold,
                $ItemLogs->created,
                $ItemLogs->modified
            ];
        }

        $filename = 'itemLogs_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/ItemLogsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/itemLogs
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class ItemLogsController extends AppController
        {
            public function fetchItemLogs(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ItemLogs->find('all')->toArray();
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

            public function fetchitemLog($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ItemLogs->get($id);
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

            public function addItemLogs(): Response
            {
                $this->request->allowMethod(['post']);

                $itemLog = $this->ItemLogs->newEmptyEntity();
                $itemLog = $this->ItemLogs->patchEntity($itemLog, $this->request->getData());

                if ($this->ItemLogs->save($itemLog)) {
                    $response = [
                        'status' => 'success',
                        'data' => $itemLog
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add item log'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editItemLogs($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $itemLog = $this->ItemLogs->get($id);
                $itemLog = $this->ItemLogs->patchEntity($itemLog, $this->request->getData());

                if ($this->ItemLogs->save($itemLog)) {
                    $response = [
                        'status' => 'success',
                        'data' => $itemLog
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update item log'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteItemLogs($id): Response
            {
                $this->request->allowMethod(['delete']);

                $itemLog = $this->ItemLogs->get($id);

                if ($this->ItemLogs->delete($itemLog)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'item log deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete item log'
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
        # ItemLogs routes template prefix API   

        # ItemLogs routes API
        $routes->connect('/ItemLogs', ['controller' => 'ItemLogs', 'action' => 'fetchItemLogs', 'method' => 'GET']);
        $routes->connect('/ItemLogs/:id', ['controller' => 'ItemLogs', 'action' => 'fetchitemLog', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ItemLogs-add', ['controller' => 'ItemLogs', 'action' => 'addItemLogs', 'method' => 'POST']);
        $routes->connect('/ItemLogs-edit/:id', ['controller' => 'ItemLogs', 'action' => 'editItemLogs', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ItemLogs-delete/:id', ['controller' => 'ItemLogs', 'action' => 'deleteItemLogs', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # itemLogs routes simple template prefix /
        
        # itemLogs routes
        $routes->connect('/ItemLogs', ['controller' => 'ItemLogs', 'action' => 'index']);
        $routes->connect('/ItemLogs/view/:id', ['controller' => 'ItemLogs', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
