<?php

declare(strict_types=1);

namespace App\Service\Collaborators;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $collaborators;

    public function __construct(Table $collaborators)
    {
        $this->collaborators = $collaborators;
    }

    public function run(): Response
    {
        $collaborators = $this->collaborators->find('all', [
            'contain' => ['Positions', 'Users']
        ]);

        $csvData = "ID,Nome,Data de Nascimento,Data de Entrada,Gênero,Ativo,Cargo,Usuário,Criado,Modificado\n";
        foreach ($collaborators as $collaborator) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s,%s,%s,%s,%s\n",
                $collaborator->id,
                $collaborator->name,
                $collaborator->birth_date->format('d/m/Y'),
                $collaborator->entry_date->format('d/m/Y'),
                $collaborator->gender,
                $collaborator->active ? 'Sim' : 'Não',
                $collaborator->position->name,
                $collaborator->user->email,
                $collaborator->created->format('d/m/Y H:i:s'),
                $collaborator->modified->format('d/m/Y H:i:s')
            );
        }

        $response = new Response([
            'body' => $csvData,
            'type' => 'text/csv',
        ]);

        return $response->withDownload('colaboradores.csv');
    }
}
