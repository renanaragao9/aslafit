<?php

declare(strict_types=1);

namespace App\Service\WorkLogs;

use Cake\ORM\Table;
use Cake\I18n\FrozenDate;

class AddService
{
    private Table $workLogs;

    public function __construct(Table $workLogs)
    {
        $this->workLogs = $workLogs;
    }

    public function run(array $data): array
    {
        $logDate = isset($data['log_date']) ? FrozenDate::parse($data['log_date']) : FrozenDate::today();

        $existingLogs = $this->workLogs->find()
            ->contain(['Collaborators'])
            ->where(['log_date' => $logDate])
            ->all();

        if ($existingLogs->count() >= 2) {
            $collaboratorName = $existingLogs->first()->collaborator->name ?? 'Colaborador';
            return ['success' => false, 'message' => sprintf('Já foram registrados entrada e saída para %s por %s.', $logDate->format('d/m/Y'), $collaboratorName)];
        }

        foreach ($existingLogs as $log) {
            if ($log->log_type === $data['log_type']) {
                $collaboratorName = $log->collaborator->name ?? 'Colaborador';
                return [
                    'success' => false,
                    'message' => sprintf('Já foi registrada uma %s para %s por %s.', $data['log_type'] === 'entrada' ? 'entrada' : 'saída', $logDate->format('d/m/Y'), $collaboratorName)
                ];
            }
        }

        $workLog = $this->workLogs->newEntity($data);

        if ($this->workLogs->save($workLog)) {
            return ['success' => true, 'message' => sprintf('Registro de trabalho salvo com sucesso para %s.', $logDate->format('d/m/Y'))];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o registro de trabalho.'];
    }

    public function getNewEntity()
    {
        return $this->workLogs->newEmptyEntity();
    }
}
