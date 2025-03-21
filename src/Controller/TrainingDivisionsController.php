<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\TrainingDivisions\AddService;
use App\Service\TrainingDivisions\ViewService;
use App\Service\TrainingDivisions\EditService;
use App\Service\TrainingDivisions\DeleteService;
use App\Service\TrainingDivisions\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class TrainingDivisionsController extends AppController
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
        if (!$this->checkPermission('TrainingDivisions/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(TrainingDivisions.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(TrainingDivisions.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(TrainingDivisions.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(TrainingDivisions.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(TrainingDivisions.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->TrainingDivisions->find('all', [
            'conditions' => $conditions,
            'contain' => ['ExerciseTrainingDivision'],
        ]);

        $trainingDivisions = $this->paginate($query);

        $this->set(compact('trainingDivisions'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('TrainingDivisions/index')) {
            return;
        }

        $service = new ViewService($this->TrainingDivisions);
        $id = (int)$id;
        $trainingDivision = $service->run($id);

        $this->set(compact('trainingDivision'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('TrainingDivisions/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->TrainingDivisions);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('trainingDivision', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('TrainingDivisions/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->TrainingDivisions);

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
        if (!$this->checkPermission('TrainingDivisions/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->TrainingDivisions);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('TrainingDivisions/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->TrainingDivisions);
        return $service->run();
    }
}
