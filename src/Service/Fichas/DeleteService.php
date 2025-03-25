<?php

declare(strict_types=1);

namespace App\Service\Fichas;

use Cake\ORM\Table;

class DeleteService
{
    private Table $fichas;

    public function __construct(Table $fichas)
    {
        $this->fichas = $fichas;
    }

    public function run(int $id): array
    {
        $ficha = $this->fichas->get($id);

        if ($this->fichas->delete($ficha)) {
            return ['success' => true, 'message' => 'Ficha deletada com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar a ficha.'];
    }
}
