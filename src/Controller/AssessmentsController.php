<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class AssessmentsController extends AppController
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
        if (!$this->checkPermission('Assessments/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Assessments.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.goal AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.observation AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.term AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.height AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.weight AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.arm AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.forearm AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.breastplate AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.back AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.waist AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.glute AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.hip AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.thigh AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.calf AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.student_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.ficha_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Assessments.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Assessments->find('all', [
            'conditions' => $conditions,
            'contain' => ['Students', 'Fichas'],
        ]);

        $assessments = $this->paginate($query);

        $students = $this->Assessments->Students->find('list', ['limit' => 200])->all();
        $fichas = $this->Assessments->Fichas->find('list', ['limit' => 200])->all();

        $this->set(compact('assessments', 'students', 'fichas'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Assessments/index')) {
            return;
        }

        $assessment = $this->Assessments->get($id, [
            'contain' => ['Students', 'Fichas'],
        ]);

        $this->set(compact('assessment'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Assessments/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $assessment = $this->Assessments->newEmptyEntity();

        if ($this->request->is('post')) {

            $assessment = $this->Assessments->patchEntity($assessment, $this->request->getData());

            if ($this->Assessments->save($assessment)) {
                $this->Flash->success(__('O assessment foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O assessment não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $students = $this->Assessments->Students->find('list', ['limit' => 200])->all();
        $fichas = $this->Assessments->Fichas->find('list', ['limit' => 200])->all();

        $this->set(compact('assessment', 'students', 'fichas'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Assessments/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $assessment = $this->Assessments->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $assessment = $this->Assessments->patchEntity($assessment, $this->request->getData());

            if ($this->Assessments->save($assessment)) {
                $this->Flash->success(__('O assessment foi editado com sucesso.'));
                $this->log('O assessment foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O assessment não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $students = $this->Assessments->Students->find('list', ['limit' => 200])->all();
        $fichas = $this->Assessments->Fichas->find('list', ['limit' => 200])->all();

        $this->set(compact('assessment', 'students', 'fichas'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Assessments/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $assessment = $this->Assessments->get($id);

        if ($this->Assessments->delete($assessment)) {
            $this->log('O assessment foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O assessment foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O assessment não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Assessments/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $assessments = $this->Assessments->find('all', [
            'contain' => ['Students', 'Fichas'],
        ]);

        $csvData = [];
        $header = ['id', 'goal', 'observation', 'term', 'height', 'weight', 'arm', 'forearm', 'breastplate', 'back', 'waist', 'glute', 'hip', 'thigh', 'calf', 'student_id', 'ficha_id', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($assessments as $Assessments) {
            $csvData[] = [
                $Assessments->id,
                $Assessments->goal,
                $Assessments->observation,
                $Assessments->term,
                $Assessments->height,
                $Assessments->weight,
                $Assessments->arm,
                $Assessments->forearm,
                $Assessments->breastplate,
                $Assessments->back,
                $Assessments->waist,
                $Assessments->glute,
                $Assessments->hip,
                $Assessments->thigh,
                $Assessments->calf,
                $Assessments->student_id,
                $Assessments->ficha_id,
                $Assessments->active,
                $Assessments->created,
                $Assessments->modified
            ];
        }

        $filename = 'assessments_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/AssessmentsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/assessments
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class AssessmentsController extends AppController
        {
            public function fetchAssessments(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Assessments->find('all')->toArray();
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

            public function fetchassessment($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Assessments->get($id);
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

            public function addAssessments(): Response
            {
                $this->request->allowMethod(['post']);

                $assessment = $this->Assessments->newEmptyEntity();
                $assessment = $this->Assessments->patchEntity($assessment, $this->request->getData());

                if ($this->Assessments->save($assessment)) {
                    $response = [
                        'status' => 'success',
                        'data' => $assessment
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add assessment'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editAssessments($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $assessment = $this->Assessments->get($id);
                $assessment = $this->Assessments->patchEntity($assessment, $this->request->getData());

                if ($this->Assessments->save($assessment)) {
                    $response = [
                        'status' => 'success',
                        'data' => $assessment
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update assessment'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteAssessments($id): Response
            {
                $this->request->allowMethod(['delete']);

                $assessment = $this->Assessments->get($id);

                if ($this->Assessments->delete($assessment)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'assessment deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete assessment'
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
        # Assessments routes template prefix API   

        # Assessments routes API
        $routes->connect('/Assessments', ['controller' => 'Assessments', 'action' => 'fetchAssessments', 'method' => 'GET']);
        $routes->connect('/Assessments/:id', ['controller' => 'Assessments', 'action' => 'fetchassessment', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Assessments-add', ['controller' => 'Assessments', 'action' => 'addAssessments', 'method' => 'POST']);
        $routes->connect('/Assessments-edit/:id', ['controller' => 'Assessments', 'action' => 'editAssessments', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Assessments-delete/:id', ['controller' => 'Assessments', 'action' => 'deleteAssessments', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # assessments routes simple template prefix /
        
        # assessments routes
        $routes->connect('/Assessments', ['controller' => 'Assessments', 'action' => 'index']);
        $routes->connect('/Assessments/view/:id', ['controller' => 'Assessments', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
