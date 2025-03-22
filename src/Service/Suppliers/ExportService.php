<?php

declare(strict_types=1);

namespace App\Service\Suppliers;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $suppliers;

    public function __construct(Table $suppliers)
    {
        $this->suppliers = $suppliers;
    }

    public function run(): Response
    {
        $suppliers = $this->suppliers->find('all', ['contain' => ['Items']])->toArray();

        $csvData = "ID,Nome,Informações de Contato,Ativo,Criado,Modificado\n";
        foreach ($suppliers as $supplier) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s\n",
                $supplier->id,
                $supplier->name,
                $supplier->contact_info,
                $supplier->active ? 'Sim' : 'Não',
                $supplier->created->format('d/m/Y H:i:s'),
                $supplier->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('fornecedores.csv');
    }
}
