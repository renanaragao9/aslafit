<?php

declare(strict_types=1);

namespace App\Service\FormPayments;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $formPayments;

    public function __construct(Table $formPayments)
    {
        $this->formPayments = $formPayments;
    }

    public function run(): Response
    {
        $formPayments = $this->formPayments->find('all', ['contain' => []])->toArray();

        $csvData = "ID,Nome,Bandeira,Ativo,Criado,Modificado\n";
        foreach ($formPayments as $payment) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s\n",
                $payment->id,
                $payment->name,
                $payment->flag,
                $payment->active ? 'Sim' : 'Não',
                $payment->created->format('d/m/Y H:i:s'),
                $payment->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('metodos_de_pagamento.csv');
    }
}
