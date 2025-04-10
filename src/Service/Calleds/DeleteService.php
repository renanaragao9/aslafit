<?php

declare(strict_types=1);

namespace App\Service\Calleds;

use Cake\ORM\Table;

class DeleteService
{
    private Table $calleds;

    public function __construct(Table $calleds)
    {
        $this->calleds = $calleds;
    }

    public function run(int $id): array
    {
        $called = $this->calleds->get($id);

        if ($this->calleds->delete($called)) {
            return ['success' => true, 'message' => 'Chamado deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Chamado não deletado. Por favor, tente novamente.'];
    }
}
