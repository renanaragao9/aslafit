<?php

declare(strict_types=1);

namespace App\Controller;

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


        $this->set(compact('muscleGroups',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('MuscleGroups/index')) {
            return;
        }

        $muscleGroup = $this->MuscleGroups->get($id, [
            'contain' => ['Exercises.Equipments'],
        ]);

        $this->set(compact('muscleGroup'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('MuscleGroups/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $muscleGroup = $this->MuscleGroups->newEmptyEntity();

        if ($this->request->is('post')) {

            $muscleGroup = $this->MuscleGroups->patchEntity($muscleGroup, $this->request->getData());

            if ($this->MuscleGroups->save($muscleGroup)) {
                $this->Flash->success(__('Grupo muscular salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Grupo muscular não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('muscleGroup'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('MuscleGroups/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $muscleGroup = $this->MuscleGroups->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $muscleGroup = $this->MuscleGroups->patchEntity($muscleGroup, $this->request->getData());

            if ($this->MuscleGroups->save($muscleGroup)) {
                $this->Flash->success(__('Grupo muscular editado com sucesso.'));
                $this->log('Grupo muscular editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Grupo muscular não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('muscleGroup'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('MuscleGroups/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $muscleGroup = $this->MuscleGroups->get($id);

        if ($this->MuscleGroups->delete($muscleGroup)) {
            $this->log('Grupo muscular deletado com sucesso.', 'info');
            $this->Flash->success(__('Grupo muscular deletado com sucesso.'));
        } else {
            $this->Flash->error(__('Grupo muscular não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('MuscleGroups/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $muscleGroups = $this->MuscleGroups->find('all', [
            'contain' => ['Exercises'],
        ]);

        $csvData = [];
        $header = ['ID', 'Nome', 'Ativo', 'Criado', 'Modificado'];
        $csvData[] = $header;

        foreach ($muscleGroups as $MuscleGroups) {
            $csvData[] = [
                $MuscleGroups->id,
                $MuscleGroups->name,
                $MuscleGroups->active ? 'Sim' : 'Não',
                $MuscleGroups->created,
                $MuscleGroups->modified
            ];
        }

        $filename = 'grupo_muscular' . date('Y-m-d_H-i-s') . '.csv';
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
}
