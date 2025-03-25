<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class FichasController extends AppController
{
    public function fetchFichas(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Fichas->find('all')->toArray();
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

    public function fetchficha($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Fichas->get($id);
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

    public function addFichas(): Response
    {
        $this->request->allowMethod(['post']);

        $ficha = $this->Fichas->newEmptyEntity();
        $ficha = $this->Fichas->patchEntity($ficha, $this->request->getData());

        if ($this->Fichas->save($ficha)) {
            $response = [
                'status' => 'success',
                'data' => $ficha
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar a ficha'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editFichas($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $ficha = $this->Fichas->get($id);
        $ficha = $this->Fichas->patchEntity($ficha, $this->request->getData());

        if ($this->Fichas->save($ficha)) {
            $response = [
                'status' => 'success',
                'data' => $ficha
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar a ficha'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteFichas($id): Response
    {
        $this->request->allowMethod(['delete']);

        $ficha = $this->Fichas->get($id);

        if ($this->Fichas->delete($ficha)) {
            $response = [
                'status' => 'success',
                'message' => 'Ficha excluída com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir a ficha'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
