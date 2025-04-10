<?php

declare(strict_types=1);

namespace App\Service\Medias;

use Cake\ORM\Table;

class AddService
{
    private Table $medias;

    public function __construct(Table $medias)
    {
        $this->medias = $medias;
    }

    public function run(array $data): array
    {
        if (!empty($data['img']) && $data['img']->getError() === UPLOAD_ERR_OK) {
            $ext = pathinfo($data['img']->getClientFilename(), PATHINFO_EXTENSION);
            $filename = uniqid('media_') . '.' . $ext;
            $imagePath = WWW_ROOT . 'img' . DS . 'Medias' . DS . $filename;

            if (!is_dir(dirname($imagePath))) {
                mkdir(dirname($imagePath), 0775, true);
            }

            $data['img']->moveTo($imagePath);
            $data['img'] = $filename;
        } else {
            unset($data['img']);
        }

        $media = $this->medias->newEntity($data);

        if ($this->medias->save($media)) {
            return ['success' => true, 'message' => 'Mídia salva com sucesso.'];
        }

        return ['success' => false, 'message' => 'Mídia não salva. Por favor, tente novamente.'];
    }

    public function getFormData(): array
    {
        return [
            'media' => $this->medias->newEmptyEntity(),
            'collaborators' => $this->medias->Collaborators->find('list', ['limit' => 200])->all(),
        ];
    }
}
