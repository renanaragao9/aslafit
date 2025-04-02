<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class MealTypesSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'name' => 'Café da Manhã',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Lanche da Manhã',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Almoço',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Lanche da Tarde',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Jantar',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Ceia',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Pré-Treino',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Pós-Treino',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Colação',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
        ];

        $table = $this->table('meal_types');
        $table->insert($data)->save();
    }
}
