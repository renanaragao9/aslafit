<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class ExercisesController extends AppController
{
    public function fetchExercises(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Exercises->find('all')->toArray();
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

    public function fetchexercise($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Exercises->get($id);
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

    public function addExercises(): Response
    {
        $this->request->allowMethod(['post']);

        $exercise = $this->Exercises->newEmptyEntity();
        $exercise = $this->Exercises->patchEntity($exercise, $this->request->getData());

        if ($this->Exercises->save($exercise)) {
            $response = [
                'status' => 'success',
                'data' => $exercise
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o exercício'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editExercises($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $exercise = $this->Exercises->get($id);
        $exercise = $this->Exercises->patchEntity($exercise, $this->request->getData());

        if ($this->Exercises->save($exercise)) {
            $response = [
                'status' => 'success',
                'data' => $exercise
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o exercício'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteExercises($id): Response
    {
        $this->request->allowMethod(['delete']);

        $exercise = $this->Exercises->get($id);

        if ($this->Exercises->delete($exercise)) {
            $response = [
                'status' => 'success',
                'message' => 'exercício excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to delete exercise'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
