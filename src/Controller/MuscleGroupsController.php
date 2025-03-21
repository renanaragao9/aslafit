<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\MuscleGroups\AddService;
use App\Service\MuscleGroups\ViewService;
use App\Service\MuscleGroups\EditService;
use App\Service\MuscleGroups\DeleteService;
use App\Service\MuscleGroups\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class MuscleGroupsController extends AppController
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
        if (!$this->checkPermission('MuscleGroups/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(MuscleGroups.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MuscleGroups.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MuscleGroups.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MuscleGroups.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MuscleGroups.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->MuscleGroups->find('all', [
            'conditions' => $conditions,
            'contain' => ['Exercises'],
        ]);

        $muscleGroups = $this->paginate($query);

        $this->set(compact('muscleGroups'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('MuscleGroups/index')) {
            return;
        }

        $id = (int)$id;

        $service = new ViewService($this->MuscleGroups);
        $muscleGroup = $service->run($id);

        $this->set(compact('muscleGroup'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('MuscleGroups/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->MuscleGroups);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('muscleGroup', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('MuscleGroups/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->MuscleGroups);

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
        if (!$this->checkPermission('MuscleGroups/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->MuscleGroups);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('MuscleGroups/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->MuscleGroups);
        return $service->run();
    }
}
