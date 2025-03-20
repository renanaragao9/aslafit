<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class EventsController extends AppController
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
        if (!$this->checkPermission('Events/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Events.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Events.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Events.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Events.date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Events.location AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Events.max_participants AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Events.collaborator_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Events.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Events.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Events->find('all', [
            'conditions' => $conditions,
            'contain' => ['Collaborators', 'EventRegistrations'],
        ]);

        $events = $this->paginate($query);

        $collaborators = $this->Events->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('events', 'collaborators'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Events/index')) {
            return;
        }

        $event = $this->Events->get($id, [
            'contain' => ['Collaborators', 'EventRegistrations'],
        ]);

        $this->set(compact('event'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Events/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $event = $this->Events->newEmptyEntity();

        if ($this->request->is('post')) {

            $event = $this->Events->patchEntity($event, $this->request->getData());

            if ($this->Events->save($event)) {
                $this->Flash->success(__('O event foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O event não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $collaborators = $this->Events->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('event', 'collaborators'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Events/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $event = $this->Events->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $event = $this->Events->patchEntity($event, $this->request->getData());

            if ($this->Events->save($event)) {
                $this->Flash->success(__('O event foi editado com sucesso.'));
                $this->log('O event foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O event não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $collaborators = $this->Events->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('event', 'collaborators'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Events/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $event = $this->Events->get($id);

        if ($this->Events->delete($event)) {
            $this->log('O event foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O event foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O event não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Events/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $events = $this->Events->find('all', [
            'contain' => ['Collaborators', 'EventRegistrations'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'description', 'date', 'location', 'max_participants', 'collaborator_id', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($events as $Events) {
            $csvData[] = [
                $Events->id,
                $Events->name,
                $Events->description,
                $Events->date,
                $Events->location,
                $Events->max_participants,
                $Events->collaborator_id,
                $Events->created,
                $Events->modified
            ];
        }

        $filename = 'events_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/EventsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/events
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class EventsController extends AppController
        {
            public function fetchEvents(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Events->find('all')->toArray();
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

            public function fetchevent($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Events->get($id);
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

            public function addEvents(): Response
            {
                $this->request->allowMethod(['post']);

                $event = $this->Events->newEmptyEntity();
                $event = $this->Events->patchEntity($event, $this->request->getData());

                if ($this->Events->save($event)) {
                    $response = [
                        'status' => 'success',
                        'data' => $event
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add event'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editEvents($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $event = $this->Events->get($id);
                $event = $this->Events->patchEntity($event, $this->request->getData());

                if ($this->Events->save($event)) {
                    $response = [
                        'status' => 'success',
                        'data' => $event
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update event'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteEvents($id): Response
            {
                $this->request->allowMethod(['delete']);

                $event = $this->Events->get($id);

                if ($this->Events->delete($event)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'event deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete event'
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
        # Events routes template prefix API   

        # Events routes API
        $routes->connect('/Events', ['controller' => 'Events', 'action' => 'fetchEvents', 'method' => 'GET']);
        $routes->connect('/Events/:id', ['controller' => 'Events', 'action' => 'fetchevent', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Events-add', ['controller' => 'Events', 'action' => 'addEvents', 'method' => 'POST']);
        $routes->connect('/Events-edit/:id', ['controller' => 'Events', 'action' => 'editEvents', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Events-delete/:id', ['controller' => 'Events', 'action' => 'deleteEvents', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # events routes simple template prefix /
        
        # events routes
        $routes->connect('/Events', ['controller' => 'Events', 'action' => 'index']);
        $routes->connect('/Events/view/:id', ['controller' => 'Events', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
