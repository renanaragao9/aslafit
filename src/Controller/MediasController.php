<?php

declare(strict_types=1);

namespace App\Controller;

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
                    'CAST(Medias.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Medias.title AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Medias.type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Medias.img AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Medias.link AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Medias.description AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Medias.collaborator_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Medias.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Medias.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Medias.modified AS CHAR) LIKE' => '%' . $search . '%',
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

        $media = $this->Medias->get($id, [
            'contain' => ['Collaborators'],
        ]);

        $this->set(compact('media'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Medias/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $media = $this->Medias->newEmptyEntity();

        if ($this->request->is('post')) {

            $media = $this->Medias->patchEntity($media, $this->request->getData());

            if ($this->Medias->save($media)) {
                $this->Flash->success(__('O media foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O media não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $collaborators = $this->Medias->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('media', 'collaborators'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Medias/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $media = $this->Medias->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $media = $this->Medias->patchEntity($media, $this->request->getData());

            if ($this->Medias->save($media)) {
                $this->Flash->success(__('O media foi editado com sucesso.'));
                $this->log('O media foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O media não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $collaborators = $this->Medias->Collaborators->find('list', ['limit' => 200])->all();

        $this->set(compact('media', 'collaborators'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Medias/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $media = $this->Medias->get($id);

        if ($this->Medias->delete($media)) {
            $this->log('O media foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O media foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O media não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Medias/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $medias = $this->Medias->find('all', [
            'contain' => ['Collaborators'],
        ]);

        $csvData = [];
        $header = ['id', 'title', 'type', 'img', 'link', 'description', 'collaborator_id', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($medias as $Medias) {
            $csvData[] = [
                $Medias->id,
                $Medias->title,
                $Medias->type,
                $Medias->img,
                $Medias->link,
                $Medias->description,
                $Medias->collaborator_id,
                $Medias->active,
                $Medias->created,
                $Medias->modified
            ];
        }

        $filename = 'medias_' . date('Y-m-d_H-i-s') . '.csv';
        $filePath = TMP . $filename;

        $file = fopen($filePath, 'w');
        foreach ($csvData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);

        $response = $this->response->withFile(
            $filePath,
            ['download' => true, 'name' => $filename]
        );

        return $response;
    }

    /*
        # Controller API Template
        # Path: src/Controllers/API/MediasController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/medias
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class MediasController extends AppController
        {
            public function fetchMedias(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Medias->find('all')->toArray();
                    $response = [
                        'status' => 'success',
                        'data' => $data
                    ];
                } catch (\Exception $e) {
                    $response = [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ];
                }
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function fetchmedia($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Medias->get($id);
                    $response = [
                        'status' => 'success',
                        'data' => $data
                    ];
                } catch (\Exception $e) {
                    $response = [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ];
                }
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function addMedias(): Response
            {
                $this->request->allowMethod(['post']);

                $media = $this->Medias->newEmptyEntity();
                $media = $this->Medias->patchEntity($media, $this->request->getData());

                if ($this->Medias->save($media)) {
                    $response = [
                        'status' => 'success',
                        'data' => $media
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add media'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editMedias($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $media = $this->Medias->get($id);
                $media = $this->Medias->patchEntity($media, $this->request->getData());

                if ($this->Medias->save($media)) {
                    $response = [
                        'status' => 'success',
                        'data' => $media
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update media'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteMedias($id): Response
            {
                $this->request->allowMethod(['delete']);

                $media = $this->Medias->get($id);

                if ($this->Medias->delete($media)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'media deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete media'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }
        }
    */

    /*
        # Rotas API Template
        # Path: src/Config/routes.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
    */

    /*
        # Medias routes template prefix API   

        # Medias routes API
        $routes->connect('/Medias', ['controller' => 'Medias', 'action' => 'fetchMedias', 'method' => 'GET']);
        $routes->connect('/Medias/:id', ['controller' => 'Medias', 'action' => 'fetchmedia', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Medias-add', ['controller' => 'Medias', 'action' => 'addMedias', 'method' => 'POST']);
        $routes->connect('/Medias-edit/:id', ['controller' => 'Medias', 'action' => 'editMedias', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Medias-delete/:id', ['controller' => 'Medias', 'action' => 'deleteMedias', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # medias routes simple template prefix /
        
        # medias routes
        $routes->connect('/Medias', ['controller' => 'Medias', 'action' => 'index']);
        $routes->connect('/Medias/view/:id', ['controller' => 'Medias', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
