<?php

declare(strict_types=1);

namespace App\Service\Exercises;

use Cake\ORM\Table;

class AddService
{
    private Table $exercises;

    public function __construct(Table $exercises)
    {
        $this->exercises = $exercises;
    }

    public function run(array $data): array
    {
        if (!empty($data['image']) && $data['image']->getError() === UPLOAD_ERR_OK) {
            $ext = pathinfo($data['image']->getClientFilename(), PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $ext;
            $imagePath = WWW_ROOT . 'img' . DS . 'exercises' . DS . 'img' . DS . $filename;
            $data['image']->moveTo($imagePath);
            $data['image'] = $filename;
        } else {
            unset($data['image']);
        }

        if (!empty($data['gif']) && $data['gif']->getError() === UPLOAD_ERR_OK) {
            $ext = pathinfo($data['gif']->getClientFilename(), PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $ext;
            $gifPath = WWW_ROOT . 'img' . DS . 'exercises' . DS . 'gif' . DS . $filename;
            $data['gif']->moveTo($gifPath);
            $data['gif'] = $filename;
        } else {
            unset($data['gif']);
        }

        $exercise = $this->exercises->newEntity($data);

        if ($this->exercises->save($exercise)) {
            return ['success' => true, 'message' => 'Exercício salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o exercício.'];
    }

    public function getNewEntity()
    {
        return $this->exercises->newEmptyEntity();
    }
}
