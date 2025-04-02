<?php

declare(strict_types=1);

namespace App\Service\Foods;

use Cake\ORM\Table;

class AddService
{
    private Table $foods;

    public function __construct(Table $foods)
    {
        $this->foods = $foods;
    }

    public function run(array $data): array
    {
        if (!empty($data['image']) && $data['image']->getError() === UPLOAD_ERR_OK) {
            $ext = pathinfo($data['image']->getClientFilename(), PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $ext;
            $imagePath = WWW_ROOT . 'img' . DS . 'Foods' . DS . $filename;
            $data['image']->moveTo($imagePath);
            $data['image'] = $filename;
        } else {
            unset($data['image']);
        }

        $food = $this->foods->newEntity($data);

        if ($this->foods->save($food)) {
            return ['success' => true, 'message' => 'Alimento salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o alimento.'];
    }

    public function getNewEntity()
    {
        return $this->foods->newEmptyEntity();
    }
}
