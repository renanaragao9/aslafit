<?php

declare(strict_types=1);

namespace App\Service\DietPlans;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $dietPlans;

    public function __construct(Table $dietPlans)
    {
        $this->dietPlans = $dietPlans;
    }

    public function run(): Response
    {
        $dietPlans = $this->dietPlans->find('all', [
            'contain' => ['MealTypes', 'Foods', 'Fichas.Students']
        ])->toArray();

        $csvData = "ID,Ficha,Tipo de Refeição,Comida,Descrição,Ativo,Criado,Modificado\n";
        foreach ($dietPlans as $dietPlan) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s,%s,%s\n",
                $dietPlan->id,
                $dietPlan->ficha->student->name ?? 'N/A',
                $dietPlan->meal_type->name ?? 'N/A',
                $dietPlan->food->name ?? 'N/A',
                $dietPlan->description,
                $dietPlan->active ? 'Sim' : 'Não',
                $dietPlan->created->format('d/m/Y H:i:s'),
                $dietPlan->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('planos_de_dieta.csv');
    }
}
