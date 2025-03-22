<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class FormPaymentsController extends AppController
{
    public function fetchFormPayments(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->FormPayments->find('all')->toArray();
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

    public function fetchformPayment($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->FormPayments->get($id);
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

    public function addFormPayments(): Response
    {
        $this->request->allowMethod(['post']);

        $formPayment = $this->FormPayments->newEmptyEntity();
        $formPayment = $this->FormPayments->patchEntity($formPayment, $this->request->getData());

        if ($this->FormPayments->save($formPayment)) {
            $response = [
                'status' => 'success',
                'data' => $formPayment
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar a forma de pagamento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editFormPayments($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $formPayment = $this->FormPayments->get($id);
        $formPayment = $this->FormPayments->patchEntity($formPayment, $this->request->getData());

        if ($this->FormPayments->save($formPayment)) {
            $response = [
                'status' => 'success',
                'data' => $formPayment
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar a forma de pagamento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteFormPayments($id): Response
    {
        $this->request->allowMethod(['delete']);

        $formPayment = $this->FormPayments->get($id);

        if ($this->FormPayments->delete($formPayment)) {
            $response = [
                'status' => 'success',
                'message' => 'Forma de pagamento excluída com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir a forma de pagamento'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
