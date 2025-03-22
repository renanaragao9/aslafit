<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\FormPayments\AddService;
use App\Service\FormPayments\ViewService;
use App\Service\FormPayments\EditService;
use App\Service\FormPayments\DeleteService;
use App\Service\FormPayments\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class FormPaymentsController extends AppController
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
        if (!$this->checkPermission('FormPayments/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(FormPayments.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FormPayments.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FormPayments.flag AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FormPayments.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FormPayments.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(FormPayments.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->FormPayments->find('all', [
            'conditions' => $conditions,
            'contain' => [],
        ]);

        $formPayments = $this->paginate($query);

        $this->set(compact('formPayments'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('FormPayments/index')) {
            return;
        }

        $id = (int)$id;

        $service = new ViewService($this->FormPayments);
        $formPayment = $service->run($id);

        $this->set(compact('formPayment'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('FormPayments/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->FormPayments);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('formPayment', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('FormPayments/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->FormPayments);

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
        if (!$this->checkPermission('FormPayments/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->FormPayments);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('FormPayments/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->FormPayments);
        return $service->run();
    }
}
