<?php

declare(strict_types=1);

namespace App\Service\Exercises;

use Cake\ORM\Table;

class EditService
{
    private Table $exercises;

    public function __construct(Table $exercises)
    {
        $this->exercises = $exercises;
    }

    public function run(int $id, array $data): array
    {
        $exercise = $this->exercises->get($id);

        if (!empty($data['image']) && $data['image']->getError() === UPLOAD_ERR_OK) {
            if (!empty($exercise->image) && file_exists(WWW_ROOT . 'img' . DS . 'exercises' . DS . 'img' . DS . $exercise->image)) {
                unlink(WWW_ROOT . 'img' . DS . 'exercises' . DS . 'img' . DS . $exercise->image);
            }

            $ext = pathinfo($data['image']->getClientFilename(), PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $ext;
            $imagePath = WWW_ROOT . 'img' . DS . 'exercises' . DS . 'img' . DS . $filename;
            $data['image']->moveTo($imagePath);
            $data['image'] = $filename;
        } else {
            $data['image'] = $exercise->image;
        }

        if (!empty($data['gif']) && $data['gif']->getError() === UPLOAD_ERR_OK) {
            if (!empty($exercise->gif) && file_exists(WWW_ROOT . 'img' . DS . 'exercises' . DS . 'gif' . DS . $exercise->gif)) {
                unlink(WWW_ROOT . 'img' . DS . 'exercises' . DS . 'gif' . DS . $exercise->gif);
            }

            $ext = pathinfo($data['gif']->getClientFilename(), PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $ext;
            $gifPath = WWW_ROOT . 'img' . DS . 'exercises' . DS . 'gif' . DS . $filename;
            $data['gif']->moveTo($gifPath);
            $data['gif'] = $filename;
        } else {
            $data['gif'] = $exercise->gif;
        }

        $this->exercises->patchEntity($exercise, $data);

        if ($this->exercises->save($exercise)) {
            return ['success' => true, 'message' => 'Exercício editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o exercício.'];
    }

    public function getEditData(int $id)
    {
        return ['exercise' => $this->exercises->get($id)];
    }
}
