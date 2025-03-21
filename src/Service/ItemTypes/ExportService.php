<?php

declare(strict_types=1);

namespace App\Service\ItemTypes;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $itemTypes;

    public function __construct(Table $itemTypes)
    {
        $this->itemTypes = $itemTypes;
    }

    public function run(): Response
    {
        $itemTypes = $this->itemTypes->find('all', ['contain' => ['Items', 'ItemsFields']])->toArray();

        $csvData = "ID,Nome,Descrição,Ativo,Criado,Modificado\n";
        foreach ($itemTypes as $type) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s\n",
                $type->id,
                $type->name,
                $type->description,
                $type->active ? 'Sim' : 'Não',
                $type->created->format('d/m/Y H:i:s'),
                $type->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('tipos_de_itens.csv');
    }
}
