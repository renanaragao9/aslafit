<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PlanTypes\AddService;
use App\Service\PlanTypes\ViewService;
use App\Service\PlanTypes\EditService;
use App\Service\PlanTypes\DeleteService;
use App\Service\PlanTypes\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class PlanTypesController extends AppController
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
        if (!$this->checkPermission('PlanTypes/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(PlanTypes.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.value AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.months AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(PlanTypes.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->PlanTypes->find('all', [
            'conditions' => $conditions,
            'contain' => ['MonthlyPlans'],
        ]);

        $planTypes = $this->paginate($query);

        $this->set(compact('planTypes'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('PlanTypes/index')) {
            return;
        }

        $id = (int)$id;

        $service = new ViewService($this->PlanTypes);
        $planType = $service->run($id);

        $this->set(compact('planType'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('PlanTypes/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->PlanTypes);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('planType', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('PlanTypes/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->PlanTypes);

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
        if (!$this->checkPermission('PlanTypes/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->PlanTypes);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('PlanTypes/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->PlanTypes);
        return $service->run();
    }
}
