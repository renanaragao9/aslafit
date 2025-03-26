<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Fichas\AddService;
use App\Service\Fichas\ViewService;
use App\Service\Fichas\EditService;
use App\Service\Fichas\DeleteService;
use App\Service\Fichas\ExportService;
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
                    'Students.name LIKE' => '%' . $search . '%',
                    'CAST(Fichas.active AS CHAR) LIKE' => '%' . $search . '%',
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

        $id = (int)$id;

        $service = new ViewService($this->Fichas);
        $ficha = $service->run($id);

        $this->set(compact('ficha'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Fichas/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->Fichas);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('ficha', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Fichas/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->Fichas);

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
        if (!$this->checkPermission('Fichas/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->Fichas);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Fichas/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->Fichas);
        return $service->run();
    }
}
