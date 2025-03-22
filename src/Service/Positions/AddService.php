<?php

declare(strict_types=1);

namespace App\Service\Positions;

use Cake\ORM\Table;

class AddService
{
    private Table $positions;

    public function __construct(Table $positions)
    {
        $this->positions = $positions;
    }

    public function run(array $data): array
    {
        if (isset($data['base_salary'])) {
            $data['base_salary'] = (float)str_replace(['.', ','], ['', '.'], $data['base_salary']);
        }

        $position = $this->positions->newEntity($data);

        if ($this->positions->save($position)) {
            return ['success' => true, 'message' => 'Cargo salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o cargo.'];
    }

    public function getNewEntity()
    {
        return $this->positions->newEmptyEntity();
    }
}
