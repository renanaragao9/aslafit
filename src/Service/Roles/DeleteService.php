<?php

declare(strict_types=1);

namespace App\Service\Roles;

use Cake\ORM\Table;

class DeleteService
{
    private Table $roles;

    public function __construct(Table $roles)
    {
        $this->roles = $roles;
    }

    public function run(int $id): array
    {
        if ($id === 1) {
            return ['success' => false, 'message' => __('Perfil de administrador não pode ser apagado.')];
        }

        $role = $this->roles->get($id);

        if ($this->roles->delete($role)) {
            $this->roles->RolesPermissions->deleteAll(['role_id' => $role->id]);
            return ['success' => true, 'message' => __('Perfil deletado com sucesso.')];
        }

        return ['success' => false, 'message' => __('Perfil não deletado. Por favor, tente novamente.')];
    }
}
