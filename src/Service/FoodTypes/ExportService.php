<?php

declare(strict_types=1);

namespace App\Service\FoodTypes;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $foodTypes;

    public function __construct(Table $foodTypes)
    {
        $this->foodTypes = $foodTypes;
    }

    public function run(): Response
    {
        $foodTypes = $this->foodTypes->find('all', [
            'contain' => ['Foods']
        ])->toArray();

        $csvData = "ID,Nome,Descrição,Ativo,Criado,Modificado\n";
        foreach ($foodTypes as $foodType) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s\n",
                $foodType->id,
                $foodType->name,
                $foodType->description,
                $foodType->active ? 'Sim' : 'Não',
                $foodType->created->format('d/m/Y H:i:s'),
                $foodType->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('tipo_alimentos.csv');
    }
}
