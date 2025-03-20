<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MonthlyPlansFixture
 */
class MonthlyPlansFixture extends TestFixture
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
                'date_payment' => '2025-03-20',
                'date_venciment' => '2025-03-20',
                'value' => 1.5,
                'observation' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'payment_id' => 1,
                'plan_type_id' => 1,
                'student_id' => 1,
                'collaborator_id' => 1,
                'created' => '2025-03-20 09:00:22',
                'modified' => '2025-03-20 09:00:22',
            ],
        ];
        parent::init();
    }
}
