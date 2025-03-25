<?php

declare(strict_types=1);

namespace App\Service\Collaborators;

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
        $collaborator = $this->collaborators->get($id);
        $this->collaborators->patchEntity($collaborator, $data);

        if ($this->collaborators->save($collaborator)) {
            return ['success' => true, 'message' => 'Colaborador editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o colaborador.'];
    }

    public function getEditData(int $id)
    {
        return ['collaborator' => $this->collaborators->get($id)];
    }
}
