<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AssessmentsFixture
 */
class AssessmentsFixture extends TestFixture
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
                'goal' => 'Lorem ipsum dolor sit amet',
                'observation' => 'Lorem ipsum dolor sit amet',
                'term' => 'Lorem ipsum dolor sit amet',
                'height' => 1.5,
                'weight' => 1.5,
                'arm' => 1.5,
                'forearm' => 1.5,
                'breastplate' => 1.5,
                'back' => 1.5,
                'waist' => 1.5,
                'glute' => 1.5,
                'hip' => 1.5,
                'thigh' => 1.5,
                'calf' => 1.5,
                'student_id' => 1,
                'ficha_id' => 1,
                'active' => 1,
                'created' => '2025-03-20 08:56:51',
                'modified' => '2025-03-20 08:56:51',
            ],
        ];
        parent::init();
    }
}
