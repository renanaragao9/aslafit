<?php

declare(strict_types=1);

namespace App\Service\Assessments;

use Cake\ORM\Table;

class AddService
{
    private Table $assessments;

    public function __construct(Table $assessments)
    {
        $this->assessments = $assessments;
    }

    public function run(array $data): array
    {
        $existingActiveAssessment = $this->assessments->find()
            ->where(['ficha_id' => $data['ficha_id'], 'active' => true])
            ->first();

        if ($existingActiveAssessment) {
            return [
                'success' => false,
                'message' => 'Já existe uma avaliação ativa para esta ficha.'
            ];
        }

        $assessment = $this->assessments->newEntity($data);

        if ($this->assessments->save($assessment)) {
            return ['success' => true, 'message' => 'Avaliação salva com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar a avaliação.'];
    }

    public function getNewEntity()
    {
        return $this->assessments->newEmptyEntity();
    }
}
