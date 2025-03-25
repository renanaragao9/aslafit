<?php

declare(strict_types=1);

namespace App\Service\Exercises;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $exercises;

    public function __construct(Table $exercises)
    {
        $this->exercises = $exercises;
    }

    public function run(): Response
    {
        $exercises = $this->exercises->find('all', ['contain' => ['Equipments', 'MuscleGroups', 'ExerciseTrainingDivision']])->toArray();

        $csvData = "ID,Nome,Imagem,GIF,Link,Ativo,ID do Equipamento,ID do Grupo Muscular,Criado,Modificado\n";
        foreach ($exercises as $exercise) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s,%d,%d,%s,%s\n",
                $exercise->id,
                $exercise->name,
                $exercise->image,
                $exercise->gif,
                $exercise->link,
                $exercise->active ? 'Sim' : 'Não',
                $exercise->equipment_id,
                $exercise->muscle_group_id,
                $exercise->created->format('d/m/Y H:i:s'),
                $exercise->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('exercicios.csv');
    }
}
