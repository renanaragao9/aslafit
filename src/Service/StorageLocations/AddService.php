<?php

declare(strict_types=1);

namespace App\Service\StorageLocations;

use Cake\ORM\Table;

class AddService
{
    private Table $storageLocations;

    public function __construct(Table $storageLocations)
    {
        $this->storageLocations = $storageLocations;
    }

    public function run(array $data): array
    {
        $storageLocation = $this->storageLocations->newEntity($data);

        if ($this->storageLocations->save($storageLocation)) {
            return ['success' => true, 'message' => 'Local de armazenamento salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o local de armazenamento.'];
    }

    public function getNewEntity()
    {
        return $this->storageLocations->newEmptyEntity();
    }
}
