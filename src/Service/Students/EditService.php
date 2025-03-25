<?php

declare(strict_types=1);

namespace App\Service\Students;

use Cake\ORM\Table;

class EditService
{
    private Table $students;

    public function __construct(Table $students)
    {
        $this->students = $students;
    }

    public function run(int $id, array $data): array
    {
        $student = $this->students->get($id);
        $this->students->patchEntity($student, $data);

        if ($this->students->save($student)) {
            return ['success' => true, 'message' => 'Aluno editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o aluno.'];
    }

    public function getEditData(int $id)
    {
        return ['student' => $this->students->get($id)];
    }
}
