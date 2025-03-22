<?php

declare(strict_types=1);

namespace App\Service\MealTypes;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $mealTypes;

    public function __construct(Table $mealTypes)
    {
        $this->mealTypes = $mealTypes;
    }

    public function run(): Response
    {
        $mealTypes = $this->mealTypes->find('all');

        $csvData = "ID,Nome,Ativo,Criado,Modificado\n";
        foreach ($mealTypes as $type) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s\n",
                $type->id,
                $type->name,
                $type->active ? 'Sim' : 'Não',
                $type->created->format('d/m/Y H:i:s'),
                $type->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('tipos_de_refeicao.csv');
    }
}
