<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class CalledsController extends AppController
{
    public function fetchCalleds(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Calleds->find('all')->toArray();
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

    public function fetchcalled($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Calleds->get($id);
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

    public function addCalleds(): Response
    {
        $this->request->allowMethod(['post']);

        $called = $this->Calleds->newEmptyEntity();
        $called = $this->Calleds->patchEntity($called, $this->request->getData());

        if ($this->Calleds->save($called)) {
            $response = [
                'status' => 'success',
                'data' => $called
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o chamado'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editCalleds($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $called = $this->Calleds->get($id);
        $called = $this->Calleds->patchEntity($called, $this->request->getData());

        if ($this->Calleds->save($called)) {
            $response = [
                'status' => 'success',
                'data' => $called
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o chamado'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteCalleds($id): Response
    {
        $this->request->allowMethod(['delete']);

        $called = $this->Calleds->get($id);

        if ($this->Calleds->delete($called)) {
            $response = [
                'status' => 'success',
                'message' => 'chamado excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o chamado'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
