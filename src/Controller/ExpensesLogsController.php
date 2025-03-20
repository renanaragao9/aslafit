<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class ExpensesLogsController extends AppController
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
        if (!$this->checkPermission('ExpensesLogs/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(ExpensesLogs.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExpensesLogs.expense_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExpensesLogs.reference_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExpensesLogs.amount AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExpensesLogs.transaction_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExpensesLogs.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExpensesLogs.date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExpensesLogs.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(ExpensesLogs.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->ExpensesLogs->find('all', [
            'conditions' => $conditions,
            'contain' => [],
        ]);

        $expensesLogs = $this->paginate($query);


        $this->set(compact('expensesLogs',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('ExpensesLogs/index')) {
            return;
        }

        $expensesLog = $this->ExpensesLogs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('expensesLog'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('ExpensesLogs/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $expensesLog = $this->ExpensesLogs->newEmptyEntity();

        if ($this->request->is('post')) {

            $expensesLog = $this->ExpensesLogs->patchEntity($expensesLog, $this->request->getData());

            if ($this->ExpensesLogs->save($expensesLog)) {
                $this->Flash->success(__('O expenses log foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O expenses log não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('expensesLog'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('ExpensesLogs/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $expensesLog = $this->ExpensesLogs->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $expensesLog = $this->ExpensesLogs->patchEntity($expensesLog, $this->request->getData());

            if ($this->ExpensesLogs->save($expensesLog)) {
                $this->Flash->success(__('O expenses log foi editado com sucesso.'));
                $this->log('O expenses log foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O expenses log não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('expensesLog'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('ExpensesLogs/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $expensesLog = $this->ExpensesLogs->get($id);

        if ($this->ExpensesLogs->delete($expensesLog)) {
            $this->log('O expenses log foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O expenses log foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O expenses log não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('ExpensesLogs/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $expensesLogs = $this->ExpensesLogs->find('all', [
            'contain' => [],
        ]);

        $csvData = [];
        $header = ['id', 'expense_type', 'reference_id', 'amount', 'transaction_type', 'description', 'date', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($expensesLogs as $ExpensesLogs) {
            $csvData[] = [
                $ExpensesLogs->id,
                $ExpensesLogs->expense_type,
                $ExpensesLogs->reference_id,
                $ExpensesLogs->amount,
                $ExpensesLogs->transaction_type,
                $ExpensesLogs->description,
                $ExpensesLogs->date,
                $ExpensesLogs->created,
                $ExpensesLogs->modified
            ];
        }

        $filename = 'expensesLogs_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/ExpensesLogsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/expensesLogs
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class ExpensesLogsController extends AppController
        {
            public function fetchExpensesLogs(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ExpensesLogs->find('all')->toArray();
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

            public function fetchexpensesLog($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->ExpensesLogs->get($id);
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

            public function addExpensesLogs(): Response
            {
                $this->request->allowMethod(['post']);

                $expensesLog = $this->ExpensesLogs->newEmptyEntity();
                $expensesLog = $this->ExpensesLogs->patchEntity($expensesLog, $this->request->getData());

                if ($this->ExpensesLogs->save($expensesLog)) {
                    $response = [
                        'status' => 'success',
                        'data' => $expensesLog
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add expenses log'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editExpensesLogs($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $expensesLog = $this->ExpensesLogs->get($id);
                $expensesLog = $this->ExpensesLogs->patchEntity($expensesLog, $this->request->getData());

                if ($this->ExpensesLogs->save($expensesLog)) {
                    $response = [
                        'status' => 'success',
                        'data' => $expensesLog
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update expenses log'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteExpensesLogs($id): Response
            {
                $this->request->allowMethod(['delete']);

                $expensesLog = $this->ExpensesLogs->get($id);

                if ($this->ExpensesLogs->delete($expensesLog)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'expenses log deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete expenses log'
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
        # ExpensesLogs routes template prefix API   

        # ExpensesLogs routes API
        $routes->connect('/ExpensesLogs', ['controller' => 'ExpensesLogs', 'action' => 'fetchExpensesLogs', 'method' => 'GET']);
        $routes->connect('/ExpensesLogs/:id', ['controller' => 'ExpensesLogs', 'action' => 'fetchexpensesLog', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ExpensesLogs-add', ['controller' => 'ExpensesLogs', 'action' => 'addExpensesLogs', 'method' => 'POST']);
        $routes->connect('/ExpensesLogs-edit/:id', ['controller' => 'ExpensesLogs', 'action' => 'editExpensesLogs', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ExpensesLogs-delete/:id', ['controller' => 'ExpensesLogs', 'action' => 'deleteExpensesLogs', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # expensesLogs routes simple template prefix /
        
        # expensesLogs routes
        $routes->connect('/ExpensesLogs', ['controller' => 'ExpensesLogs', 'action' => 'index']);
        $routes->connect('/ExpensesLogs/view/:id', ['controller' => 'ExpensesLogs', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
