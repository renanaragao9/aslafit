<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utility\AccessChecker;
use Cake\Http\Response;

class EquipmentsController extends AppController
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
        if (!$this->checkPermission('Equipments/index')) {
            return;
        }

        $search = $this->request->getQuery('search');
        $conditions = [];

        if ($search) {
            $conditions = [
                'OR' => [
                    'CAST(Equipments.id AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Equipments.name AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Equipments.active AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Equipments.created AS CHAR) LIKE' => '%' . $search . '%',
                    'CAST(Equipments.modified AS CHAR) LIKE' => '%' . $search . '%',
                ],
            ];
        }

        $query = $this->Equipments->find('all', [
            'conditions' => $conditions,
            'contain' => ['Exercises'],
        ]);

        $equipments = $this->paginate($query);


        $this->set(compact('equipments',));
    }

    public function view($id = null)
    {
        if (!$this->checkPermission('Equipments/index')) {
            return;
        }

        $equipment = $this->Equipments->get($id, [
            'contain' => ['Exercises.MuscleGroups'],
        ]);

        $this->set(compact('equipment'));
    }

    public function add(): ?Response
    {
        if (!$this->checkPermission('Equipments/add')) {
            return $this->redirect(['action' => 'index']);
        }

        $equipment = $this->Equipments->newEmptyEntity();

        if ($this->request->is('post')) {

            $equipment = $this->Equipments->patchEntity($equipment, $this->request->getData());

            if ($this->Equipments->save($equipment)) {
                $this->Flash->success(__('O equipamento foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O equipamento não pode ser salvo. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('equipment'));
        return null;
    }

    public function edit(?int $id = null): ?Response
    {
        if (!$this->checkPermission('Equipments/edit')) {
            return $this->redirect(['action' => 'index']);
        }

        $equipment = $this->Equipments->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $equipment = $this->Equipments->patchEntity($equipment, $this->request->getData());

            if ($this->Equipments->save($equipment)) {
                $this->Flash->success(__('O equipamento foi editado com sucesso.'));
                $this->log('O equipamento foi editado com sucesso.', 'info');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O equipamento não pode ser editado. Por favor, tente novamente.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->set(compact('equipment'));
        return null;
    }

    public function delete(?int $id = null): Response
    {
        if (!$this->checkPermission('Equipments/delete')) {
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);

        $equipment = $this->Equipments->get($id);

        if ($this->Equipments->delete($equipment)) {
            $this->log('O equipamento foi deletado com sucesso.', 'info');
            $this->Flash->success(__('O equipamento foi deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O equipamento não pode ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export(): Response
    {
        if (!$this->checkPermission('Equipments/index')) {
            return $this->redirect(['action' => 'index']);
        }

        $equipments = $this->Equipments->find('all', [
            'contain' => ['Exercises'],
        ]);

        $csvData = [];
        $header = ['id', 'name', 'active', 'created', 'modified'];
        $csvData[] = $header;

        foreach ($equipments as $Equipments) {
            $csvData[] = [
                $Equipments->id,
                $Equipments->name,
                $Equipments->active,
                $Equipments->created,
                $Equipments->modified
            ];
        }

        $filename = 'equipamentos' . date('Y-m-d_H-i-s') . '.csv';
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
