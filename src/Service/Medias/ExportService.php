<?php

declare(strict_types=1);

namespace App\Service\Medias;

use Cake\ORM\Table;
use Cake\Http\Response;

class ExportService
{
    private Table $medias;

    public function __construct(Table $medias)
    {
        $this->medias = $medias;
    }

    public function run(): Response
    {
        $medias = $this->medias->find('all', [
            'contain' => ['Collaborators'],
        ]);

        $csvData = [];
        $header = ['ID', 'Título', 'Tipo', 'Imagem', 'Link', 'Descrição', 'Colaborador', 'Ativo', 'Criado', 'Modificado'];
        $csvData[] = $header;

        foreach ($medias as $media) {
            $csvData[] = [
                $media->id,
                $media->title,
                $media->type,
                $media->img,
                $media->link,
                $media->description,
                $media->collaborator_id,
                $media->active,
                $media->created->format('d/m/Y H:i:s'),
                $media->modified->format('d/m/Y H:i:s'),
            ];
        }

        $filename = 'medias_' . date('Y-m-d_H-i-s') . '.csv';
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
