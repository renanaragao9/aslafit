<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class TrainingDivisionsController extends AppController
{
    public function fetchTrainingDivisions(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->TrainingDivisions->find('all')->toArray();
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

    public function fetchtrainingDivision($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->TrainingDivisions->get($id);
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

    public function addTrainingDivisions(): Response
    {
        $this->request->allowMethod(['post']);

        $trainingDivision = $this->TrainingDivisions->newEmptyEntity();
        $trainingDivision = $this->TrainingDivisions->patchEntity($trainingDivision, $this->request->getData());

        if ($this->TrainingDivisions->save($trainingDivision)) {
            $response = [
                'status' => 'sucesso',
                'dados' => $trainingDivision
            ];
        } else {
            $response = [
                'status' => 'erro',
                'mensagem' => 'Não foi possível adicionar a divisão de treino'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editTrainingDivisions($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $trainingDivision = $this->TrainingDivisions->get($id);
        $trainingDivision = $this->TrainingDivisions->patchEntity($trainingDivision, $this->request->getData());

        if ($this->TrainingDivisions->save($trainingDivision)) {
            $response = [
                'status' => 'sucesso',
                'dados' => $trainingDivision
            ];
        } else {
            $response = [
                'status' => 'erro',
                'mensagem' => 'Não foi possível atualizar a divisão de treino'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteTrainingDivisions($id): Response
    {
        $this->request->allowMethod(['delete']);

        $trainingDivision = $this->TrainingDivisions->get($id);

        if ($this->TrainingDivisions->delete($trainingDivision)) {
            $response = [
                'status' => 'sucesso',
                'mensagem' => 'Divisão de treino excluída com sucesso'
            ];
        } else {
            $response = [
                'status' => 'erro',
                'mensagem' => 'Não foi possível excluir a divisão de treino'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
