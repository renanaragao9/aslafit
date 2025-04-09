<?php

declare(strict_types=1);

namespace App\Service\Students;

use Cake\ORM\TableRegistry;
use Cake\ORM\Table;

class EditService
{
    private Table $students;

    public function __construct(Table $students)
    {
        $this->students = $students;
    }

    public function run(int $id, array $data): array
    {
        $student = $this->students->get($id, ['contain' => ['Users']]);

        if (isset($data['user_email'])) {
            $usersTable = TableRegistry::getTableLocator()->get('Users');

            $existingUser = $usersTable->find()
                ->where([
                    'email' => $data['user_email'],
                    'id !=' => $student->user_id
                ])
                ->first();

            if ($existingUser) {
                return ['success' => false, 'message' => 'Este e-mail já está sendo utilizado por outro usuário.'];
            }

            $user = $usersTable->get($student->user_id);
            $user->email = $data['user_email'];
            $usersTable->save($user);

            unset($data['user_email']);
        }

        $this->students->patchEntity($student, $data);

        if ($this->students->save($student)) {
            return ['success' => true, 'message' => 'Aluno editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o aluno.'];
    }

    public function getEditData(int $id)
    {
        return ['student' => $this->students->get($id, ['contain' => ['Users']])];
    }
}
