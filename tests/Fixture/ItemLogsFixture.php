<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItemLogsFixture
 */
class ItemLogsFixture extends TestFixture
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
                'item_id' => 1,
                'location_id' => 1,
                'available_for_use' => 1,
                'for_sale' => 1,
                'active' => 1,
                'sold' => 1,
                'created' => '2025-03-20 09:02:18',
                'modified' => '2025-03-20 09:02:18',
            ],
        ];
        parent::init();
    }
}
