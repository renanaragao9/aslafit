<?php

declare(strict_types=1);

namespace App\Service\Fichas;

use Cake\ORM\Table;

class EditService
{
    private Table $fichas;

    public function __construct(Table $fichas)
    {
        $this->fichas = $fichas;
    }

    public function run(int $id, array $data): array
    {
        $ficha = $this->fichas->get($id);
        $this->fichas->patchEntity($ficha, $data);

        if ($this->fichas->save($ficha)) {
            return ['success' => true, 'message' => 'Ficha editada com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar a ficha.'];
    }

    public function getEditData(int $id)
    {
        return ['ficha' => $this->fichas->get($id)];
    }
}
