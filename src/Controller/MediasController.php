<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Medias\AddService;
use App\Service\Medias\EditService;
use App\Service\Medias\DeleteService;
use App\Service\Medias\ExportService;
use App\Service\Medias\ViewService;
use App\Utility\AccessChecker;
use Cake\Http\Response;

class MediasController extends AppController
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
        if (!$this->checkPermission('Medias/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'Medias.title LIKE' => '%' . $search . '%',
                    'Collaborators.name LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Medias->find('all', [
            'conditions' => $conditions,
            'contain' => ['Collaborators'],
        ]);

        $medias = $this->paginate($query);
        $collaborators = $this->Medias->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('medias', 'collaborators'));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Medias/index')) {
            return;
        }

        $service = new ViewService($this->Medias);
        $media = $service->run((int)$id);

        $this->set(compact('media'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Medias/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new AddService($this->Medias);

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
        if (!$this->checkPermission('Medias/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new EditService($this->Medias);

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
        if (!$this->checkPermission('Medias/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new DeleteService($this->Medias);
        $result = $service->run($id);

        $this->Flash->{$result['success'] ? 'success' : 'error'}($result['message']);
        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Medias/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $service = new ExportService($this->Medias);
        return $service->run();
    }
}
