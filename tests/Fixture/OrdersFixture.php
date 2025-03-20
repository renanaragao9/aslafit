<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
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
                'order_number' => 'Lorem ipsum dolor sit amet',
                'order_date' => '2025-03-20 09:02:57',
                'total_amount' => 1.5,
                'status' => 'Lorem ipsum dolor sit amet',
                'token' => 'Lorem ipsum dolor sit amet',
                'payment_id' => 1,
                'delivery' => 1,
                'created' => '2025-03-20 09:02:57',
                'modified' => '2025-03-20 09:02:57',
            ],
        ];
        parent::init();
    }
}
