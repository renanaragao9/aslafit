<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ExercisesFixture
 */
class ExercisesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'image' => 'Lorem ipsum dolor sit amet',
                'gif' => 'Lorem ipsum dolor sit amet',
                'link' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'equipment_id' => 1,
                'muscle_group_id' => 1,
                'created' => '2025-03-20 08:54:18',
                'modified' => '2025-03-20 08:54:18',
            ],
        ];
        parent::init();
    }
}
