<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class MuscleGroupsController extends AppController
{
    public function fetchMuscleGroups(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->MuscleGroups->find('all')->toArray();
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

    public function fetchmuscleGroup($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->MuscleGroups->get($id);
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

    public function addMuscleGroups(): Response
    {
        $this->request->allowMethod(['post']);

        $muscleGroup = $this->MuscleGroups->newEmptyEntity();
        $muscleGroup = $this->MuscleGroups->patchEntity($muscleGroup, $this->request->getData());

        if ($this->MuscleGroups->save($muscleGroup)) {
            $response = [
                'status' => 'success',
                'data' => $muscleGroup
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o grupo muscular'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editMuscleGroups($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $muscleGroup = $this->MuscleGroups->get($id);
        $muscleGroup = $this->MuscleGroups->patchEntity($muscleGroup, $this->request->getData());

        if ($this->MuscleGroups->save($muscleGroup)) {
            $response = [
                'status' => 'success',
                'data' => $muscleGroup
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o grupo muscular'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteMuscleGroups($id): Response
    {
        $this->request->allowMethod(['delete']);

        $muscleGroup = $this->MuscleGroups->get($id);

        if ($this->MuscleGroups->delete($muscleGroup)) {
            $response = [
                'status' => 'success',
                'message' => 'grupo muscular excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o grupo muscular'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
