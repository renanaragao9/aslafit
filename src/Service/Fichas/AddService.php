<?php

declare(strict_types=1);

namespace App\Service\Fichas;

use Cake\ORM\Table;

class AddService
{
    private Table $fichas;

    public function __construct(Table $fichas)
    {
        $this->fichas = $fichas;
    }

    public function run(array $data): array
    {
        $ficha = $this->fichas->newEntity($data);

        if ($this->fichas->save($ficha)) {
            return ['success' => true, 'message' => 'Ficha salva com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar a ficha.'];
    }

    public function getNewEntity()
    {
        return $this->fichas->newEmptyEntity();
    }
}
