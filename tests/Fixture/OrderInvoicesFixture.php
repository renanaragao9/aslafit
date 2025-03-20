<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderInvoicesFixture
 */
class OrderInvoicesFixture extends TestFixture
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
                'status' => 'Lorem ipsum dolor sit amet',
                'paid' => 1,
                'created' => '2025-03-20 09:03:49',
                'modified' => '2025-03-20 09:03:49',
            ],
        ];
        parent::init();
    }
}
