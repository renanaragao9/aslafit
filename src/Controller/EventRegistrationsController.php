<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class EventRegistrationsController extends AppController
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
        if (!$this->checkPermission('EventRegistrations/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(EventRegistrations.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(EventRegistrations.event_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(EventRegistrations.student_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(EventRegistrations.confirmed AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(EventRegistrations.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(EventRegistrations.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->EventRegistrations->find('all', [
            'conditions' => $conditions,
            'contain' => ['Events', 'Students'],
        ]);

        $eventRegistrations = $this->paginate($query);

        $events = $this->EventRegistrations->Events->find('list', ['limit' => 200])->all();
        $students = $this->EventRegistrations->Students->find('list', ['limit' => 200])->all();

        $this->set(compact('eventRegistrations', 'events', 'students'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('EventRegistrations/index')) {
            return;
        }

        $eventRegistration = $this->EventRegistrations->get($id, [
            'contain' => ['Events', 'Students'],
        ]);

        $this->set(compact('eventRegistration'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('EventRegistrations/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $eventRegistration = $this->EventRegistrations->newEmptyEntity();

        if ($this->request->is('post')) {

            $eventRegistration = $this->EventRegistrations->patchEntity($eventRegistration, $this->request->getData());

            if ($this->EventRegistrations->save($eventRegistration)) {
                $this->Flash->success(__('O event registration foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O event registration não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $events = $this->EventRegistrations->Events->find('list', ['limit' => 200])->all();
        $students = $this->EventRegistrations->Students->find('list', ['limit' => 200])->all();

        $this->set(compact('eventRegistration', 'events', 'students'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('EventRegistrations/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $eventRegistration = $this->EventRegistrations->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $eventRegistration = $this->EventRegistrations->patchEntity($eventRegistration, $this->request->getData());

            if ($this->EventRegistrations->save($eventRegistration)) {
                $this->Flash->success(__('O event registration foi editado com sucesso.'));
                $this->log('O event registration foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O event registration não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $events = $this->EventRegistrations->Events->find('list', ['limit' => 200])->all();
        $students = $this->EventRegistrations->Students->find('list', ['limit' => 200])->all();

        $this->set(compact('eventRegistration', 'events', 'students'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('EventRegistrations/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $eventRegistration = $this->EventRegistrations->get($id);

        if ($this->EventRegistrations->delete($eventRegistration)) {
            $this->log('O event registration foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O event registration foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O event registration não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('EventRegistrations/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $eventRegistrations = $this->EventRegistrations->find('all', [
            'contain' => ['Events', 'Students'],
        ]);

        $csvData = [];
        $header = ['id', 'event_id', 'student_id', 'confirmed', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($eventRegistrations as $EventRegistrations) {
            $csvData[] = [
                $EventRegistrations->id,
                $EventRegistrations->event_id,
                $EventRegistrations->student_id,
                $EventRegistrations->confirmed,
                $EventRegistrations->created,
                $EventRegistrations->modified
            ];
        }

        $filename = 'eventRegistrations_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/EventRegistrationsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/eventRegistrations
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class EventRegistrationsController extends AppController
        {
            public function fetchEventRegistrations(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->EventRegistrations->find('all')->toArray();
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

            public function fetcheventRegistration($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->EventRegistrations->get($id);
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

            public function addEventRegistrations(): Response
            {
                $this->request->allowMethod(['post']);

                $eventRegistration = $this->EventRegistrations->newEmptyEntity();
                $eventRegistration = $this->EventRegistrations->patchEntity($eventRegistration, $this->request->getData());

                if ($this->EventRegistrations->save($eventRegistration)) {
                    $response = [
                        'status' => 'success',
                        'data' => $eventRegistration
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add event registration'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editEventRegistrations($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $eventRegistration = $this->EventRegistrations->get($id);
                $eventRegistration = $this->EventRegistrations->patchEntity($eventRegistration, $this->request->getData());

                if ($this->EventRegistrations->save($eventRegistration)) {
                    $response = [
                        'status' => 'success',
                        'data' => $eventRegistration
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update event registration'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteEventRegistrations($id): Response
            {
                $this->request->allowMethod(['delete']);

                $eventRegistration = $this->EventRegistrations->get($id);

                if ($this->EventRegistrations->delete($eventRegistration)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'event registration deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete event registration'
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
        # EventRegistrations routes template prefix API   

        # EventRegistrations routes API
        $routes->connect('/EventRegistrations', ['controller' => 'EventRegistrations', 'action' => 'fetchEventRegistrations', 'method' => 'GET']);
        $routes->connect('/EventRegistrations/:id', ['controller' => 'EventRegistrations', 'action' => 'fetcheventRegistration', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/EventRegistrations-add', ['controller' => 'EventRegistrations', 'action' => 'addEventRegistrations', 'method' => 'POST']);
        $routes->connect('/EventRegistrations-edit/:id', ['controller' => 'EventRegistrations', 'action' => 'editEventRegistrations', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/EventRegistrations-delete/:id', ['controller' => 'EventRegistrations', 'action' => 'deleteEventRegistrations', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # eventRegistrations routes simple template prefix /
        
        # eventRegistrations routes
        $routes->connect('/EventRegistrations', ['controller' => 'EventRegistrations', 'action' => 'index']);
        $routes->connect('/EventRegistrations/view/:id', ['controller' => 'EventRegistrations', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
