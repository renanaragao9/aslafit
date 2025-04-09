<?php

declare(strict_types=1);

namespace App\Service\Users;

use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

class AddService
{
    private Table $users;

    public function __construct(Table $users)
    {
        $this->users = $users;
    }

    public function run(array $data): array
    {
        $existing = $this->users->find()
            ->where(['email' => $data['email']])
            ->first();

        if ($existing) {
            return ['success' => false, 'message' => 'Este e-mail já está sendo utilizado por outro usuário.'];
        }

        if (!empty($data['password'])) {
            $data['password'] = (new DefaultPasswordHasher())->hash($data['password']);
        }

        $user = $this->users->newEmptyEntity();
        $user = $this->users->patchEntity($user, $data);

        if ($this->users->save($user)) {
            return ['success' => true, 'message' => __('O usuário foi salvo com sucesso.')];
        }

        return ['success' => false, 'message' => __('O usuário não pode ser salvo. Por favor, tente novamente.')];
    }

    public function getNewEntity()
    {
        return $this->users->newEmptyEntity();
    }
}
