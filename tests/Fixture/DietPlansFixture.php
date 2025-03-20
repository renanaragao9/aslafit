<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DietPlansFixture
 */
class DietPlansFixture extends TestFixture
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
                'description' => 'Lorem ipsum dolor sit amet',
                'student_id' => 1,
                'meal_type_id' => 1,
                'food_id' => 1,
                'ficha_id' => 1,
                'active' => 1,
                'created' => '2025-03-20 08:57:17',
                'modified' => '2025-03-20 08:57:17',
            ],
        ];
        parent::init();
    }
}
