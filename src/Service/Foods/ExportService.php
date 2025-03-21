<?php

declare(strict_types=1);

namespace App\Service\Foods;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $foods;

    public function __construct(Table $foods)
    {
        $this->foods = $foods;
    }

    public function run(): Response
    {
        $foods = $this->foods->find('all', ['contain' => ['DietPlans']])->toArray();

        $csvData = "ID,Nome,Link,Ativo,Criado,Modificado\n";
        foreach ($foods as $food) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s\n",
                $food->id,
                $food->name,
                $food->link,
                $food->active ? 'Sim' : 'Não',
                $food->created->format('Y-m-d H:i:s'),
                $food->modified->format('Y-m-d H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('alimentos.csv');
    }
}
