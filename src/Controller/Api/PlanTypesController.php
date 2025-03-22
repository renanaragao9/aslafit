<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class PlanTypesController extends AppController
{
    public function fetchPlanTypes(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->PlanTypes->find('all')->toArray();
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

    public function fetchplanType($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->PlanTypes->get($id);
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

    public function addPlanTypes(): Response
    {
        $this->request->allowMethod(['post']);

        $planType = $this->PlanTypes->newEmptyEntity();
        $planType = $this->PlanTypes->patchEntity($planType, $this->request->getData());

        if ($this->PlanTypes->save($planType)) {
            $response = [
                'status' => 'success',
                'data' => $planType
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o tipo de plano'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editPlanTypes($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $planType = $this->PlanTypes->get($id);
        $planType = $this->PlanTypes->patchEntity($planType, $this->request->getData());

        if ($this->PlanTypes->save($planType)) {
            $response = [
                'status' => 'success',
                'data' => $planType
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o tipo de plano'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deletePlanTypes($id): Response
    {
        $this->request->allowMethod(['delete']);

        $planType = $this->PlanTypes->get($id);

        if ($this->PlanTypes->delete($planType)) {
            $response = [
                'status' => 'success',
                'message' => 'tipo de plano excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o tipo de plano'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
