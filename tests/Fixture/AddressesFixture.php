<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AddressesFixture
 */
class AddressesFixture extends TestFixture
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
                'addressable_type' => 'Lorem ipsum dolor sit amet',
                'addressable_id' => 1,
                'zipcode' => 'Lorem ip',
                'address' => 'Lorem ipsum dolor sit amet',
                'number' => 'Lorem ipsum dolor sit amet',
                'complement' => 'Lorem ipsum dolor sit amet',
                'neighborhood' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'state' => 'Lorem ipsum dolor sit amet',
                'latitude' => 1.5,
                'longitude' => 1.5,
                'active' => 1,
                'created' => '2025-03-20 08:34:33',
                'modified' => '2025-03-20 08:34:33',
            ],
        ];
        parent::init();
    }
}
