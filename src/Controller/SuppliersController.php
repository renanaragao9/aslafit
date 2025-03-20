<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class SuppliersController extends AppController
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
        if (!$this->checkPermission('Suppliers/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Suppliers.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Suppliers.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Suppliers.contact_info AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Suppliers.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Suppliers.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Suppliers.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Suppliers->find('all', [
            'conditions' => $conditions,
            'contain' => ['Items'],
        ]);

        $suppliers = $this->paginate($query);


        $this->set(compact('suppliers',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Suppliers/index')) {
            return;
        }

        $supplier = $this->Suppliers->get($id, [
            'contain' => ['Items'],
        ]);

        $this->set(compact('supplier'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Suppliers/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $supplier = $this->Suppliers->newEmptyEntity();

        if ($this->request->is('post')) {

            $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData());

            if ($this->Suppliers->save($supplier)) {
                $this->Flash->success(__('O supplier foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O supplier não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('supplier'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Suppliers/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $supplier = $this->Suppliers->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData());

            if ($this->Suppliers->save($supplier)) {
                $this->Flash->success(__('O supplier foi editado com sucesso.'));
                $this->log('O supplier foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O supplier não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('supplier'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Suppliers/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $supplier = $this->Suppliers->get($id);

        if ($this->Suppliers->delete($supplier)) {
            $this->log('O supplier foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O supplier foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O supplier não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Suppliers/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $suppliers = $this->Suppliers->find('all', [
            'contain' => ['Items'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'contact_info', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($suppliers as $Suppliers) {
            $csvData[] = [
                $Suppliers->id,
                $Suppliers->name,
                $Suppliers->contact_info,
                $Suppliers->active,
                $Suppliers->created,
                $Suppliers->modified
            ];
        }

        $filename = 'suppliers_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/SuppliersController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/suppliers
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class SuppliersController extends AppController
        {
            public function fetchSuppliers(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Suppliers->find('all')->toArray();
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

            public function fetchsupplier($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Suppliers->get($id);
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

            public function addSuppliers(): Response
            {
                $this->request->allowMethod(['post']);

                $supplier = $this->Suppliers->newEmptyEntity();
                $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData());

                if ($this->Suppliers->save($supplier)) {
                    $response = [
                        'status' => 'success',
                        'data' => $supplier
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add supplier'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editSuppliers($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $supplier = $this->Suppliers->get($id);
                $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData());

                if ($this->Suppliers->save($supplier)) {
                    $response = [
                        'status' => 'success',
                        'data' => $supplier
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update supplier'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteSuppliers($id): Response
            {
                $this->request->allowMethod(['delete']);

                $supplier = $this->Suppliers->get($id);

                if ($this->Suppliers->delete($supplier)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'supplier deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete supplier'
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
        # Suppliers routes template prefix API   

        # Suppliers routes API
        $routes->connect('/Suppliers', ['controller' => 'Suppliers', 'action' => 'fetchSuppliers', 'method' => 'GET']);
        $routes->connect('/Suppliers/:id', ['controller' => 'Suppliers', 'action' => 'fetchsupplier', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Suppliers-add', ['controller' => 'Suppliers', 'action' => 'addSuppliers', 'method' => 'POST']);
        $routes->connect('/Suppliers-edit/:id', ['controller' => 'Suppliers', 'action' => 'editSuppliers', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Suppliers-delete/:id', ['controller' => 'Suppliers', 'action' => 'deleteSuppliers', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # suppliers routes simple template prefix /
        
        # suppliers routes
        $routes->connect('/Suppliers', ['controller' => 'Suppliers', 'action' => 'index']);
        $routes->connect('/Suppliers/view/:id', ['controller' => 'Suppliers', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
