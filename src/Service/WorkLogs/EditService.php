<?php

declare(strict_types=1);

namespace App\Service\WorkLogs;

use Cake\ORM\Table;

class EditService
{
    private Table $workLogs;

    public function __construct(Table $workLogs)
    {
        $this->workLogs = $workLogs;
    }

    public function run(int $id, array $data): array
    {
        $workLog = $this->workLogs->get($id);

        $duplicateLog = $this->workLogs->find()
            ->where([
                'log_date' => $data['log_date'],
                'log_type' => $data['log_type'],
                'id !=' => $id,
            ])
            ->first();

        if ($duplicateLog) {
            $collaboratorName = $duplicateLog->collaborator->name ?? 'Colaborador';
            $formattedDate = (new \DateTime($data['log_date']))->format('d/m/Y');
            return [
                'success' => false,
                'message' => sprintf(
                    'Já existe um registro de %s para a data %s por %s.',
                    $data['log_type'] === 'entrada' ? 'entrada' : 'saída',
                    $formattedDate,
                    $collaboratorName
                ),
            ];
        }

        $this->workLogs->patchEntity($workLog, $data);

        if ($this->workLogs->save($workLog)) {
            return ['success' => true, 'message' => 'Registro de trabalho editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o registro de trabalho.'];
    }

    public function getEditData(int $id)
    {
        return ['workLog' => $this->workLogs->get($id)];
    }
}
