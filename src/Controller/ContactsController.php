<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class ContactsController extends AppController
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
        if (!$this->checkPermission('Contacts/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Contacts.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Contacts.contactable_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Contacts.contactable_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Contacts.contact_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Contacts.contact_value AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Contacts.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Contacts.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Contacts.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Contacts->find('all', [
            'conditions' => $conditions,
            'contain' => [],
        ]);

        $contacts = $this->paginate($query);


        $this->set(compact('contacts',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Contacts/index')) {
            return;
        }

        $contact = $this->Contacts->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('contact'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Contacts/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $contact = $this->Contacts->newEmptyEntity();

        if ($this->request->is('post')) {

            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('O contact foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O contact não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('contact'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Contacts/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $contact = $this->Contacts->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('O contact foi editado com sucesso.'));
                $this->log('O contact foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O contact não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('contact'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Contacts/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $contact = $this->Contacts->get($id);

        if ($this->Contacts->delete($contact)) {
            $this->log('O contact foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O contact foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O contact não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Contacts/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $contacts = $this->Contacts->find('all', [
            'contain' => [],
        ]);

        $csvData = [];
        $header = ['id', 'contactable_type', 'contactable_id', 'contact_type', 'contact_value', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($contacts as $Contacts) {
            $csvData[] = [
                $Contacts->id,
                $Contacts->contactable_type,
                $Contacts->contactable_id,
                $Contacts->contact_type,
                $Contacts->contact_value,
                $Contacts->active,
                $Contacts->created,
                $Contacts->modified
            ];
        }

        $filename = 'contacts_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/ContactsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/contacts
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class ContactsController extends AppController
        {
            public function fetchContacts(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Contacts->find('all')->toArray();
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

            public function fetchcontact($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Contacts->get($id);
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

            public function addContacts(): Response
            {
                $this->request->allowMethod(['post']);

                $contact = $this->Contacts->newEmptyEntity();
                $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

                if ($this->Contacts->save($contact)) {
                    $response = [
                        'status' => 'success',
                        'data' => $contact
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add contact'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editContacts($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $contact = $this->Contacts->get($id);
                $contact = $this->Contacts->patchEntity($contact, $this->request->getData());

                if ($this->Contacts->save($contact)) {
                    $response = [
                        'status' => 'success',
                        'data' => $contact
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update contact'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteContacts($id): Response
            {
                $this->request->allowMethod(['delete']);

                $contact = $this->Contacts->get($id);

                if ($this->Contacts->delete($contact)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'contact deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete contact'
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
        # Contacts routes template prefix API   

        # Contacts routes API
        $routes->connect('/Contacts', ['controller' => 'Contacts', 'action' => 'fetchContacts', 'method' => 'GET']);
        $routes->connect('/Contacts/:id', ['controller' => 'Contacts', 'action' => 'fetchcontact', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Contacts-add', ['controller' => 'Contacts', 'action' => 'addContacts', 'method' => 'POST']);
        $routes->connect('/Contacts-edit/:id', ['controller' => 'Contacts', 'action' => 'editContacts', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Contacts-delete/:id', ['controller' => 'Contacts', 'action' => 'deleteContacts', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # contacts routes simple template prefix /
        
        # contacts routes
        $routes->connect('/Contacts', ['controller' => 'Contacts', 'action' => 'index']);
        $routes->connect('/Contacts/view/:id', ['controller' => 'Contacts', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
