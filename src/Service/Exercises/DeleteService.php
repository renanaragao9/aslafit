<?php

declare(strict_types=1);

namespace App\Service\Exercises;

use Cake\ORM\Table;

class DeleteService
{
    private Table $exercises;

    public function __construct(Table $exercises)
    {
        $this->exercises = $exercises;
    }

    public function run(int $id): array
    {
        $exercise = $this->exercises->get($id);

        if ($this->exercises->delete($exercise)) {
            if (!empty($exercise->image) && file_exists(WWW_ROOT . 'img' . DS . 'exercises' . DS . 'img' . DS . $exercise->image)) {
                unlink(WWW_ROOT . 'img' . DS . 'exercises' . DS . 'img' . DS . $exercise->image);
            }

            if (!empty($exercise->gif) && file_exists(WWW_ROOT . 'img' . DS . 'exercises' . DS . 'gif' . DS . $exercise->gif)) {
                unlink(WWW_ROOT . 'img' . DS . 'exercises' . DS . 'gif' . DS . $exercise->gif);
            }

            return ['success' => true, 'message' => 'Exercício deletado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao deletar o exercício.'];
    }
}
