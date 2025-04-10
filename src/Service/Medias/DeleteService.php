<?php

declare(strict_types=1);

namespace App\Service\Medias;

use Cake\ORM\Table;

class DeleteService
{
    private Table $medias;

    public function __construct(Table $medias)
    {
        $this->medias = $medias;
    }

    public function run(int $id): array
    {
        $media = $this->medias->get($id);

        if ($this->medias->delete($media)) {
            if (!empty($media->img)) {
                $imagePath = WWW_ROOT . 'img' . DS . 'Medias' . DS . $media->img;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            return ['success' => true, 'message' => 'Mídia deletada com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar a mídia.'];
    }
}
