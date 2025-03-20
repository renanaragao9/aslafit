<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class AddressesController extends AppController
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
        if (!$this->checkPermission('Addresses/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Addresses.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.addressable_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.addressable_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.zipcode AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.address AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.number AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.complement AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.neighborhood AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.city AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.state AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.latitude AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.longitude AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Addresses.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Addresses->find('all', [
            'conditions' => $conditions,
            'contain' => [],
        ]);

        $addresses = $this->paginate($query);


        $this->set(compact('addresses',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Addresses/index')) {
            return;
        }

        $address = $this->Addresses->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('address'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Addresses/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $address = $this->Addresses->newEmptyEntity();

        if ($this->request->is('post')) {

            $address = $this->Addresses->patchEntity($address, $this->request->getData());

            if ($this->Addresses->save($address)) {
                $this->Flash->success(__('O address foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O address não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('address'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Addresses/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $address = $this->Addresses->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $address = $this->Addresses->patchEntity($address, $this->request->getData());

            if ($this->Addresses->save($address)) {
                $this->Flash->success(__('O address foi editado com sucesso.'));
                $this->log('O address foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O address não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('address'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Addresses/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $address = $this->Addresses->get($id);

        if ($this->Addresses->delete($address)) {
            $this->log('O address foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O address foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O address não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Addresses/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $addresses = $this->Addresses->find('all', [
            'contain' => [],
        ]);

        $csvData = [];
        $header = ['id', 'addressable_type', 'addressable_id', 'zipcode', 'address', 'number', 'complement', 'neighborhood', 'city', 'state', 'latitude', 'longitude', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($addresses as $Addresses) {
            $csvData[] = [
                $Addresses->id,
                $Addresses->addressable_type,
                $Addresses->addressable_id,
                $Addresses->zipcode,
                $Addresses->address,
                $Addresses->number,
                $Addresses->complement,
                $Addresses->neighborhood,
                $Addresses->city,
                $Addresses->state,
                $Addresses->latitude,
                $Addresses->longitude,
                $Addresses->active,
                $Addresses->created,
                $Addresses->modified
            ];
        }

        $filename = 'addresses_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/AddressesController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/addresses
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class AddressesController extends AppController
        {
            public function fetchAddresses(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Addresses->find('all')->toArray();
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

            public function fetchaddress($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Addresses->get($id);
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

            public function addAddresses(): Response
            {
                $this->request->allowMethod(['post']);

                $address = $this->Addresses->newEmptyEntity();
                $address = $this->Addresses->patchEntity($address, $this->request->getData());

                if ($this->Addresses->save($address)) {
                    $response = [
                        'status' => 'success',
                        'data' => $address
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add address'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editAddresses($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $address = $this->Addresses->get($id);
                $address = $this->Addresses->patchEntity($address, $this->request->getData());

                if ($this->Addresses->save($address)) {
                    $response = [
                        'status' => 'success',
                        'data' => $address
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update address'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteAddresses($id): Response
            {
                $this->request->allowMethod(['delete']);

                $address = $this->Addresses->get($id);

                if ($this->Addresses->delete($address)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'address deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete address'
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
        # Addresses routes template prefix API   

        # Addresses routes API
        $routes->connect('/Addresses', ['controller' => 'Addresses', 'action' => 'fetchAddresses', 'method' => 'GET']);
        $routes->connect('/Addresses/:id', ['controller' => 'Addresses', 'action' => 'fetchaddress', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Addresses-add', ['controller' => 'Addresses', 'action' => 'addAddresses', 'method' => 'POST']);
        $routes->connect('/Addresses-edit/:id', ['controller' => 'Addresses', 'action' => 'editAddresses', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Addresses-delete/:id', ['controller' => 'Addresses', 'action' => 'deleteAddresses', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # addresses routes simple template prefix /
        
        # addresses routes
        $routes->connect('/Addresses', ['controller' => 'Addresses', 'action' => 'index']);
        $routes->connect('/Addresses/view/:id', ['controller' => 'Addresses', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
