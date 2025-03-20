<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class CalledsController extends AppController
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
        if (!$this->checkPermission('Calleds/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Calleds.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Calleds.urgency AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Calleds.title AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Calleds.subject AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Calleds.status AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Calleds.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Calleds.collaborator_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Calleds.student_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Calleds.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Calleds.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Calleds->find('all', [
            'conditions' => $conditions,
            'contain' => ['Collaborators', 'Students'],
        ]);

        $calleds = $this->paginate($query);

        $collaborators = $this->Calleds->Collaborators->find('list', ['limit' => 200])->all();
        $students = $this->Calleds->Students->find('list', ['limit' => 200])->all();

        $this->set(compact('calleds', 'collaborators', 'students'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Calleds/index')) {
            return;
        }

        $called = $this->Calleds->get($id, [
            'contain' => ['Collaborators', 'Students'],
        ]);

        $this->set(compact('called'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Calleds/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $called = $this->Calleds->newEmptyEntity();

        if ($this->request->is('post')) {

            $called = $this->Calleds->patchEntity($called, $this->request->getData());

            if ($this->Calleds->save($called)) {
                $this->Flash->success(__('O called foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O called não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $collaborators = $this->Calleds->Collaborators->find('list', ['limit' => 200])->all();
        $students = $this->Calleds->Students->find('list', ['limit' => 200])->all();

        $this->set(compact('called', 'collaborators', 'students'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Calleds/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $called = $this->Calleds->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $called = $this->Calleds->patchEntity($called, $this->request->getData());

            if ($this->Calleds->save($called)) {
                $this->Flash->success(__('O called foi editado com sucesso.'));
                $this->log('O called foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O called não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $collaborators = $this->Calleds->Collaborators->find('list', ['limit' => 200])->all();
        $students = $this->Calleds->Students->find('list', ['limit' => 200])->all();

        $this->set(compact('called', 'collaborators', 'students'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Calleds/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $called = $this->Calleds->get($id);

        if ($this->Calleds->delete($called)) {
            $this->log('O called foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O called foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O called não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Calleds/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $calleds = $this->Calleds->find('all', [
            'contain' => ['Collaborators', 'Students'],
        ]);

        $csvData = [];
        $header = ['id', 'urgency', 'title', 'subject', 'status', 'active', 'collaborator_id', 'student_id', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($calleds as $Calleds) {
            $csvData[] = [
                $Calleds->id,
                $Calleds->urgency,
                $Calleds->title,
                $Calleds->subject,
                $Calleds->status,
                $Calleds->active,
                $Calleds->collaborator_id,
                $Calleds->student_id,
                $Calleds->created,
                $Calleds->modified
            ];
        }

        $filename = 'calleds_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/CalledsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/calleds
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class CalledsController extends AppController
        {
            public function fetchCalleds(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Calleds->find('all')->toArray();
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

            public function fetchcalled($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Calleds->get($id);
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

            public function addCalleds(): Response
            {
                $this->request->allowMethod(['post']);

                $called = $this->Calleds->newEmptyEntity();
                $called = $this->Calleds->patchEntity($called, $this->request->getData());

                if ($this->Calleds->save($called)) {
                    $response = [
                        'status' => 'success',
                        'data' => $called
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add called'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editCalleds($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $called = $this->Calleds->get($id);
                $called = $this->Calleds->patchEntity($called, $this->request->getData());

                if ($this->Calleds->save($called)) {
                    $response = [
                        'status' => 'success',
                        'data' => $called
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update called'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteCalleds($id): Response
            {
                $this->request->allowMethod(['delete']);

                $called = $this->Calleds->get($id);

                if ($this->Calleds->delete($called)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'called deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete called'
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
        # Calleds routes template prefix API   

        # Calleds routes API
        $routes->connect('/Calleds', ['controller' => 'Calleds', 'action' => 'fetchCalleds', 'method' => 'GET']);
        $routes->connect('/Calleds/:id', ['controller' => 'Calleds', 'action' => 'fetchcalled', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Calleds-add', ['controller' => 'Calleds', 'action' => 'addCalleds', 'method' => 'POST']);
        $routes->connect('/Calleds-edit/:id', ['controller' => 'Calleds', 'action' => 'editCalleds', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Calleds-delete/:id', ['controller' => 'Calleds', 'action' => 'deleteCalleds', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # calleds routes simple template prefix /
        
        # calleds routes
        $routes->connect('/Calleds', ['controller' => 'Calleds', 'action' => 'index']);
        $routes->connect('/Calleds/view/:id', ['controller' => 'Calleds', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
