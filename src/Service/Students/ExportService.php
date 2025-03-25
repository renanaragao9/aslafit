<?php

declare(strict_types=1);

namespace App\Service\Students;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $students;

    public function __construct(Table $students)
    {
        $this->students = $students;
    }

    public function run(): Response
    {
        $students = $this->students->find('all', [
            'contain' => ['Users', 'Assessments', 'Calleds', 'DietPlans', 'EventRegistrations', 'Fichas', 'MonthlyPlans']
        ])->toArray();

        $csvData = "ID,Nome,Data de Nascimento,Data de Entrada,Gênero,Peso,Altura,Ativo,Usuário,Criado,Modificado\n";
        foreach ($students as $student) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%.2f,%.2f,%s,%s,%s,%s\n",
                $student->id,
                $student->name,
                $student->birth_date,
                $student->entry_date,
                $student->gender,
                $student->weight,
                $student->height,
                $student->active ? 'Sim' : 'Não',
                $student->user->email,
                $student->created->format('d/m/Y H:i:s'),
                $student->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('estudantes.csv');
    }
}
