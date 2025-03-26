<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class DietPlansController extends AppController
{
    public function fetchDietPlans(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->DietPlans->find('all')->toArray();
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

    public function fetchdietPlan($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->DietPlans->get($id);
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

    public function addDietPlans(): Response
    {
        $this->request->allowMethod(['post']);

        $dietPlan = $this->DietPlans->newEmptyEntity();
        $dietPlan = $this->DietPlans->patchEntity($dietPlan, $this->request->getData());

        if ($this->DietPlans->save($dietPlan)) {
            $response = [
                'status' => 'success',
                'data' => $dietPlan
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o plano alimentar'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editDietPlans($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $dietPlan = $this->DietPlans->get($id);
        $dietPlan = $this->DietPlans->patchEntity($dietPlan, $this->request->getData());

        if ($this->DietPlans->save($dietPlan)) {
            $response = [
                'status' => 'success',
                'data' => $dietPlan
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o plano alimentar'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteDietPlans($id): Response
    {
        $this->request->allowMethod(['delete']);

        $dietPlan = $this->DietPlans->get($id);

        if ($this->DietPlans->delete($dietPlan)) {
            $response = [
                'status' => 'success',
                'message' => 'plano alimentar excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o plano alimentar'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
