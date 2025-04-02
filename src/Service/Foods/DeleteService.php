<?php

declare(strict_types=1);

namespace App\Service\Foods;

use Cake\ORM\Table;

class DeleteService
{
    private Table $foods;

    public function __construct(Table $foods)
    {
        $this->foods = $foods;
    }

    public function run(int $id): array
    {
        $food = $this->foods->get($id);

        if ($this->foods->delete($food)) {
            if (!empty($food->image) && file_exists(WWW_ROOT . 'img' . DS . 'Foods' . DS . $food->image)) {
                unlink(WWW_ROOT . 'img' . DS . 'Foods' . DS . $food->image);
            }

            return ['success' => true, 'message' => 'Alimento deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o alimento.'];
    }
}
