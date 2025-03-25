<?php

declare(strict_types=1);

namespace App\Service\Collaborators;

use Cake\ORM\Table;

class AddService
{
    private Table $collaborators;

    public function __construct(Table $collaborators)
    {
        $this->collaborators = $collaborators;
    }

    public function run(array $data): array
    {
        $collaborator = $this->collaborators->newEntity($data);

        if ($this->collaborators->save($collaborator)) {
            return ['success' => true, 'message' => 'Colaborador salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar colaborador.'];
    }

    public function getNewEntity()
    {
        return $this->collaborators->newEmptyEntity();
    }
}
