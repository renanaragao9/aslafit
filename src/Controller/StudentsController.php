<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Students\AddService;
use App\Service\Students\ViewService;
use App\Service\Students\EditService;
use App\Service\Students\DeleteService;
use App\Service\Students\ExportService;
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
                ],
            ];
        }

        $query = $this->Students->find('all', [
            'conditions' => $conditions,
            'contain' => [
                'Users',
                'Calleds',
                'EventRegistrations',
                'MonthlyPlans',
                'Fichas' => function ($q) {
                    return $q->where(['Fichas.active' => true]);
                },
            ],
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

        $id = (int)$id;

        $service = new ViewService($this->Students);
        $student = $service->run($id);

        $this->set(compact('student'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Students/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->Students);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('student', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Students/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->Students);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = $service->run($id, $this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set($service->getEditData($id));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Students/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->Students);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Students/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->Students);
        return $service->run();
    }
}
