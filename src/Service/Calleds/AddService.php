<?php

declare(strict_types=1);

namespace App\Service\Calleds;

use Cake\ORM\Table;

class AddService
{
    private Table $calleds;

    public function __construct(Table $calleds)
    {
        $this->calleds = $calleds;
    }

    public function run(array $data): array
    {
        $called = $this->calleds->newEntity($data);

        if ($this->calleds->save($called)) {
            return ['success' => true, 'message' => 'Chamado salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Chamado não salvo. Por favor, tente novamente.'];
    }

    public function getFormData(): array
    {
        return [
            'called' => $this->calleds->newEmptyEntity(),
            'collaborators' => $this->calleds->Collaborators->find('list', ['limit' => 200])->all(),
            'students' => $this->calleds->Students->find('list', ['limit' => 200])->all(),
        ];
    }
}
