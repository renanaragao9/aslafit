<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class MonthlyPlansController extends AppController
{
    public function fetchMonthlyPlans(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->MonthlyPlans->find('all')->toArray();
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

    public function fetchmonthlyPlan($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->MonthlyPlans->get($id);
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

    public function addMonthlyPlans(): Response
    {
        $this->request->allowMethod(['post']);

        $monthlyPlan = $this->MonthlyPlans->newEmptyEntity();
        $monthlyPlan = $this->MonthlyPlans->patchEntity($monthlyPlan, $this->request->getData());

        if ($this->MonthlyPlans->save($monthlyPlan)) {
            $response = [
                'status' => 'success',
                'data' => $monthlyPlan
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o plano mensal'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editMonthlyPlans($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $monthlyPlan = $this->MonthlyPlans->get($id);
        $monthlyPlan = $this->MonthlyPlans->patchEntity($monthlyPlan, $this->request->getData());

        if ($this->MonthlyPlans->save($monthlyPlan)) {
            $response = [
                'status' => 'success',
                'data' => $monthlyPlan
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o plano mensal'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteMonthlyPlans($id): Response
    {
        $this->request->allowMethod(['delete']);

        $monthlyPlan = $this->MonthlyPlans->get($id);

        if ($this->MonthlyPlans->delete($monthlyPlan)) {
            $response = [
                'status' => 'success',
                'message' => 'plano mensal excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o plano mensal'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
