<?php

declare(strict_types=1);

namespace App\Service\WorkLogs;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $workLogs;

    public function __construct(Table $workLogs)
    {
        $this->workLogs = $workLogs;
    }

    public function run(): Response
    {
        $workLogs = $this->workLogs->find('all', [
            'contain' => ['Collaborators']
        ])->toArray();

        $csvData = "ID,ID do Colaborador,Data,Tipo,Hora,Endereço,Latitude,Longitude,Criado,Modificado\n";
        foreach ($workLogs as $workLog) {
            $csvData .= sprintf(
                "%d,%d,%s,%s,%s,%s,%s,%s,%s,%s\n",
                $workLog->id,
                $workLog->collaborator_id,
                $workLog->log_date,
                $workLog->log_type,
                $workLog->log_time,
                $workLog->log_address,
                $workLog->latitude,
                $workLog->longitude,
                $workLog->created->format('Y-m-d H:i:s'),
                $workLog->modified->format('Y-m-d H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('registros_de_trabalho.csv');
    }
}
