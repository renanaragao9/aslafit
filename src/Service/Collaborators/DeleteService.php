<?php

declare(strict_types=1);

namespace App\Service\Collaborators;

use Cake\ORM\Table;

class DeleteService
{
    private Table $collaborators;

    public function __construct(Table $collaborators)
    {
        $this->collaborators = $collaborators;
    }

    public function run(int $id): array
    {
        $collaborator = $this->collaborators->get($id);

        if ($this->collaborators->delete($collaborator)) {
            return ['success' => true, 'message' => 'Colaborador deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o colaborador.'];
    }
}
