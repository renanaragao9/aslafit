<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class ItemValuesController extends AppController
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
        if (!$this->checkPermission('ItemValues/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(ItemValues.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemValues.item_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemValues.field_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemValues.value AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemValues.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemValues.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->ItemValues->find('all', [
            'conditions' => $conditions,
            'contain' => ['Items', 'ItemsFields'],
        ]);

        $itemValues = $this->paginate($query);

        $items = $this->ItemValues->Items->find('list', ['limit' => 200])->all();
        $itemsFields = $this->ItemValues->ItemsFields->find('list', ['limit' => 200])->all();

        $this->set(compact('itemValues', 'items', 'itemsFields'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('ItemValues/index')) {
            return;
        }

        $itemValue = $this->ItemValues->get($id, [
            'contain' => ['Items', 'ItemsFields'],
        ]);

        $this->set(compact('itemValue'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('ItemValues/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemValue = $this->ItemValues->newEmptyEntity();

        if ($this->request->is('post')) {

            $itemValue = $this->ItemValues->patchEntity($itemValue, $this->request->getData());

            if ($this->ItemValues->save($itemValue)) {
                $this->Flash->success(__('O item value foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O item value não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $items = $this->ItemValues->Items->find('list', ['limit' => 200])->all();
        $itemsFields = $this->ItemValues->ItemsFields->find('list', ['limit' => 200])->all();

        $this->set(compact('itemValue', 'items', 'itemsFields'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('ItemValues/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemValue = $this->ItemValues->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $itemValue = $this->ItemValues->patchEntity($itemValue, $this->request->getData());

            if ($this->ItemValues->save($itemValue)) {
                $this->Flash->success(__('O item value foi editado com sucesso.'));
                $this->log('O item value foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O item value não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $items = $this->ItemValues->Items->find('list', ['limit' => 200])->all();
        $itemsFields = $this->ItemValues->ItemsFields->find('list', ['limit' => 200])->all();

        $this->set(compact('itemValue', 'items', 'itemsFields'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('ItemValues/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $itemValue = $this->ItemValues->get($id);

        if ($this->ItemValues->delete($itemValue)) {
            $this->log('O item value foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O item value foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O item value não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('ItemValues/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemValues = $this->ItemValues->find('all', [
            'contain' => ['Items', 'ItemsFields'],
        ]);

        $csvData = [];
        $header = ['id', 'item_id', 'field_id', 'value', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($itemValues as $ItemValues) {
            $csvData[] = [
                $ItemValues->id,
                $ItemValues->item_id,
                $ItemValues->field_id,
                $ItemValues->value,
                $ItemValues->created,
                $ItemValues->modified
            ];
        }

        $filename = 'itemValues_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/ItemValuesController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/itemValues
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class ItemValuesController extends AppController
        {
            public function fetchItemValues(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ItemValues->find('all')->toArray();
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

            public function fetchitemValue($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ItemValues->get($id);
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

            public function addItemValues(): Response
            {
                $this->request->allowMethod(['post']);

                $itemValue = $this->ItemValues->newEmptyEntity();
                $itemValue = $this->ItemValues->patchEntity($itemValue, $this->request->getData());

                if ($this->ItemValues->save($itemValue)) {
                    $response = [
                        'status' => 'success',
                        'data' => $itemValue
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add item value'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editItemValues($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $itemValue = $this->ItemValues->get($id);
                $itemValue = $this->ItemValues->patchEntity($itemValue, $this->request->getData());

                if ($this->ItemValues->save($itemValue)) {
                    $response = [
                        'status' => 'success',
                        'data' => $itemValue
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update item value'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteItemValues($id): Response
            {
                $this->request->allowMethod(['delete']);

                $itemValue = $this->ItemValues->get($id);

                if ($this->ItemValues->delete($itemValue)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'item value deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete item value'
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
        # ItemValues routes template prefix API   

        # ItemValues routes API
        $routes->connect('/ItemValues', ['controller' => 'ItemValues', 'action' => 'fetchItemValues', 'method' => 'GET']);
        $routes->connect('/ItemValues/:id', ['controller' => 'ItemValues', 'action' => 'fetchitemValue', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ItemValues-add', ['controller' => 'ItemValues', 'action' => 'addItemValues', 'method' => 'POST']);
        $routes->connect('/ItemValues-edit/:id', ['controller' => 'ItemValues', 'action' => 'editItemValues', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ItemValues-delete/:id', ['controller' => 'ItemValues', 'action' => 'deleteItemValues', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # itemValues routes simple template prefix /
        
        # itemValues routes
        $routes->connect('/ItemValues', ['controller' => 'ItemValues', 'action' => 'index']);
        $routes->connect('/ItemValues/view/:id', ['controller' => 'ItemValues', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
