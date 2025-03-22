<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class SuppliersController extends AppController
{
    public function fetchSuppliers(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Suppliers->find('all')->toArray();
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

    public function fetchsupplier($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Suppliers->get($id);
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

    public function addSuppliers(): Response
    {
        $this->request->allowMethod(['post']);

        $supplier = $this->Suppliers->newEmptyEntity();
        $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData());

        if ($this->Suppliers->save($supplier)) {
            $response = [
                'status' => 'success',
                'data' => $supplier
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o fornecedor'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editSuppliers($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $supplier = $this->Suppliers->get($id);
        $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData());

        if ($this->Suppliers->save($supplier)) {
            $response = [
                'status' => 'success',
                'data' => $supplier
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o fornecedor'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteSuppliers($id): Response
    {
        $this->request->allowMethod(['delete']);

        $supplier = $this->Suppliers->get($id);

        if ($this->Suppliers->delete($supplier)) {
            $response = [
                'status' => 'success',
                'message' => 'fornecedor excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o fornecedor'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
