<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StatisticsLogsFixture
 */
class StatisticsLogsFixture extends TestFixture
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
                'statistic_type' => 'Lorem ipsum dolor sit amet',
                'reference_id' => 1,
                'value' => 1,
                'date' => '2025-03-20',
                'created' => '2025-03-20 09:05:35',
                'modified' => '2025-03-20 09:05:35',
            ],
        ];
        parent::init();
    }
}
