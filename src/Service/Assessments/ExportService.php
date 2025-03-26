<?php

declare(strict_types=1);

namespace App\Service\Assessments;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $assessments;

    public function __construct(Table $assessments)
    {
        $this->assessments = $assessments;
    }

    public function run(): Response
    {
        $assessments = $this->assessments->find('all', [
            'contain' => ['Fichas']
        ])->toArray();

        $csvData = "ID,Objetivo,Criado,Modificado\n";
        foreach ($assessments as $assessment) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s\n",
                $assessment->id,
                $assessment->goal,
                $assessment->created->format('d/m/Y H:i:s'),
                $assessment->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('assessments.csv');
    }
}
