<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class ExerciseTrainingDivisionController extends AppController
{
    public function fetchExerciseTrainingDivisions(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->ExerciseTrainingDivision->find('all')->toArray();
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

    public function fetchexerciseTrainingDivision($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->ExerciseTrainingDivision->get($id);
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

    public function addExerciseTrainingDivision(): Response
    {
        $this->request->allowMethod(['post']);

        $exerciseTrainingDivision = $this->ExerciseTrainingDivision->newEmptyEntity();
        $exerciseTrainingDivision = $this->ExerciseTrainingDivision->patchEntity($exerciseTrainingDivision, $this->request->getData());

        if ($this->ExerciseTrainingDivision->save($exerciseTrainingDivision)) {
            $response = [
                'status' => 'success',
                'data' => $exerciseTrainingDivision
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar exercício à ficha de treino'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editExerciseTrainingDivision($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $exerciseTrainingDivision = $this->ExerciseTrainingDivision->get($id);
        $exerciseTrainingDivision = $this->ExerciseTrainingDivision->patchEntity($exerciseTrainingDivision, $this->request->getData());

        if ($this->ExerciseTrainingDivision->save($exerciseTrainingDivision)) {
            $response = [
                'status' => 'success',
                'data' => $exerciseTrainingDivision
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o exercício à ficha de treino'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteExerciseTrainingDivision($id): Response
    {
        $this->request->allowMethod(['delete']);

        $exerciseTrainingDivision = $this->ExerciseTrainingDivision->get($id);

        if ($this->ExerciseTrainingDivision->delete($exerciseTrainingDivision)) {
            $response = [
                'status' => 'success',
                'message' => 'exercício da ficha de treino excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o exercício da ficha de treino'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
