<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CollaboratorsFixture
 */
class CollaboratorsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'birth_date' => '2025-03-20',
                'entry_date' => '2025-03-20',
                'gender' => 'Lorem ip',
                'color' => 'Lorem ipsum dolor sit amet',
                'img' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'position_id' => 1,
                'user_id' => 1,
                'created' => '2025-03-20 08:54:45',
                'modified' => '2025-03-20 08:54:45',
            ],
        ];
        parent::init();
    }
}
