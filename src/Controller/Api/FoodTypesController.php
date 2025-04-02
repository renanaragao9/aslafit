<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class FoodTypesController extends AppController
{
    public function fetchFoodTypes(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->FoodTypes->find('all')->toArray();
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

    public function fetchfoodType($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->FoodTypes->get($id);
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

    public function addFoodTypes(): Response
    {
        $this->request->allowMethod(['post']);

        $foodType = $this->FoodTypes->newEmptyEntity();
        $foodType = $this->FoodTypes->patchEntity($foodType, $this->request->getData());

        if ($this->FoodTypes->save($foodType)) {
            $response = [
                'status' => 'success',
                'data' => $foodType
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o tipo de alimento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editFoodTypes($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $foodType = $this->FoodTypes->get($id);
        $foodType = $this->FoodTypes->patchEntity($foodType, $this->request->getData());

        if ($this->FoodTypes->save($foodType)) {
            $response = [
                'status' => 'success',
                'data' => $foodType
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o tipo de alimento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteFoodTypes($id): Response
    {
        $this->request->allowMethod(['delete']);

        $foodType = $this->FoodTypes->get($id);

        if ($this->FoodTypes->delete($foodType)) {
            $response = [
                'status' => 'success',
                'message' => 'tipo de alimento excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o tipo de alimento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
