<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderItemsFixture
 */
class OrderItemsFixture extends TestFixture
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
                'order_id' => 1,
                'item_id' => 1,
                'quantity' => 1,
                'unit_price' => 1.5,
                'total_price' => 1.5,
                'created' => '2025-03-20 09:03:21',
                'modified' => '2025-03-20 09:03:21',
            ],
        ];
        parent::init();
    }
}
