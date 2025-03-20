<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContactsFixture
 */
class ContactsFixture extends TestFixture
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
                'contactable_type' => 'Lorem ipsum dolor sit amet',
                'contactable_id' => 1,
                'contact_type' => 'Lorem ipsum dolor sit amet',
                'contact_value' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'created' => '2025-03-20 08:45:57',
                'modified' => '2025-03-20 08:45:57',
            ],
        ];
        parent::init();
    }
}
