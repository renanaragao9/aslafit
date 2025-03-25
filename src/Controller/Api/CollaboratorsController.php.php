<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class CollaboratorsController extends AppController
{
    public function fetchCollaborators(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Collaborators->find('all')->toArray();
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

    public function fetchcollaborator($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Collaborators->get($id);
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

    public function addCollaborators(): Response
    {
        $this->request->allowMethod(['post']);

        $collaborator = $this->Collaborators->newEmptyEntity();
        $collaborator = $this->Collaborators->patchEntity($collaborator, $this->request->getData());

        if ($this->Collaborators->save($collaborator)) {
            $response = [
                'status' => 'success',
                'data' => $collaborator
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o colaborador'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editCollaborators($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $collaborator = $this->Collaborators->get($id);
        $collaborator = $this->Collaborators->patchEntity($collaborator, $this->request->getData());

        if ($this->Collaborators->save($collaborator)) {
            $response = [
                'status' => 'success',
                'data' => $collaborator
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o colaborador'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteCollaborators($id): Response
    {
        $this->request->allowMethod(['delete']);

        $collaborator = $this->Collaborators->get($id);

        if ($this->Collaborators->delete($collaborator)) {
            $response = [
                'status' => 'success',
                'message' => 'colaborador excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o colaborador'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
