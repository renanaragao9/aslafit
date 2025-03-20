<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventRegistrationsFixture
 */
class EventRegistrationsFixture extends TestFixture
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
                'event_id' => 1,
                'student_id' => 1,
                'confirmed' => 1,
                'created' => '2025-03-20 09:05:04',
                'modified' => '2025-03-20 09:05:04',
            ],
        ];
        parent::init();
    }
}
