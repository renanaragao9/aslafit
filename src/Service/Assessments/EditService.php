<?php

declare(strict_types=1);

namespace App\Service\Assessments;

use Cake\ORM\Table;

class EditService
{
    private Table $assessments;

    public function __construct(Table $assessments)
    {
        $this->assessments = $assessments;
    }

    public function run(int $id, array $data): array
    {
        $assessment = $this->assessments->get($id);

        $existingActiveAssessment = $this->assessments->find()
            ->where(['ficha_id' => $data['ficha_id'], 'active' => true, 'id !=' => $id])
            ->first();

        if ($existingActiveAssessment) {
            return [
                'success' => false,
                'message' => 'Já existe uma avaliação ativa para esta ficha.'
            ];
        }

        $this->assessments->patchEntity($assessment, $data);

        if ($this->assessments->save($assessment)) {
            return ['success' => true, 'message' => 'Avaliação editada com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar a avaliação.'];
    }
    public function getEditData(int $id)
    {
        return ['assessment' => $this->assessments->get($id)];
    }
}
