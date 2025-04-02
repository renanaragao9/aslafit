<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class PlanTypesSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'name' => 'Plano Básico - 1 mês',
                'value' => 99.90,
                'months' => 1,
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Plano Intermediário - 3 meses',
                'value' => 269.90,
                'months' => 3,
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Plano Avançado - 6 meses',
                'value' => 499.90,
                'months' => 6,
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Plano Anual - 12 meses',
                'value' => 899.90,
                'months' => 12,
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
        ];

        $table = $this->table('plan_types');
        $table->insert($data)->save();
    }
}
