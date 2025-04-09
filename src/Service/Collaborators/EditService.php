<?php

declare(strict_types=1);

namespace App\Service\Collaborators;

use Cake\ORM\TableRegistry;
use Cake\ORM\Table;

class EditService
{
    private Table $collaborators;

    public function __construct(Table $collaborators)
    {
        $this->collaborators = $collaborators;
    }

    public function run(int $id, array $data): array
    {
        $collaborator = $this->collaborators->get($id, ['contain' => ['Users']]);
        $usersTable = TableRegistry::getTableLocator()->get('Users');

        if (isset($data['user_email'])) {
            $existingUser = $usersTable->find()
                ->where([
                    'email' => $data['user_email'],
                    'id !=' => $collaborator->user_id
                ])
                ->first();

            if ($existingUser) {
                return ['success' => false, 'message' => 'Este e-mail já está sendo utilizado por outro usuário.'];
            }

            $user = $usersTable->get($collaborator->user_id);
            $user->email = $data['user_email'];

            if (isset($data['role_id'])) {
                $user->role_id = $data['role_id'];
            }

            if (!$usersTable->save($user)) {
                return ['success' => false, 'message' => 'Erro ao atualizar o usuário.'];
            }

            unset($data['user_email'], $data['role_id']);
        }

        $this->collaborators->patchEntity($collaborator, $data);

        if ($this->collaborators->save($collaborator)) {
            return ['success' => true, 'message' => 'Colaborador editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o colaborador.'];
    }

    public function getEditData(int $id)
    {
        return ['collaborator' => $this->collaborators->get($id, ['contain' => ['Users']])];
    }
}
