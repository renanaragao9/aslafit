<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class StatisticsLogsController extends AppController
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
        if (!$this->checkPermission('StatisticsLogs/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(StatisticsLogs.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StatisticsLogs.statistic_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StatisticsLogs.reference_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StatisticsLogs.value AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StatisticsLogs.date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StatisticsLogs.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(StatisticsLogs.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->StatisticsLogs->find('all', [
            'conditions' => $conditions,
            'contain' => [],
        ]);

        $statisticsLogs = $this->paginate($query);


        $this->set(compact('statisticsLogs',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('StatisticsLogs/index')) {
            return;
        }

        $statisticsLog = $this->StatisticsLogs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('statisticsLog'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('StatisticsLogs/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $statisticsLog = $this->StatisticsLogs->newEmptyEntity();

        if ($this->request->is('post')) {

            $statisticsLog = $this->StatisticsLogs->patchEntity($statisticsLog, $this->request->getData());

            if ($this->StatisticsLogs->save($statisticsLog)) {
                $this->Flash->success(__('O statistics log foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O statistics log não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('statisticsLog'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('StatisticsLogs/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $statisticsLog = $this->StatisticsLogs->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $statisticsLog = $this->StatisticsLogs->patchEntity($statisticsLog, $this->request->getData());

            if ($this->StatisticsLogs->save($statisticsLog)) {
                $this->Flash->success(__('O statistics log foi editado com sucesso.'));
                $this->log('O statistics log foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O statistics log não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('statisticsLog'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('StatisticsLogs/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $statisticsLog = $this->StatisticsLogs->get($id);

        if ($this->StatisticsLogs->delete($statisticsLog)) {
            $this->log('O statistics log foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O statistics log foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O statistics log não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('StatisticsLogs/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $statisticsLogs = $this->StatisticsLogs->find('all', [
            'contain' => [],
        ]);

        $csvData = [];
        $header = ['id', 'statistic_type', 'reference_id', 'value', 'date', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($statisticsLogs as $StatisticsLogs) {
            $csvData[] = [
                $StatisticsLogs->id,
                $StatisticsLogs->statistic_type,
                $StatisticsLogs->reference_id,
                $StatisticsLogs->value,
                $StatisticsLogs->date,
                $StatisticsLogs->created,
                $StatisticsLogs->modified
            ];
        }

        $filename = 'statisticsLogs_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/StatisticsLogsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/statisticsLogs
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class StatisticsLogsController extends AppController
        {
            public function fetchStatisticsLogs(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->StatisticsLogs->find('all')->toArray();
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

            public function fetchstatisticsLog($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->StatisticsLogs->get($id);
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

            public function addStatisticsLogs(): Response
            {
                $this->request->allowMethod(['post']);

                $statisticsLog = $this->StatisticsLogs->newEmptyEntity();
                $statisticsLog = $this->StatisticsLogs->patchEntity($statisticsLog, $this->request->getData());

                if ($this->StatisticsLogs->save($statisticsLog)) {
                    $response = [
                        'status' => 'success',
                        'data' => $statisticsLog
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add statistics log'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editStatisticsLogs($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $statisticsLog = $this->StatisticsLogs->get($id);
                $statisticsLog = $this->StatisticsLogs->patchEntity($statisticsLog, $this->request->getData());

                if ($this->StatisticsLogs->save($statisticsLog)) {
                    $response = [
                        'status' => 'success',
                        'data' => $statisticsLog
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update statistics log'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteStatisticsLogs($id): Response
            {
                $this->request->allowMethod(['delete']);

                $statisticsLog = $this->StatisticsLogs->get($id);

                if ($this->StatisticsLogs->delete($statisticsLog)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'statistics log deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete statistics log'
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
        # StatisticsLogs routes template prefix API   

        # StatisticsLogs routes API
        $routes->connect('/StatisticsLogs', ['controller' => 'StatisticsLogs', 'action' => 'fetchStatisticsLogs', 'method' => 'GET']);
        $routes->connect('/StatisticsLogs/:id', ['controller' => 'StatisticsLogs', 'action' => 'fetchstatisticsLog', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/StatisticsLogs-add', ['controller' => 'StatisticsLogs', 'action' => 'addStatisticsLogs', 'method' => 'POST']);
        $routes->connect('/StatisticsLogs-edit/:id', ['controller' => 'StatisticsLogs', 'action' => 'editStatisticsLogs', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/StatisticsLogs-delete/:id', ['controller' => 'StatisticsLogs', 'action' => 'deleteStatisticsLogs', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # statisticsLogs routes simple template prefix /
        
        # statisticsLogs routes
        $routes->connect('/StatisticsLogs', ['controller' => 'StatisticsLogs', 'action' => 'index']);
        $routes->connect('/StatisticsLogs/view/:id', ['controller' => 'StatisticsLogs', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
