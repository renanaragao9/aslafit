<?php

declare(strict_types=1);

namespace App\Service\Equipments;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $equipments;

    public function __construct(Table $equipments)
    {
        $this->equipments = $equipments;
    }

    public function run(): Response
    {
        $equipments = $this->equipments->find('all')->toArray();

        $csvData = "ID,Nome,Ativo,Criado,Modificado\n";
        foreach ($equipments as $equipment) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s\n",
                $equipment->id,
                $equipment->name,
                $equipment->active ? 'Sim' : 'Não',
                $equipment->created->format('d/m/Y H:i:s'),
                $equipment->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('equipamentos.csv');
    }
}
