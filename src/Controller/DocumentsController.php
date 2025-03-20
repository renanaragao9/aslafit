<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class DocumentsController extends AppController
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
        if (!$this->checkPermission('Documents/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Documents.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Documents.documentable_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Documents.documentable_id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Documents.document_type AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Documents.document_number AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Documents.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Documents.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Documents.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Documents->find('all', [
            'conditions' => $conditions,
            'contain' => [],
        ]);

        $documents = $this->paginate($query);


        $this->set(compact('documents',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Documents/index')) {
            return;
        }

        $document = $this->Documents->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('document'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Documents/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $document = $this->Documents->newEmptyEntity();

        if ($this->request->is('post')) {

            $document = $this->Documents->patchEntity($document, $this->request->getData());

            if ($this->Documents->save($document)) {
                $this->Flash->success(__('O document foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O document não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('document'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Documents/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $document = $this->Documents->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $document = $this->Documents->patchEntity($document, $this->request->getData());

            if ($this->Documents->save($document)) {
                $this->Flash->success(__('O document foi editado com sucesso.'));
                $this->log('O document foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O document não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('document'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Documents/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $document = $this->Documents->get($id);

        if ($this->Documents->delete($document)) {
            $this->log('O document foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O document foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('O document não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Documents/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $documents = $this->Documents->find('all', [
            'contain' => [],
        ]);

        $csvData = [];
        $header = ['id', 'documentable_type', 'documentable_id', 'document_type', 'document_number', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($documents as $Documents) {
            $csvData[] = [
                $Documents->id,
                $Documents->documentable_type,
                $Documents->documentable_id,
                $Documents->document_type,
                $Documents->document_number,
                $Documents->active,
                $Documents->created,
                $Documents->modified
            ];
        }

        $filename = 'documents_' . date('Y-m-d_H-i-s') . '.csv';
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
        # Path: src/Controllers/API/DocumentsController.php
        # Copie e cole o conteúdo abaixo no arquivo acima
        # Lembre-se de alterar os valores das variáveis de acordo com o seu projeto
        # Não esqueça de adicionar as rotas no arquivo src/Config/routes.php
        # Para acessar a API, utilize a URL: http://localhost:8765/api/documents
    */

    /*
        <?php

        namespace App\Controller\Api;

        use App\Controller\AppController;
        use Cake\Http\Response;

        class DocumentsController extends AppController
        {
            public function fetchDocuments(): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Documents->find('all')->toArray();
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

            public function fetchdocument($id): Response
            {
                $this->request->allowMethod(['get']);

                try {
                    $data = $this->Documents->get($id);
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

            public function addDocuments(): Response
            {
                $this->request->allowMethod(['post']);

                $document = $this->Documents->newEmptyEntity();
                $document = $this->Documents->patchEntity($document, $this->request->getData());

                if ($this->Documents->save($document)) {
                    $response = [
                        'status' => 'success',
                        'data' => $document
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to add document'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function editDocuments($id): Response
            {
                $this->request->allowMethod(['put', 'patch']);

                $document = $this->Documents->get($id);
                $document = $this->Documents->patchEntity($document, $this->request->getData());

                if ($this->Documents->save($document)) {
                    $response = [
                        'status' => 'success',
                        'data' => $document
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to update document'
                    ];
                }

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            }

            public function deleteDocuments($id): Response
            {
                $this->request->allowMethod(['delete']);

                $document = $this->Documents->get($id);

                if ($this->Documents->delete($document)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'document deleted successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Unable to delete document'
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
        # Documents routes template prefix API   

        # Documents routes API
        $routes->connect('/Documents', ['controller' => 'Documents', 'action' => 'fetchDocuments', 'method' => 'GET']);
        $routes->connect('/Documents/:id', ['controller' => 'Documents', 'action' => 'fetchdocument', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Documents-add', ['controller' => 'Documents', 'action' => 'addDocuments', 'method' => 'POST']);
        $routes->connect('/Documents-edit/:id', ['controller' => 'Documents', 'action' => 'editDocuments', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/Documents-delete/:id', ['controller' => 'Documents', 'action' => 'deleteDocuments', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    */

    /*
        # documents routes simple template prefix /
        
        # documents routes
        $routes->connect('/Documents', ['controller' => 'Documents', 'action' => 'index']);
        $routes->connect('/Documents/view/:id', ['controller' => 'Documents', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
    */
}
