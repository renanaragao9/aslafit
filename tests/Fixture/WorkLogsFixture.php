<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WorkLogsFixture
 */
class WorkLogsFixture extends TestFixture
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
                'collaborator_id' => 1,
                'log_date' => '2025-03-20',
                'log_type' => 'Lorem ip',
                'log_time' => '08:55:42',
                'log_address' => 'Lorem ipsum dolor sit amet',
                'latitude' => 1.5,
                'longitude' => 1.5,
                'created' => '2025-03-20 08:55:42',
                'modified' => '2025-03-20 08:55:42',
            ],
        ];
        parent::init();
    }
}
