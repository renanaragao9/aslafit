<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class MuscleGroupsSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            ['name' => 'Perna', 'active' => true, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['name' => 'Peito', 'active' => true, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['name' => 'Costas', 'active' => true, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['name' => 'Trapézio', 'active' => true, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['name' => 'Bíceps', 'active' => true, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['name' => 'Tríceps', 'active' => true, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['name' => 'Ombro', 'active' => true, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],

        ];

        $table = $this->table('muscle_groups');
        $table->insert($data)->save();
    }
}
