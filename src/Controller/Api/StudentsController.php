<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Http\Response;

class StudentsController extends AppController
{
    public function fetchStudents(): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Students->find('all')->toArray();
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

    public function fetchstudent($id): Response
    {
        $this->request->allowMethod(['get']);

        try {
            $data = $this->Students->get($id);
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

    public function addStudents(): Response
    {
        $this->request->allowMethod(['post']);

        $student = $this->Students->newEmptyEntity();
        $student = $this->Students->patchEntity($student, $this->request->getData());

        if ($this->Students->save($student)) {
            $response = [
                'status' => 'success',
                'data' => $student
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível adicionar o aluno'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function editStudents($id): Response
    {
        $this->request->allowMethod(['put', 'patch']);

        $student = $this->Students->get($id);
        $student = $this->Students->patchEntity($student, $this->request->getData());

        if ($this->Students->save($student)) {
            $response = [
                'status' => 'success',
                'data' => $student
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível atualizar o aluno'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function deleteStudents($id): Response
    {
        $this->request->allowMethod(['delete']);

        $student = $this->Students->get($id);

        if ($this->Students->delete($student)) {
            $response = [
                'status' => 'success',
                'message' => 'aluno excluído com sucesso'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível excluir o aluno'
            ];
        }

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
}
