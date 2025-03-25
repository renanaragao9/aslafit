<?php

declare(strict_types=1);

namespace App\Service\Fichas;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $fichas;

    public function __construct(Table $fichas)
    {
        $this->fichas = $fichas;
    }

    public function run(): Response
    {
        $fichas = $this->fichas->find('all', [
            'contain' => ['Students', 'Assessments', 'DietPlans', 'ExerciseTrainingDivision']
        ])->toArray();

        $csvData = "ID,Data de Início,Data de Fim,Descrição,ID do Estudante,Ativo,Criado,Modificado\n";
        foreach ($fichas as $ficha) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s,%s,%s\n",
                $ficha->id,
                $ficha->start_date,
                $ficha->end_date,
                $ficha->description,
                $ficha->student->name,
                $ficha->active ? 'Sim' : 'Não',
                $ficha->created->format('d/m/Y H:i:s'),
                $ficha->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('fichas.csv');
    }
}
