<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ExpensesLogsFixture
 */
class ExpensesLogsFixture extends TestFixture
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
                'expense_type' => 'Lorem ipsum dolor sit amet',
                'reference_id' => 1,
                'amount' => 1.5,
                'transaction_type' => 'Lorem ip',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'date' => '2025-03-20',
                'created' => '2025-03-20 09:06:01',
                'modified' => '2025-03-20 09:06:01',
            ],
        ];
        parent::init();
    }
}
