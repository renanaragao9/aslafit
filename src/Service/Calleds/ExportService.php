<?php

declare(strict_types=1);

namespace App\Service\Calleds;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $calleds;

    public function __construct(Table $calleds)
    {
        $this->calleds = $calleds;
    }

    public function run(): Response
    {
        $calleds = $this->calleds->find('all', [
            'contain' => ['Collaborators', 'Students'],
        ]);

        $csvData = [];
        $header = ['ID', 'Urgência', 'Título', 'Assunto', 'Status', 'Colaborador', 'Aluno', 'Criado', 'Modificado'];
        $csvData[] = $header;

        foreach ($calleds as $called) {
            $csvData[] = [
                $called->id,
                $called->urgency,
                $called->title,
                $called->subject,
                $called->status,
                $called->collaborator_id,
                $called->student_id,
                $called->created->format('d/m/Y H:i:s'),
                $called->modified->format('d/m/Y H:i:s'),
            ];
        }

        $filename = 'chamados_' . date('Y-m-d_H-i-s') . '.csv';
        $filePath = TMP . $filename;

        $file = fopen($filePath, 'w');
        foreach ($csvData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);

        return (new Response())->withFile(
            $filePath,
            ['download' => true, 'name' => $filename]
        );
    }
}
