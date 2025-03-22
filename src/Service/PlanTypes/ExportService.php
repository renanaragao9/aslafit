<?php

declare(strict_types=1);

namespace App\Service\PlanTypes;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $planTypes;

    public function __construct(Table $planTypes)
    {
        $this->planTypes = $planTypes;
    }

    public function run(): Response
    {
        $planTypes = $this->planTypes->find('all', ['contain' => ['MonthlyPlans']])->toArray();

        $csvData = "ID,Nome,Valor,Meses,Ativo,Criado,Modificado\n";
        foreach ($planTypes as $planType) {
            $csvData .= sprintf(
                "%d,%s,%.2f,%d,%s,%s,%s\n",
                $planType->id,
                $planType->name,
                $planType->value,
                $planType->months,
                $planType->active ? 'Sim' : 'Não',
                $planType->created->format('d/m/Y H:i:s'),
                $planType->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('tipos_de_planos.csv');
    }
}
