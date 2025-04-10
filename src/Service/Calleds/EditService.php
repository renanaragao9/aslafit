<?php

declare(strict_types=1);

namespace App\Service\Calleds;

use Cake\ORM\Table;

class EditService
{
    private Table $calleds;

    public function __construct(Table $calleds)
    {
        $this->calleds = $calleds;
    }

    public function run(int $id, array $data): array
    {
        $called = $this->calleds->get($id);
        $this->calleds->patchEntity($called, $data);

        if ($this->calleds->save($called)) {
            return ['success' => true, 'message' => 'Chamado editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Chamado não editado. Por favor, tente novamente.'];
    }

    public function getEditData(int $id): array
    {
        return [
            'called' => $this->calleds->get($id),
            'collaborators' => $this->calleds->Collaborators->find('list', ['limit' => 200])->all(),
            'students' => $this->calleds->Students->find('list', ['limit' => 200])->all(),
        ];
    }
}
