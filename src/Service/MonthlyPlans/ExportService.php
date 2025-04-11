<?php

declare(strict_types=1);

namespace App\Service\MonthlyPlans;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $monthlyPlans;

    public function __construct(Table $monthlyPlans)
    {
        $this->monthlyPlans = $monthlyPlans;
    }

    public function run(): Response
    {
        $records = $this->monthlyPlans->find('all', [
            'contain' => ['FormPayments', 'PlanTypes', 'Students', 'Collaborators'],
        ]);

        $csvData = [];

        $header = [
            'Aluno',
            'Colaborador',
            'Tipo de Plano',
            'Valor',
            'Forma de Pagamento',
            'Data de Pagamento',
            'Data de Vencimento',
            'Observação',
            'Criado em',
            'Atualizado em'
        ];
        $csvData[] = $header;

        foreach ($records as $record) {
            $csvData[] = [
                $record->student->name ?? '-',
                $record->collaborator->name ?? '-',
                $record->plan_type->name ?? '-',
                isset($record->value) ? number_format((float) $record->value, 2, ',', '.') : '-',
                $record->form_payment->name ?? '-',
                !empty($record->date_payment) ? $record->date_payment->format('d/m/Y') : '-',
                !empty($record->date_venciment) ? $record->date_venciment->format('d/m/Y') : '-',
                $record->observation ?? '-',
                $record->created->format('d/m/Y H:i:s'),
                $record->modified->format('d/m/Y H:i:s'),
            ];
        }

        $filename = 'mensalidades_' . date('Y-m-d_H-i-s') . '.csv';
        $filePath = TMP . $filename;

        $file = fopen($filePath, 'w');
        foreach ($csvData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);

        return (new Response())->withFile($filePath, ['download' => true, 'name' => $filename]);
    }
}
