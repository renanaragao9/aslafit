<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\MonthlyPlans\AddService;
use App\Service\MonthlyPlans\EditService;
use App\Service\MonthlyPlans\DeleteService;
use App\Service\MonthlyPlans\ExportService;
use App\Service\MonthlyPlans\ViewService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class MonthlyPlansController extends AppController
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
        if (!$this->checkPermission('MonthlyPlans/index')) {
            return;
        }

        $queryData = $this->request->getQuery();
        $conditions = [];

        $simpleFields = [
            'student_id' => 'MonthlyPlans.student_id',
            'collaborator_id' => 'MonthlyPlans.collaborator_id',
            'plan_type_id' => 'MonthlyPlans.plan_type_id',
            'payment_id' => 'MonthlyPlans.payment_id',
        ];

        foreach ($simpleFields as $field => $dbField) {
            if (!empty($queryData[$field])) {
                $conditions[$dbField] = $queryData[$field];
            }
        }

        $dateRanges = [
            'date_payment_start' => ['MonthlyPlans.date_payment >=' => 'date_payment_start'],
            'date_payment_end'   => ['MonthlyPlans.date_payment <=' => 'date_payment_end'],
            'date_venciment_start' => ['MonthlyPlans.date_venciment >=' => 'date_venciment_start'],
            'date_venciment_end'   => ['MonthlyPlans.date_venciment <=' => 'date_venciment_end'],
        ];

        foreach ($dateRanges as $key => $condition) {
            $field = array_values($condition)[0];
            $dbField = array_keys($condition)[0];
            if (!empty($queryData[$field])) {
                $conditions[$dbField] = $queryData[$field];
            }
        }

        if (!empty($queryData['search'])) {
            $conditions[] = [
                'OR' => [
                    'MonthlyPlans.date_payment LIKE' => '%' . $queryData['search'] . '%',
                    'MonthlyPlans.date_venciment LIKE' => '%' . $queryData['search'] . '%',
                    'Students.name LIKE' => '%' . $queryData['search'] . '%',
                    'Collaborators.name LIKE' => '%' . $queryData['search'] . '%',
                ]
            ];
        }

        $query = $this->MonthlyPlans->find('all', [
            'conditions' => $conditions,
            'contain' => ['FormPayments', 'PlanTypes', 'Students', 'Collaborators'],
        ]);

        $monthlyPlans = $this->paginate($query);
        $formPayments = $this->MonthlyPlans->FormPayments->find('list', ['limit' => 200])->all();
        $planTypes = $this->MonthlyPlans->PlanTypes->find('list', ['limit' => 200])->all();
        $students = $this->MonthlyPlans->Students->find('list', ['limit' => 200])->all();
        $collaborators = $this->MonthlyPlans->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('monthlyPlans', 'formPayments', 'planTypes', 'students', 'collaborators'));
    }


    public function view($id = null)
    {
        if (!$this->checkPermission('MonthlyPlans/index')) {
            return;
        }

        $service = new ViewService($this->MonthlyPlans);
        $monthlyPlan = $service->run((int)$id);

        $this->set(compact('monthlyPlan'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('MonthlyPlans/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->MonthlyPlans);

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
        if (!$this->checkPermission('MonthlyPlans/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->MonthlyPlans);

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
        if (!$this->checkPermission('MonthlyPlans/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->MonthlyPlans);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('MonthlyPlans/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->MonthlyPlans);
        return $service->run();
    }
}
