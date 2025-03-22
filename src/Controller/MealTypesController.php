<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\MealTypes\AddService;
use App\Service\MealTypes\ViewService;
use App\Service\MealTypes\EditService;
use App\Service\MealTypes\DeleteService;
use App\Service\MealTypes\ExportService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class MealTypesController extends AppController
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
        if (!$this->checkPermission('MealTypes/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(MealTypes.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MealTypes.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MealTypes.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MealTypes.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(MealTypes.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->MealTypes->find('all', [
            'conditions' => $conditions
        ]);

        $mealTypes = $this->paginate($query);

        $this->set(compact('mealTypes'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('MealTypes/index')) {
            return;
        }

        $id = (int)$id;
        $service = new ViewService($this->MealTypes);
        $mealType = $service->run($id);

        $this->set(compact('mealType'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('MealTypes/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->MealTypes);

        if ($this->request->is('post')) {
            $result = $service->run($this->request->getData());

            $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
            return $this->redirect(['action' => 'index']);
        }

        $this->set('mealType', $service->getNewEntity());
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('MealTypes/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->MealTypes);

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
        if (!$this->checkPermission('MealTypes/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->MealTypes);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('MealTypes/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->MealTypes);
        return $service->run();
    }
}
