<?php

declare(strict_types=1);

namespace App\Service\StorageLocations;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $storageLocations;

    public function __construct(Table $storageLocations)
    {
        $this->storageLocations = $storageLocations;
    }

    public function run(): Response
    {
        $storageLocations = $this->storageLocations->find('all', ['contain' => ['Items']])->toArray();

        $csvData = "ID,Nome,Descrição,Ativo,Criado,Modificado\n";
        foreach ($storageLocations as $location) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s\n",
                $location->id,
                $location->name,
                $location->description ?? '-',
                $location->active ? 'Sim' : 'Não',
                $location->created->format('d/m/Y H:i:s'),
                $location->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('locais_de_armazenamento.csv');
    }
}
