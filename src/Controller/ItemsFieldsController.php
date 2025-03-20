<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class ItemsFieldsController extends AppController
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
        if (!$this->checkPermission('ItemsFields/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(ItemsFields.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemsFields.item_type_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemsFields.field_name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemsFields.field_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemsFields.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemsFields.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->ItemsFields->find('all', [
            'conditions' => $conditions,
            'contain' => ['ItemTypes'],
        ]);

        $itemsFields = $this->paginate($query);

        $itemTypes = $this->ItemsFields->ItemTypes->find('list', ['limit' => 200])->all();

        $this->set(compact('itemsFields', 'itemTypes'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('ItemsFields/index')) {
            return;
        }

        $itemsField = $this->ItemsFields->get($id, [
            'contain' => ['ItemTypes'],
        ]);

        $this->set(compact('itemsField'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('ItemsFields/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemsField = $this->ItemsFields->newEmptyEntity();

        if ($this->request->is('post')) {

            $itemsField = $this->ItemsFields->patchEntity($itemsField, $this->request->getData());

            if ($this->ItemsFields->save($itemsField)) {
                $this->Flash->success(__('O items field foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O items field não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $itemTypes = $this->ItemsFields->ItemTypes->find('list', ['limit' => 200])->all();

        $this->set(compact('itemsField', 'itemTypes'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('ItemsFields/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemsField = $this->ItemsFields->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $itemsField = $this->ItemsFields->patchEntity($itemsField, $this->request->getData());

            if ($this->ItemsFields->save($itemsField)) {
                $this->Flash->success(__('O items field foi editado com sucesso.'));
                $this->log('O items field foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O items field não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $itemTypes = $this->ItemsFields->ItemTypes->find('list', ['limit' => 200])->all();

        $this->set(compact('itemsField', 'itemTypes'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('ItemsFields/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $itemsField = $this->ItemsFields->get($id);

        if ($this->ItemsFields->delete($itemsField)) {
            $this->log('O items field foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O items field foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O items field não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('ItemsFields/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemsFields = $this->ItemsFields->find('all', [
            'contain' => ['ItemTypes'],
        ]);

        $csvData = [];
        $header = ['id', 'item_type_id', 'field_name', 'field_type', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($itemsFields as $ItemsFields) {
            $csvData[] = [
                $ItemsFields->id,
                $ItemsFields->item_type_id,
                $ItemsFields->field_name,
                $ItemsFields->field_type,
                $ItemsFields->created,
                $ItemsFields->modified
            ];
        }

        $filename = 'itemsFields_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/ItemsFieldsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/itemsFields
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class ItemsFieldsController extends AppController
        {
            public function fetchItemsFields(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ItemsFields->find('all')->toArray();
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

            public function fetchitemsField($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ItemsFields->get($id);
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

            public function addItemsFields(): Response
            {
                $this->request->allowMethod(['post']);

                $itemsField = $this->ItemsFields->newEmptyEntity();
                $itemsField = $this->ItemsFields->patchEntity($itemsField, $this->request->getData());

                if ($this->ItemsFields->save($itemsField)) {
                    $response = [
                        'status' => 'success',
                        'data' => $itemsField
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add items field'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editItemsFields($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $itemsField = $this->ItemsFields->get($id);
                $itemsField = $this->ItemsFields->patchEntity($itemsField, $this->request->getData());

                if ($this->ItemsFields->save($itemsField)) {
                    $response = [
                        'status' => 'success',
                        'data' => $itemsField
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update items field'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteItemsFields($id): Response
            {
                $this->request->allowMethod(['delete']);

                $itemsField = $this->ItemsFields->get($id);

                if ($this->ItemsFields->delete($itemsField)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'items field deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete items field'
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
        # ItemsFields routes template prefix API   

        # ItemsFields routes API
        $routes->connect('/ItemsFields', ['controller' => 'ItemsFields', 'action' => 'fetchItemsFields', 'method' => 'GET']);
        $routes->connect('/ItemsFields/:id', ['controller' => 'ItemsFields', 'action' => 'fetchitemsField', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ItemsFields-add', ['controller' => 'ItemsFields', 'action' => 'addItemsFields', 'method' => 'POST']);
        $routes->connect('/ItemsFields-edit/:id', ['controller' => 'ItemsFields', 'action' => 'editItemsFields', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ItemsFields-delete/:id', ['controller' => 'ItemsFields', 'action' => 'deleteItemsFields', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # itemsFields routes simple template prefix /
        
        # itemsFields routes
        $routes->connect('/ItemsFields', ['controller' => 'ItemsFields', 'action' => 'index']);
        $routes->connect('/ItemsFields/view/:id', ['controller' => 'ItemsFields', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
