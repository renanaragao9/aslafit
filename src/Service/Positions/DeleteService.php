<?php

declare(strict_types=1);

namespace App\Service\Positions;

use Cake\ORM\Table;

class DeleteService
{
    private Table $positions;

    public function __construct(Table $positions)
    {
        $this->positions = $positions;
    }

    public function run(int $id): array
    {
        $position = $this->positions->get($id);

        if ($this->positions->delete($position)) {
            return ['success' => true, 'message' => 'Cargo deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o cargo.'];
    }
}
