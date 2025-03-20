<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class StudentsController extends AppController
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
        if (!$this->checkPermission('Students/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Students.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.birth_date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.entry_date AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.gender AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.weight AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.height AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.color AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.img AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.user_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Students.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Students->find('all', [
            'conditions' => $conditions,
            'contain' => ['Users', 'Assessments', 'Calleds', 'DietPlans', 'EventRegistrations', 'Fichas', 'MonthlyPlans'],
        ]);

        $students = $this->paginate($query);

        $users = $this->Students->Users->find('list', ['limit' => 200])->all();

        $this->set(compact('students', 'users'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Students/index')) {
            return;
        }

        $student = $this->Students->get($id, [
            'contain' => ['Users', 'Assessments', 'Calleds', 'DietPlans', 'EventRegistrations', 'Fichas', 'MonthlyPlans'],
        ]);

        $this->set(compact('student'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Students/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $student = $this->Students->newEmptyEntity();

        if ($this->request->is('post')) {

            $student = $this->Students->patchEntity($student, $this->request->getData());

            if ($this->Students->save($student)) {
                $this->Flash->success(__('O student foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O student não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $users = $this->Students->Users->find('list', ['limit' => 200])->all();

        $this->set(compact('student', 'users'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Students/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $student = $this->Students->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $student = $this->Students->patchEntity($student, $this->request->getData());

            if ($this->Students->save($student)) {
                $this->Flash->success(__('O student foi editado com sucesso.'));
                $this->log('O student foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O student não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $users = $this->Students->Users->find('list', ['limit' => 200])->all();

        $this->set(compact('student', 'users'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Students/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $student = $this->Students->get($id);

        if ($this->Students->delete($student)) {
            $this->log('O student foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O student foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O student não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Students/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $students = $this->Students->find('all', [
            'contain' => ['Users', 'Assessments', 'Calleds', 'DietPlans', 'EventRegistrations', 'Fichas', 'MonthlyPlans'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'birth_date', 'entry_date', 'gender', 'weight', 'height', 'color', 'img', 'active', 'user_id', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($students as $Students) {
            $csvData[] = [
                $Students->id,
                $Students->name,
                $Students->birth_date,
                $Students->entry_date,
                $Students->gender,
                $Students->weight,
                $Students->height,
                $Students->color,
                $Students->img,
                $Students->active,
                $Students->user_id,
                $Students->created,
                $Students->modified
            ];
        }

        $filename = 'students_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/StudentsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/students
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class StudentsController extends AppController
        {
            public function fetchStudents(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Students->find('all')->toArray();
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

            public function fetchstudent($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Students->get($id);
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

            public function addStudents(): Response
            {
                $this->request->allowMethod(['post']);

                $student = $this->Students->newEmptyEntity();
                $student = $this->Students->patchEntity($student, $this->request->getData());

                if ($this->Students->save($student)) {
                    $response = [
                        'status' => 'success',
                        'data' => $student
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add student'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editStudents($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $student = $this->Students->get($id);
                $student = $this->Students->patchEntity($student, $this->request->getData());

                if ($this->Students->save($student)) {
                    $response = [
                        'status' => 'success',
                        'data' => $student
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update student'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteStudents($id): Response
            {
                $this->request->allowMethod(['delete']);

                $student = $this->Students->get($id);

                if ($this->Students->delete($student)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'student deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete student'
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
        # Students routes template prefix API   

        # Students routes API
        $routes->connect('/Students', ['controller' => 'Students', 'action' => 'fetchStudents', 'method' => 'GET']);
        $routes->connect('/Students/:id', ['controller' => 'Students', 'action' => 'fetchstudent', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Students-add', ['controller' => 'Students', 'action' => 'addStudents', 'method' => 'POST']);
        $routes->connect('/Students-edit/:id', ['controller' => 'Students', 'action' => 'editStudents', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Students-delete/:id', ['controller' => 'Students', 'action' => 'deleteStudents', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # students routes simple template prefix /
        
        # students routes
        $routes->connect('/Students', ['controller' => 'Students', 'action' => 'index']);
        $routes->connect('/Students/view/:id', ['controller' => 'Students', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
