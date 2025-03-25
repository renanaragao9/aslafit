<?php

declare(strict_types=1);

namespace App\Service\Students;

use Cake\ORM\Table;

class AddService
{
    private Table $students;

    public function __construct(Table $students)
    {
        $this->students = $students;
    }

    public function run(array $data): array
    {
        $student = $this->students->newEntity($data);

        if ($this->students->save($student)) {
            return ['success' => true, 'message' => 'Aluno salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o aluno.'];
    }

    public function getNewEntity()
    {
        return $this->students->newEmptyEntity();
    }
}
