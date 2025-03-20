<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class ItemTypesController extends AppController
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
        if (!$this->checkPermission('ItemTypes/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(ItemTypes.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemTypes.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemTypes.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemTypes.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemTypes.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ItemTypes.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->ItemTypes->find('all', [
            'conditions' => $conditions,
            'contain' => ['Items', 'ItemsFields'],
        ]);

        $itemTypes = $this->paginate($query);


        $this->set(compact('itemTypes',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('ItemTypes/index')) {
            return;
        }

        $itemType = $this->ItemTypes->get($id, [
            'contain' => ['Items', 'ItemsFields'],
        ]);

        $this->set(compact('itemType'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('ItemTypes/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemType = $this->ItemTypes->newEmptyEntity();

        if ($this->request->is('post')) {

            $itemType = $this->ItemTypes->patchEntity($itemType, $this->request->getData());

            if ($this->ItemTypes->save($itemType)) {
                $this->Flash->success(__('O item type foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O item type não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('itemType'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('ItemTypes/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemType = $this->ItemTypes->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $itemType = $this->ItemTypes->patchEntity($itemType, $this->request->getData());

            if ($this->ItemTypes->save($itemType)) {
                $this->Flash->success(__('O item type foi editado com sucesso.'));
                $this->log('O item type foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O item type não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('itemType'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('ItemTypes/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $itemType = $this->ItemTypes->get($id);

        if ($this->ItemTypes->delete($itemType)) {
            $this->log('O item type foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O item type foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O item type não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('ItemTypes/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $itemTypes = $this->ItemTypes->find('all', [
            'contain' => ['Items', 'ItemsFields'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'description', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($itemTypes as $ItemTypes) {
            $csvData[] = [
                $ItemTypes->id,
                $ItemTypes->name,
                $ItemTypes->description,
                $ItemTypes->active,
                $ItemTypes->created,
                $ItemTypes->modified
            ];
        }

        $filename = 'itemTypes_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/ItemTypesController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/itemTypes
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class ItemTypesController extends AppController
        {
            public function fetchItemTypes(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ItemTypes->find('all')->toArray();
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

            public function fetchitemType($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ItemTypes->get($id);
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

            public function addItemTypes(): Response
            {
                $this->request->allowMethod(['post']);

                $itemType = $this->ItemTypes->newEmptyEntity();
                $itemType = $this->ItemTypes->patchEntity($itemType, $this->request->getData());

                if ($this->ItemTypes->save($itemType)) {
                    $response = [
                        'status' => 'success',
                        'data' => $itemType
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add item type'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editItemTypes($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $itemType = $this->ItemTypes->get($id);
                $itemType = $this->ItemTypes->patchEntity($itemType, $this->request->getData());

                if ($this->ItemTypes->save($itemType)) {
                    $response = [
                        'status' => 'success',
                        'data' => $itemType
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update item type'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteItemTypes($id): Response
            {
                $this->request->allowMethod(['delete']);

                $itemType = $this->ItemTypes->get($id);

                if ($this->ItemTypes->delete($itemType)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'item type deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete item type'
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
        # ItemTypes routes template prefix API   

        # ItemTypes routes API
        $routes->connect('/ItemTypes', ['controller' => 'ItemTypes', 'action' => 'fetchItemTypes', 'method' => 'GET']);
        $routes->connect('/ItemTypes/:id', ['controller' => 'ItemTypes', 'action' => 'fetchitemType', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ItemTypes-add', ['controller' => 'ItemTypes', 'action' => 'addItemTypes', 'method' => 'POST']);
        $routes->connect('/ItemTypes-edit/:id', ['controller' => 'ItemTypes', 'action' => 'editItemTypes', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ItemTypes-delete/:id', ['controller' => 'ItemTypes', 'action' => 'deleteItemTypes', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # itemTypes routes simple template prefix /
        
        # itemTypes routes
        $routes->connect('/ItemTypes', ['controller' => 'ItemTypes', 'action' => 'index']);
        $routes->connect('/ItemTypes/view/:id', ['controller' => 'ItemTypes', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
