<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Assessments\AddService;
use App\Service\Assessments\ViewService;
use App\Service\Assessments\EditService;
use App\Service\Assessments\DeleteService;
use App\Service\Assessments\ExportService;
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
        $ficha_id = $this->request->getQuery('ficha_id');

        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Assessments.id AS CHAR) LIKE' => '%' . $search . '%',
                    'Students.name LIKE' => '%' . $search . '%',
                ],
            ];
        }

        if ($ficha_id) {
            $conditions['Assessments.ficha_id'] = $ficha_id;
        }

        $query = $this->Assessments->find('all', [
            'conditions' => $conditions,
            'contain' => ['Fichas.Students'],
        ]);

        $assessments = $this->paginate($query);

        $fichas = $this->Assessments->Fichas->find('list', [
            'keyField' => 'id',
            'valueField' => function ($ficha) {
                return $ficha->student->name;
            }
        ])
            ->where(['Fichas.active' => 1])
            ->contain(['Students']);

        $this->set(compact('assessments', 'fichas'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Assessments/index')) {
            return;
        }

        $id = (int)$id;

        $service = new ViewService($this->Assessments);
        $assessment = $service->run($id);

        $this->set(compact('assessment'));
    }

    public function add(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Assessments/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->Assessments);

        if ($this->request->is('post')) {
            $result = $service->run($id, $this->request->getData());

            if ($result['success']) {
                $this->Flash->success($result['message']);
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error($result['message']);
                return $this->redirect($this->referer());
            }
        }

        $this->set('assessment', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Assessments/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->Assessments);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = $service->run($id, $this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect($this->referer());
        }

        $this->set($service->getEditData($id));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Assessments/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->Assessments);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Assessments/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->Assessments);
        return $service->run();
    }
}
