<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class ItemTypesController extends AppController
{
    public function fetchItemTypes(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->ItemTypes->find('all')->toArray();
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

    public function fetchitemType($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->ItemTypes->get($id);
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

    public function addItemTypes(): Response
    {
        $this->request->allowMethod(['post']);

        $itemType = $this->ItemTypes->newEmptyEntity();
        $itemType = $this->ItemTypes->patchEntity($itemType, $this->request->getData());

        if ($this->ItemTypes->save($itemType)) {
            $response = [
                'status' => 'success',
                'data' => $itemType
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o tipo de item'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editItemTypes($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $itemType = $this->ItemTypes->get($id);
        $itemType = $this->ItemTypes->patchEntity($itemType, $this->request->getData());

        if ($this->ItemTypes->save($itemType)) {
            $response = [
                'status' => 'success',
                'data' => $itemType
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o tipo de item'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteItemTypes($id): Response
    {
        $this->request->allowMethod(['delete']);

        $itemType = $this->ItemTypes->get($id);

        if ($this->ItemTypes->delete($itemType)) {
            $response = [
                'status' => 'success',
                'message' => 'tipo de item excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o tipo de item'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
