<?php

declare(strict_types=1);

namespace App\Service\Assessments;

use Cake\ORM\Table;

class DeleteService
{
    private Table $assessments;

    public function __construct(Table $assessments)
    {
        $this->assessments = $assessments;
    }

    public function run(int $id): array
    {
        $assessment = $this->assessments->get($id);

        if ($this->assessments->delete($assessment)) {
            return ['success' => true, 'message' => 'Avaliação excluída com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao excluir a avaliação.'];
    }
}
