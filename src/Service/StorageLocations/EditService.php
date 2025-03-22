<?php

declare(strict_types=1);

namespace App\Service\StorageLocations;

use Cake\ORM\Table;

class EditService
{
    private Table $storageLocations;

    public function __construct(Table $storageLocations)
    {
        $this->storageLocations = $storageLocations;
    }

    public function run(int $id, array $data): array
    {
        $storageLocation = $this->storageLocations->get($id);
        $this->storageLocations->patchEntity($storageLocation, $data);

        if ($this->storageLocations->save($storageLocation)) {
            return ['success' => true, 'message' => 'Local de armazenamento editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o local de armazenamento.'];
    }

    public function getEditData(int $id)
    {
        return ['storageLocation' => $this->storageLocations->get($id)];
    }
}
