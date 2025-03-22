<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class PositionsController extends AppController
{
    public function fetchPositions(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Positions->find('all')->toArray();
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

    public function fetchposition($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Positions->get($id);
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

    public function addPositions(): Response
    {
        $this->request->allowMethod(['post']);

        $position = $this->Positions->newEmptyEntity();
        $position = $this->Positions->patchEntity($position, $this->request->getData());

        if ($this->Positions->save($position)) {
            $response = [
                'status' => 'success',
                'data' => $position
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar a posição'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editPositions($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $position = $this->Positions->get($id);
        $position = $this->Positions->patchEntity($position, $this->request->getData());

        if ($this->Positions->save($position)) {
            $response = [
                'status' => 'success',
                'data' => $position
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar a posição'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deletePositions($id): Response
    {
        $this->request->allowMethod(['delete']);

        $position = $this->Positions->get($id);

        if ($this->Positions->delete($position)) {
            $response = [
                'status' => 'success',
                'message' => 'posição excluída com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir a posição'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
