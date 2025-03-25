<?php

declare(strict_types=1);

namespace App\Service\WorkLogs;

use Cake\ORM\Table;

class DeleteService
{
    private Table $workLogs;

    public function __construct(Table $workLogs)
    {
        $this->workLogs = $workLogs;
    }

    public function run(int $id): array
    {
        $workLog = $this->workLogs->get($id);

        if ($this->workLogs->delete($workLog)) {
            return ['success' => true, 'message' => 'Registro de trabalho deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o registro de trabalho.'];
    }
}
