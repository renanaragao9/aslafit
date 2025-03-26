<?php

declare(strict_types=1);

namespace App\Service\Fichas;

use Cake\ORM\Table;

class EditService
{
    private Table $fichas;

    public function __construct(Table $fichas)
    {
        $this->fichas = $fichas;
    }

    public function run(int $id, array $data): array
    {
        $fichaData = $this->getEditData($id);
        $ficha = $fichaData['ficha'];

        if (!empty($data['active']) && $data['active'] === true) {
            $existingActiveFicha = $this->fichas->find()
                ->contain(['Students'])
                ->where(['Fichas.student_id' => $data['student_id'], 'Fichas.active' => true])
                ->where(['Fichas.id !=' => $id])
                ->first();

            if ($existingActiveFicha) {
                return [
                    'success' => false,
                    'message' => 'Já existe uma ficha ativa para o aluno: ' . $existingActiveFicha->student->name
                ];
            }
        }

        if (!empty($data['student_id']) && $data['student_id'] !== $ficha->student_id) {
            $existingFichaForNewStudent = $this->fichas->find()
                ->contain(['Students'])
                ->where(['student_id' => $data['student_id'], 'Fichas.active' => true])
                ->where(['Fichas.id !=' => $id])
                ->first();

            if ($existingFichaForNewStudent) {
                return [
                    'success' => false,
                    'message' => 'Já existe uma ficha ativa para o aluno: ' . $existingFichaForNewStudent->student->name
                ];
            }
        }

        $this->fichas->patchEntity($ficha, $data);

        if ($this->fichas->save($ficha)) {
            return ['success' => true, 'message' => 'Ficha editada com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar a ficha.'];
    }

    public function getEditData(int $id)
    {
        return ['ficha' => $this->fichas->get($id)];
    }
}
