<?php

declare(strict_types=1);

namespace App\Service\Medias;

use Cake\ORM\Table;

class EditService
{
    private Table $medias;

    public function __construct(Table $medias)
    {
        $this->medias = $medias;
    }

    public function run(int $id, array $data): array
    {
        $media = $this->medias->get($id);

        if (!empty($data['img']) && $data['img']->getError() === UPLOAD_ERR_OK) {
            if (!empty($media->img)) {
                $oldPath = WWW_ROOT . 'img' . DS . 'Medias' . DS . $media->img;
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $ext = pathinfo($data['img']->getClientFilename(), PATHINFO_EXTENSION);
            $filename = uniqid('media_') . '.' . $ext;
            $imagePath = WWW_ROOT . 'img' . DS . 'Medias' . DS . $filename;

            if (!is_dir(dirname($imagePath))) {
                mkdir(dirname($imagePath), 0775, true);
            }

            $data['img']->moveTo($imagePath);
            $data['img'] = $filename;
        } else {
            $data['img'] = $media->img;
        }

        $this->medias->patchEntity($media, $data);

        if ($this->medias->save($media)) {
            return ['success' => true, 'message' => 'Mídia editada com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar a mídia.'];
    }

    public function getEditData(int $id): array
    {
        return [
            'media' => $this->medias->get($id),
            'collaborators' => $this->medias->Collaborators->find('list', ['limit' => 200])->all(),
        ];
    }
}
