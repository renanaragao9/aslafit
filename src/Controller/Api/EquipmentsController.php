<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class EquipmentsController extends AppController
{
    public function fetchEquipments(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Equipments->find('all')->toArray();
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

    public function fetchequipment($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Equipments->get($id);
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

    public function addEquipments(): Response
    {
        $this->request->allowMethod(['post']);

        $equipment = $this->Equipments->newEmptyEntity();
        $equipment = $this->Equipments->patchEntity($equipment, $this->request->getData());

        if ($this->Equipments->save($equipment)) {
            $response = [
                'status' => 'sucesso',
                'data' => $equipment
            ];
        } else {
            $response = [
                'status' => 'erro',
                'message' => 'Não foi possível adicionar o equipamento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editEquipments($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $equipment = $this->Equipments->get($id);
        $equipment = $this->Equipments->patchEntity($equipment, $this->request->getData());

        if ($this->Equipments->save($equipment)) {
            $response = [
                'status' => 'sucesso',
                'data' => $equipment
            ];
        } else {
            $response = [
                'status' => 'erro',
                'message' => 'Não foi possível atualizar o equipamento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteEquipments($id): Response
    {
        $this->request->allowMethod(['delete']);

        $equipment = $this->Equipments->get($id);

        if ($this->Equipments->delete($equipment)) {
            $response = [
                'status' => 'sucesso',
                'message' => 'Equipamento excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'erro',
                'message' => 'Não foi possível excluir o equipamento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
