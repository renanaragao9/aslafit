<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlanTypesFixture
 */
class PlanTypesFixture extends TestFixture
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
                'value' => 1.5,
                'months' => 1,
                'active' => 1,
                'created' => '2025-03-20 08:53:36',
                'modified' => '2025-03-20 08:53:36',
            ],
        ];
        parent::init();
    }
}
