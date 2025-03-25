<?php

declare(strict_types=1);

namespace App\Service\Students;

use Cake\ORM\Table;

class DeleteService
{
    private Table $students;

    public function __construct(Table $students)
    {
        $this->students = $students;
    }

    public function run(int $id): array
    {
        $student = $this->students->get($id);

        if ($this->students->delete($student)) {
            return ['success' => true, 'message' => 'Aluno deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o aluno.'];
    }
}
