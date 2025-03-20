<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class CollaboratorsController extends AppController
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
        if (!$this->checkPermission('Collaborators/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Collaborators.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.birth_date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.entry_date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.gender AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.color AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.img AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.position_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.user_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Collaborators.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Collaborators->find('all', [
            'conditions' => $conditions,
            'contain' => ['Positions', 'Users', 'Calleds', 'Events', 'Medias', 'MonthlyPlans', 'WorkLogs'],
        ]);

        $collaborators = $this->paginate($query);

        $positions = $this->Collaborators->Positions->find('list', ['limit' => 200])->all();
        $users = $this->Collaborators->Users->find('list', ['limit' => 200])->all();

        $this->set(compact('collaborators', 'positions', 'users'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Collaborators/index')) {
            return;
        }

        $collaborator = $this->Collaborators->get($id, [
            'contain' => ['Positions', 'Users', 'Calleds', 'Events', 'Medias', 'MonthlyPlans', 'WorkLogs'],
        ]);

        $this->set(compact('collaborator'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Collaborators/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $collaborator = $this->Collaborators->newEmptyEntity();

        if ($this->request->is('post')) {

            $collaborator = $this->Collaborators->patchEntity($collaborator, $this->request->getData());

            if ($this->Collaborators->save($collaborator)) {
                $this->Flash->success(__('O collaborator foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O collaborator não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $positions = $this->Collaborators->Positions->find('list', ['limit' => 200])->all();
        $users = $this->Collaborators->Users->find('list', ['limit' => 200])->all();

        $this->set(compact('collaborator', 'positions', 'users'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Collaborators/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $collaborator = $this->Collaborators->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $collaborator = $this->Collaborators->patchEntity($collaborator, $this->request->getData());

            if ($this->Collaborators->save($collaborator)) {
                $this->Flash->success(__('O collaborator foi editado com sucesso.'));
                $this->log('O collaborator foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O collaborator não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $positions = $this->Collaborators->Positions->find('list', ['limit' => 200])->all();
        $users = $this->Collaborators->Users->find('list', ['limit' => 200])->all();

        $this->set(compact('collaborator', 'positions', 'users'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Collaborators/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $collaborator = $this->Collaborators->get($id);

        if ($this->Collaborators->delete($collaborator)) {
            $this->log('O collaborator foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O collaborator foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O collaborator não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Collaborators/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $collaborators = $this->Collaborators->find('all', [
            'contain' => ['Positions', 'Users', 'Calleds', 'Events', 'Medias', 'MonthlyPlans', 'WorkLogs'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'birth_date', 'entry_date', 'gender', 'color', 'img', 'active', 'position_id', 'user_id', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($collaborators as $Collaborators) {
            $csvData[] = [
                $Collaborators->id,
                $Collaborators->name,
                $Collaborators->birth_date,
                $Collaborators->entry_date,
                $Collaborators->gender,
                $Collaborators->color,
                $Collaborators->img,
                $Collaborators->active,
                $Collaborators->position_id,
                $Collaborators->user_id,
                $Collaborators->created,
                $Collaborators->modified
            ];
        }

        $filename = 'collaborators_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/CollaboratorsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/collaborators
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class CollaboratorsController extends AppController
        {
            public function fetchCollaborators(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Collaborators->find('all')->toArray();
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

            public function fetchcollaborator($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Collaborators->get($id);
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

            public function addCollaborators(): Response
            {
                $this->request->allowMethod(['post']);

                $collaborator = $this->Collaborators->newEmptyEntity();
                $collaborator = $this->Collaborators->patchEntity($collaborator, $this->request->getData());

                if ($this->Collaborators->save($collaborator)) {
                    $response = [
                        'status' => 'success',
                        'data' => $collaborator
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add collaborator'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editCollaborators($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $collaborator = $this->Collaborators->get($id);
                $collaborator = $this->Collaborators->patchEntity($collaborator, $this->request->getData());

                if ($this->Collaborators->save($collaborator)) {
                    $response = [
                        'status' => 'success',
                        'data' => $collaborator
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update collaborator'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteCollaborators($id): Response
            {
                $this->request->allowMethod(['delete']);

                $collaborator = $this->Collaborators->get($id);

                if ($this->Collaborators->delete($collaborator)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'collaborator deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete collaborator'
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
        # Collaborators routes template prefix API   

        # Collaborators routes API
        $routes->connect('/Collaborators', ['controller' => 'Collaborators', 'action' => 'fetchCollaborators', 'method' => 'GET']);
        $routes->connect('/Collaborators/:id', ['controller' => 'Collaborators', 'action' => 'fetchcollaborator', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Collaborators-add', ['controller' => 'Collaborators', 'action' => 'addCollaborators', 'method' => 'POST']);
        $routes->connect('/Collaborators-edit/:id', ['controller' => 'Collaborators', 'action' => 'editCollaborators', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Collaborators-delete/:id', ['controller' => 'Collaborators', 'action' => 'deleteCollaborators', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # collaborators routes simple template prefix /
        
        # collaborators routes
        $routes->connect('/Collaborators', ['controller' => 'Collaborators', 'action' => 'index']);
        $routes->connect('/Collaborators/view/:id', ['controller' => 'Collaborators', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
