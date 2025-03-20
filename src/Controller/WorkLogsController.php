<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class WorkLogsController extends AppController
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
        if (!$this->checkPermission('WorkLogs/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(WorkLogs.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.collaborator_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.log_date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.log_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.log_time AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.log_address AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.latitude AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.longitude AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(WorkLogs.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->WorkLogs->find('all', [
            'conditions' => $conditions,
            'contain' => ['Collaborators'],
        ]);

        $workLogs = $this->paginate($query);

        $collaborators = $this->WorkLogs->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('workLogs', 'collaborators'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('WorkLogs/index')) {
            return;
        }

        $workLog = $this->WorkLogs->get($id, [
            'contain' => ['Collaborators'],
        ]);

        $this->set(compact('workLog'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('WorkLogs/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $workLog = $this->WorkLogs->newEmptyEntity();

        if ($this->request->is('post')) {

            $workLog = $this->WorkLogs->patchEntity($workLog, $this->request->getData());

            if ($this->WorkLogs->save($workLog)) {
                $this->Flash->success(__('O work log foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O work log não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $collaborators = $this->WorkLogs->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('workLog', 'collaborators'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('WorkLogs/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $workLog = $this->WorkLogs->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $workLog = $this->WorkLogs->patchEntity($workLog, $this->request->getData());

            if ($this->WorkLogs->save($workLog)) {
                $this->Flash->success(__('O work log foi editado com sucesso.'));
                $this->log('O work log foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O work log não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $collaborators = $this->WorkLogs->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('workLog', 'collaborators'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('WorkLogs/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $workLog = $this->WorkLogs->get($id);

        if ($this->WorkLogs->delete($workLog)) {
            $this->log('O work log foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O work log foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O work log não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('WorkLogs/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $workLogs = $this->WorkLogs->find('all', [
            'contain' => ['Collaborators'],
        ]);

        $csvData = [];
        $header = ['id', 'collaborator_id', 'log_date', 'log_type', 'log_time', 'log_address', 'latitude', 'longitude', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($workLogs as $WorkLogs) {
            $csvData[] = [
                $WorkLogs->id,
                $WorkLogs->collaborator_id,
                $WorkLogs->log_date,
                $WorkLogs->log_type,
                $WorkLogs->log_time,
                $WorkLogs->log_address,
                $WorkLogs->latitude,
                $WorkLogs->longitude,
                $WorkLogs->created,
                $WorkLogs->modified
            ];
        }

        $filename = 'workLogs_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/WorkLogsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/workLogs
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class WorkLogsController extends AppController
        {
            public function fetchWorkLogs(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->WorkLogs->find('all')->toArray();
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

            public function fetchworkLog($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->WorkLogs->get($id);
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

            public function addWorkLogs(): Response
            {
                $this->request->allowMethod(['post']);

                $workLog = $this->WorkLogs->newEmptyEntity();
                $workLog = $this->WorkLogs->patchEntity($workLog, $this->request->getData());

                if ($this->WorkLogs->save($workLog)) {
                    $response = [
                        'status' => 'success',
                        'data' => $workLog
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add work log'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editWorkLogs($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $workLog = $this->WorkLogs->get($id);
                $workLog = $this->WorkLogs->patchEntity($workLog, $this->request->getData());

                if ($this->WorkLogs->save($workLog)) {
                    $response = [
                        'status' => 'success',
                        'data' => $workLog
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update work log'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteWorkLogs($id): Response
            {
                $this->request->allowMethod(['delete']);

                $workLog = $this->WorkLogs->get($id);

                if ($this->WorkLogs->delete($workLog)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'work log deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete work log'
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
        # WorkLogs routes template prefix API   

        # WorkLogs routes API
        $routes->connect('/WorkLogs', ['controller' => 'WorkLogs', 'action' => 'fetchWorkLogs', 'method' => 'GET']);
        $routes->connect('/WorkLogs/:id', ['controller' => 'WorkLogs', 'action' => 'fetchworkLog', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/WorkLogs-add', ['controller' => 'WorkLogs', 'action' => 'addWorkLogs', 'method' => 'POST']);
        $routes->connect('/WorkLogs-edit/:id', ['controller' => 'WorkLogs', 'action' => 'editWorkLogs', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/WorkLogs-delete/:id', ['controller' => 'WorkLogs', 'action' => 'deleteWorkLogs', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # workLogs routes simple template prefix /
        
        # workLogs routes
        $routes->connect('/WorkLogs', ['controller' => 'WorkLogs', 'action' => 'index']);
        $routes->connect('/WorkLogs/view/:id', ['controller' => 'WorkLogs', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
