<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class TrainingDivisionsController extends AppController
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
        if (!$this->checkPermission('TrainingDivisions/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(TrainingDivisions.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(TrainingDivisions.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(TrainingDivisions.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(TrainingDivisions.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(TrainingDivisions.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->TrainingDivisions->find('all', [
            'conditions' => $conditions,
            'contain' => ['ExerciseTrainingDivision'],
        ]);

        $trainingDivisions = $this->paginate($query);

        $this->set(compact('trainingDivisions',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('TrainingDivisions/index')) {
            return;
        }

        $trainingDivision = $this->TrainingDivisions->get($id, [
            'contain' => ['ExerciseTrainingDivision'],
        ]);

        $this->set(compact('trainingDivision'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('TrainingDivisions/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $trainingDivision = $this->TrainingDivisions->newEmptyEntity();

        if ($this->request->is('post')) {

            $trainingDivision = $this->TrainingDivisions->patchEntity($trainingDivision, $this->request->getData());

            if ($this->TrainingDivisions->save($trainingDivision)) {
                $this->Flash->success(__('Divisão de treino foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Divisão de treino não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('trainingDivision'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('TrainingDivisions/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $trainingDivision = $this->TrainingDivisions->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $trainingDivision = $this->TrainingDivisions->patchEntity($trainingDivision, $this->request->getData());

            if ($this->TrainingDivisions->save($trainingDivision)) {
                $this->Flash->success(__('Divisão de treino editado com sucesso.'));
                $this->log('Divisão de treino editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Divisão de treino não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('trainingDivision'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('TrainingDivisions/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $trainingDivision = $this->TrainingDivisions->get($id);

        if ($this->TrainingDivisions->delete($trainingDivision)) {
            $this->log('Divisão de treino foi deletado com sucesso.', 'info');
            $this->Flash->success(__('Divisão de treino foi deletado com sucesso..'));
        } else {
            $this->Flash->error(__('Divisão de treino não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('TrainingDivisions/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $trainingDivisions = $this->TrainingDivisions->find('all', [
            'contain' => ['ExerciseTrainingDivision'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($trainingDivisions as $TrainingDivisions) {
            $csvData[] = [
                $TrainingDivisions->id,
                $TrainingDivisions->name,
                $TrainingDivisions->active,
                $TrainingDivisions->created,
                $TrainingDivisions->modified
            ];
        }

        $filename = 'trainingDivisions_' . date('Y-m-d_H-i-s') . '.csv';
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
