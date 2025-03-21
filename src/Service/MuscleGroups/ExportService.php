<?php

declare(strict_types=1);

namespace App\Service\MuscleGroups;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $muscleGroups;

    public function __construct(Table $muscleGroups)
    {
        $this->muscleGroups = $muscleGroups;
    }

    public function run(): Response
    {
        $muscleGroups = $this->muscleGroups->find('all', ['contain' => ['Exercises']])->toArray();

        $csvData = "ID,Nome,Ativo,Criado,Modificado\n";
        foreach ($muscleGroups as $group) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s\n",
                $group->id,
                $group->name,
                $group->active ? 'Sim' : 'Não',
                $group->created->format('d/m/Y H:i:s'),
                $group->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('grupos_musculares.csv');
    }
}
