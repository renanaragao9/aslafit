<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class MealTypesController extends AppController
{
    public function fetchMealTypes(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->MealTypes->find('all')->toArray();
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

    public function fetchmealType($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->MealTypes->get($id);
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

    public function addMealTypes(): Response
    {
        $this->request->allowMethod(['post']);

        $mealType = $this->MealTypes->newEmptyEntity();
        $mealType = $this->MealTypes->patchEntity($mealType, $this->request->getData());

        if ($this->MealTypes->save($mealType)) {
            $response = [
                'status' => 'success',
                'data' => $mealType
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o tipo de refeição'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editMealTypes($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $mealType = $this->MealTypes->get($id);
        $mealType = $this->MealTypes->patchEntity($mealType, $this->request->getData());

        if ($this->MealTypes->save($mealType)) {
            $response = [
                'status' => 'success',
                'data' => $mealType
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o tipo de refeição'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteMealTypes($id): Response
    {
        $this->request->allowMethod(['delete']);

        $mealType = $this->MealTypes->get($id);

        if ($this->MealTypes->delete($mealType)) {
            $response = [
                'status' => 'success',
                'message' => 'tipo de refeição excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o tipo de refeição'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
