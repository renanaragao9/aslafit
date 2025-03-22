<?php

declare(strict_types=1);

namespace App\Service\StorageLocations;

use Cake\ORM\Table;

class DeleteService
{
    private Table $storageLocations;

    public function __construct(Table $storageLocations)
    {
        $this->storageLocations = $storageLocations;
    }

    public function run(int $id): array
    {
        $storageLocation = $this->storageLocations->get($id);

        if ($this->storageLocations->delete($storageLocation)) {
            return ['success' => true, 'message' => 'Local de armazenamento deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o local de armazenamento.'];
    }
}
