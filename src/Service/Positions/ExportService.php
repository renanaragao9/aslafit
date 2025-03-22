<?php

declare(strict_types=1);

namespace App\Service\Positions;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $positions;

    public function __construct(Table $positions)
    {
        $this->positions = $positions;
    }

    public function run(): Response
    {
        $positions = $this->positions->find('all', ['contain' => ['Collaborators']])->toArray();

        $csvData = "ID,Nome,Descrição,Salário Base,Ativo,Criado,Modificado\n";
        foreach ($positions as $position) {
            $csvData .= sprintf(
                "%d,%s,%s,R$ %.2f,%s,%s,%s\n",
                $position->id,
                $position->name,
                $position->description,
                $position->base_salary,
                $position->active ? 'Sim' : 'Não',
                $position->created->format('d/m/Y H:i:s'),
                $position->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('cargos.csv');
    }
}
