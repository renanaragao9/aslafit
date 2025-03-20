<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class StorageLocationsController extends AppController
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
        if (!$this->checkPermission('StorageLocations/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(StorageLocations.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StorageLocations.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StorageLocations.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StorageLocations.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StorageLocations.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StorageLocations.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->StorageLocations->find('all', [
            'conditions' => $conditions,
            'contain' => ['Items'],
        ]);

        $storageLocations = $this->paginate($query);


        $this->set(compact('storageLocations',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('StorageLocations/index')) {
            return;
        }

        $storageLocation = $this->StorageLocations->get($id, [
            'contain' => ['Items'],
        ]);

        $this->set(compact('storageLocation'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('StorageLocations/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $storageLocation = $this->StorageLocations->newEmptyEntity();

        if ($this->request->is('post')) {

            $storageLocation = $this->StorageLocations->patchEntity($storageLocation, $this->request->getData());

            if ($this->StorageLocations->save($storageLocation)) {
                $this->Flash->success(__('O storage location foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O storage location não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('storageLocation'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('StorageLocations/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $storageLocation = $this->StorageLocations->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $storageLocation = $this->StorageLocations->patchEntity($storageLocation, $this->request->getData());

            if ($this->StorageLocations->save($storageLocation)) {
                $this->Flash->success(__('O storage location foi editado com sucesso.'));
                $this->log('O storage location foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O storage location não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('storageLocation'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('StorageLocations/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $storageLocation = $this->StorageLocations->get($id);

        if ($this->StorageLocations->delete($storageLocation)) {
            $this->log('O storage location foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O storage location foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O storage location não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('StorageLocations/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $storageLocations = $this->StorageLocations->find('all', [
            'contain' => ['Items'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'description', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($storageLocations as $StorageLocations) {
            $csvData[] = [
                $StorageLocations->id,
                $StorageLocations->name,
                $StorageLocations->description,
                $StorageLocations->active,
                $StorageLocations->created,
                $StorageLocations->modified
            ];
        }

        $filename = 'storageLocations_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/StorageLocationsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/storageLocations
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class StorageLocationsController extends AppController
        {
            public function fetchStorageLocations(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->StorageLocations->find('all')->toArray();
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

            public function fetchstorageLocation($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->StorageLocations->get($id);
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

            public function addStorageLocations(): Response
            {
                $this->request->allowMethod(['post']);

                $storageLocation = $this->StorageLocations->newEmptyEntity();
                $storageLocation = $this->StorageLocations->patchEntity($storageLocation, $this->request->getData());

                if ($this->StorageLocations->save($storageLocation)) {
                    $response = [
                        'status' => 'success',
                        'data' => $storageLocation
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add storage location'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editStorageLocations($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $storageLocation = $this->StorageLocations->get($id);
                $storageLocation = $this->StorageLocations->patchEntity($storageLocation, $this->request->getData());

                if ($this->StorageLocations->save($storageLocation)) {
                    $response = [
                        'status' => 'success',
                        'data' => $storageLocation
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update storage location'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteStorageLocations($id): Response
            {
                $this->request->allowMethod(['delete']);

                $storageLocation = $this->StorageLocations->get($id);

                if ($this->StorageLocations->delete($storageLocation)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'storage location deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete storage location'
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
        # StorageLocations routes template prefix API   

        # StorageLocations routes API
        $routes->connect('/StorageLocations', ['controller' => 'StorageLocations', 'action' => 'fetchStorageLocations', 'method' => 'GET']);
        $routes->connect('/StorageLocations/:id', ['controller' => 'StorageLocations', 'action' => 'fetchstorageLocation', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/StorageLocations-add', ['controller' => 'StorageLocations', 'action' => 'addStorageLocations', 'method' => 'POST']);
        $routes->connect('/StorageLocations-edit/:id', ['controller' => 'StorageLocations', 'action' => 'editStorageLocations', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/StorageLocations-delete/:id', ['controller' => 'StorageLocations', 'action' => 'deleteStorageLocations', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # storageLocations routes simple template prefix /
        
        # storageLocations routes
        $routes->connect('/StorageLocations', ['controller' => 'StorageLocations', 'action' => 'index']);
        $routes->connect('/StorageLocations/view/:id', ['controller' => 'StorageLocations', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
