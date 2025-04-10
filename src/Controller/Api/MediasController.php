<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class MediasController extends AppController
{
    public function fetchMedias(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Medias->find('all')->toArray();
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

    public function fetchmedia($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Medias->get($id);
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

    public function addMedias(): Response
    {
        $this->request->allowMethod(['post']);

        $media = $this->Medias->newEmptyEntity();
        $media = $this->Medias->patchEntity($media, $this->request->getData());

        if ($this->Medias->save($media)) {
            $response = [
                'status' => 'success',
                'data' => $media
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar a mídia'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editMedias($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $media = $this->Medias->get($id);
        $media = $this->Medias->patchEntity($media, $this->request->getData());

        if ($this->Medias->save($media)) {
            $response = [
                'status' => 'success',
                'data' => $media
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar a mídia'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteMedias($id): Response
    {
        $this->request->allowMethod(['delete']);

        $media = $this->Medias->get($id);

        if ($this->Medias->delete($media)) {
            $response = [
                'status' => 'success',
                'message' => 'mídia excluída com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir a mídia'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
