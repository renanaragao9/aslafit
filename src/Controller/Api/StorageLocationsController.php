<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class StorageLocationsController extends AppController
{
    public function fetchStorageLocations(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->StorageLocations->find('all')->toArray();
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

    public function fetchstorageLocation($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->StorageLocations->get($id);
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

    public function addStorageLocations(): Response
    {
        $this->request->allowMethod(['post']);

        $storageLocation = $this->StorageLocations->newEmptyEntity();
        $storageLocation = $this->StorageLocations->patchEntity($storageLocation, $this->request->getData());

        if ($this->StorageLocations->save($storageLocation)) {
            $response = [
                'status' => 'success',
                'data' => $storageLocation
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o local de armazenamento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editStorageLocations($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $storageLocation = $this->StorageLocations->get($id);
        $storageLocation = $this->StorageLocations->patchEntity($storageLocation, $this->request->getData());

        if ($this->StorageLocations->save($storageLocation)) {
            $response = [
                'status' => 'success',
                'data' => $storageLocation
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o local de armazenamento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteStorageLocations($id): Response
    {
        $this->request->allowMethod(['delete']);

        $storageLocation = $this->StorageLocations->get($id);

        if ($this->StorageLocations->delete($storageLocation)) {
            $response = [
                'status' => 'success',
                'message' => 'local de armazenamento excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o local de armazenamento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
