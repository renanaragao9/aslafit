<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class AssessmentsController extends AppController
{
    public function fetchAssessments(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Assessments->find('all')->toArray();
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

    public function fetchassessment($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Assessments->get($id);
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

    public function addAssessments(): Response
    {
        $this->request->allowMethod(['post']);

        $assessment = $this->Assessments->newEmptyEntity();
        $assessment = $this->Assessments->patchEntity($assessment, $this->request->getData());

        if ($this->Assessments->save($assessment)) {
            $response = [
                'status' => 'success',
                'data' => $assessment
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar a avaliação'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editAssessments($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $assessment = $this->Assessments->get($id);
        $assessment = $this->Assessments->patchEntity($assessment, $this->request->getData());

        if ($this->Assessments->save($assessment)) {
            $response = [
                'status' => 'success',
                'data' => $assessment
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar a avaliação'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteAssessments($id): Response
    {
        $this->request->allowMethod(['delete']);

        $assessment = $this->Assessments->get($id);

        if ($this->Assessments->delete($assessment)) {
            $response = [
                'status' => 'success',
                'message' => 'avaliação excluída com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir a avaliação'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
