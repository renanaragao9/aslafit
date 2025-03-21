<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class FoodsController extends AppController
{
    public function fetchFoods(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Foods->find('all')->toArray();
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

    public function fetchfood($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Foods->get($id);
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

    public function addFoods(): Response
    {
        $this->request->allowMethod(['post']);

        $food = $this->Foods->newEmptyEntity();
        $food = $this->Foods->patchEntity($food, $this->request->getData());

        if ($this->Foods->save($food)) {
            $response = [
                'status' => 'success',
                'data' => $food
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to add food'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editFoods($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $food = $this->Foods->get($id);
        $food = $this->Foods->patchEntity($food, $this->request->getData());

        if ($this->Foods->save($food)) {
            $response = [
                'status' => 'success',
                'data' => $food
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to update food'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteFoods($id): Response
    {
        $this->request->allowMethod(['delete']);

        $food = $this->Foods->get($id);

        if ($this->Foods->delete($food)) {
            $response = [
                'status' => 'success',
                'message' => 'food deleted successfully'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to delete food'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
