<?php

declare(strict_types=1);

namespace App\Service\Positions;

use Cake\ORM\Table;

class EditService
{
    private Table $positions;

    public function __construct(Table $positions)
    {
        $this->positions = $positions;
    }

    public function run(int $id, array $data): array
    {
        if (isset($data['base_salary'])) {
            $data['base_salary'] = (float)str_replace(['.', ','], ['', '.'], $data['base_salary']);
        }

        $position = $this->positions->get($id);
        $this->positions->patchEntity($position, $data);

        if ($this->positions->save($position)) {
            return ['success' => true, 'message' => 'Cargo editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o cargo.'];
    }

    public function getEditData(int $id)
    {
        return ['position' => $this->positions->get($id)];
    }
}
