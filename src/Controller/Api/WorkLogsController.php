<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class WorkLogsController extends AppController
{
    public function fetchWorkLogs(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->WorkLogs->find('all')->toArray();
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

    public function fetchworkLog($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->WorkLogs->get($id);
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

    public function addWorkLogs(): Response
    {
        $this->request->allowMethod(['post']);

        $workLog = $this->WorkLogs->newEmptyEntity();
        $workLog = $this->WorkLogs->patchEntity($workLog, $this->request->getData());

        if ($this->WorkLogs->save($workLog)) {
            $response = [
                'status' => 'success',
                'data' => $workLog
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o registro de trabalho'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editWorkLogs($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $workLog = $this->WorkLogs->get($id);
        $workLog = $this->WorkLogs->patchEntity($workLog, $this->request->getData());

        if ($this->WorkLogs->save($workLog)) {
            $response = [
                'status' => 'success',
                'data' => $workLog
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o registro de trabalho'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteWorkLogs($id): Response
    {
        $this->request->allowMethod(['delete']);

        $workLog = $this->WorkLogs->get($id);

        if ($this->WorkLogs->delete($workLog)) {
            $response = [
                'status' => 'success',
                'message' => 'registro de trabalho excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o registro de trabalho'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
