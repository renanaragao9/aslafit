<?php

declare(strict_types=1);

namespace App\Service\Collaborators;

use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;

class AddService
{
    private Table $collaborators;

    public function __construct(Table $collaborators)
    {
        $this->collaborators = $collaborators;
    }

    public function run(array $data): array
    {
        $usersTable = TableRegistry::getTableLocator()->get('Users');

        $existingUser = $usersTable->find()
            ->where(['email' => $data['user_email']])
            ->first();

        if ($existingUser) {
            return ['success' => false, 'message' => 'Este e-mail já está sendo utilizado por outro usuário.'];
        }

        $user = $usersTable->newEmptyEntity();
        $user->name = $data['name'];
        $user->email = $data['user_email'];
        $user->password = (new DefaultPasswordHasher())->hash('123456');
        $user->last_login = null;
        $user->login_count = 0;
        $user->role_id = $data['role_id'];
        $user->active = true;

        if (!$usersTable->save($user)) {
            return ['success' => false, 'message' => 'Erro ao criar o usuário.'];
        }

        $data['user_id'] = $user->id;
        unset($data['user_email'], $data['role_id']);

        $collaborator = $this->collaborators->newEntity($data);

        if ($this->collaborators->save($collaborator)) {
            return ['success' => true, 'message' => 'Colaborador salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar colaborador.'];
    }

    public function getNewEntity()
    {
        return $this->collaborators->newEmptyEntity();
    }
}
