<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Calleds\AddService;
use App\Service\Calleds\EditService;
use App\Service\Calleds\DeleteService;
use App\Service\Calleds\ExportService;
use App\Service\Calleds\ViewService;
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

        $queryParams = $this->request->getQuery();

        $conditions = [];

        if (!empty($queryParams['search'])) {
            $conditions['OR'] = [
                'Calleds.title LIKE' => '%' . $queryParams['search'] . '%',
                'Collaborators.name LIKE' => '%' . $queryParams['search'] . '%',
                'Students.name LIKE' => '%' . $queryParams['search'] . '%',
            ];
        }

        $directFilters = array_filter([
            'Calleds.collaborator_id' => $queryParams['collaborator_id'] ?? null,
            'Calleds.student_id' => $queryParams['student_id'] ?? null,
            'Calleds.urgency' => $queryParams['urgency'] ?? null,
            'Calleds.status' => $queryParams['status'] ?? null,
        ]);

        $conditions = array_merge($conditions, $directFilters);

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

        $service = new ViewService($this->Calleds);
        $called = $service->run((int)$id);

        $this->set(compact('called'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Calleds/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->Calleds);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set($service->getFormData());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Calleds/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->Calleds);

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
        if (!$this->checkPermission('Calleds/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->Calleds);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Calleds/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->Calleds);
        return $service->run();
    }
}
