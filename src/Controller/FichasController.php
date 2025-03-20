<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class FichasController extends AppController
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
        if (!$this->checkPermission('Fichas/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Fichas.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Fichas.start_date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Fichas.end_date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Fichas.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Fichas.notes AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Fichas.student_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Fichas.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Fichas.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Fichas.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Fichas->find('all', [
            'conditions' => $conditions,
            'contain' => ['Students', 'Assessments', 'DietPlans', 'ExerciseTrainingDivision'],
        ]);

        $fichas = $this->paginate($query);

        $students = $this->Fichas->Students->find('list', ['limit' => 200])->all();

        $this->set(compact('fichas', 'students'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Fichas/index')) {
            return;
        }

        $ficha = $this->Fichas->get($id, [
            'contain' => ['Students', 'Assessments', 'DietPlans', 'ExerciseTrainingDivision'],
        ]);

        $this->set(compact('ficha'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Fichas/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $ficha = $this->Fichas->newEmptyEntity();

        if ($this->request->is('post')) {

            $ficha = $this->Fichas->patchEntity($ficha, $this->request->getData());

            if ($this->Fichas->save($ficha)) {
                $this->Flash->success(__('O ficha foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O ficha não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $students = $this->Fichas->Students->find('list', ['limit' => 200])->all();

        $this->set(compact('ficha', 'students'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Fichas/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $ficha = $this->Fichas->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $ficha = $this->Fichas->patchEntity($ficha, $this->request->getData());

            if ($this->Fichas->save($ficha)) {
                $this->Flash->success(__('O ficha foi editado com sucesso.'));
                $this->log('O ficha foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O ficha não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $students = $this->Fichas->Students->find('list', ['limit' => 200])->all();

        $this->set(compact('ficha', 'students'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Fichas/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $ficha = $this->Fichas->get($id);

        if ($this->Fichas->delete($ficha)) {
            $this->log('O ficha foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O ficha foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O ficha não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Fichas/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $fichas = $this->Fichas->find('all', [
            'contain' => ['Students', 'Assessments', 'DietPlans', 'ExerciseTrainingDivision'],
        ]);

        $csvData = [];
        $header = ['id', 'start_date', 'end_date', 'description', 'notes', 'student_id', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($fichas as $Fichas) {
            $csvData[] = [
                $Fichas->id,
                $Fichas->start_date,
                $Fichas->end_date,
                $Fichas->description,
                $Fichas->notes,
                $Fichas->student_id,
                $Fichas->active,
                $Fichas->created,
                $Fichas->modified
            ];
        }

        $filename = 'fichas_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/FichasController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/fichas
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class FichasController extends AppController
        {
            public function fetchFichas(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Fichas->find('all')->toArray();
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

            public function fetchficha($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Fichas->get($id);
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

            public function addFichas(): Response
            {
                $this->request->allowMethod(['post']);

                $ficha = $this->Fichas->newEmptyEntity();
                $ficha = $this->Fichas->patchEntity($ficha, $this->request->getData());

                if ($this->Fichas->save($ficha)) {
                    $response = [
                        'status' => 'success',
                        'data' => $ficha
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add ficha'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editFichas($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $ficha = $this->Fichas->get($id);
                $ficha = $this->Fichas->patchEntity($ficha, $this->request->getData());

                if ($this->Fichas->save($ficha)) {
                    $response = [
                        'status' => 'success',
                        'data' => $ficha
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update ficha'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteFichas($id): Response
            {
                $this->request->allowMethod(['delete']);

                $ficha = $this->Fichas->get($id);

                if ($this->Fichas->delete($ficha)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'ficha deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete ficha'
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
        # Fichas routes template prefix API   

        # Fichas routes API
        $routes->connect('/Fichas', ['controller' => 'Fichas', 'action' => 'fetchFichas', 'method' => 'GET']);
        $routes->connect('/Fichas/:id', ['controller' => 'Fichas', 'action' => 'fetchficha', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Fichas-add', ['controller' => 'Fichas', 'action' => 'addFichas', 'method' => 'POST']);
        $routes->connect('/Fichas-edit/:id', ['controller' => 'Fichas', 'action' => 'editFichas', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Fichas-delete/:id', ['controller' => 'Fichas', 'action' => 'deleteFichas', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # fichas routes simple template prefix /
        
        # fichas routes
        $routes->connect('/Fichas', ['controller' => 'Fichas', 'action' => 'index']);
        $routes->connect('/Fichas/view/:id', ['controller' => 'Fichas', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
