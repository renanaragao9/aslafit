<?php

declare(strict_types=1);

namespace App\Service\Fichas;

use Cake\ORM\Table;

class AddService
{
    private Table $fichas;

    public function __construct(Table $fichas)
    {
        $this->fichas = $fichas;
    }

    public function run(array $data): array
    {
        if ($data['active'] == true) {
            $existingActiveFicha = $this->fichas->find()
                ->where(['student_id' => $data['student_id'], 'active' => true])
                ->first();

            if ($existingActiveFicha) {
                return [
                    'success' => false,
                    'message' => 'Já existe uma ficha ativa para este estudante.'
                ];
            }
        }

        $ficha = $this->fichas->newEntity($data);

        if ($this->fichas->save($ficha)) {
            return [
                'success' => true,
                'message' => 'Ficha salva com sucesso.',
                'id' => $ficha->id
            ];
        }

        return ['success' => false, 'message' => 'Erro ao salvar a ficha.'];
    }

    public function getNewEntity()
    {
        return $this->fichas->newEmptyEntity();
    }
}
