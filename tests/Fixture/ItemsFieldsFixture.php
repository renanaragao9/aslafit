<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItemsFieldsFixture
 */
class ItemsFieldsFixture extends TestFixture
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
                'item_type_id' => 1,
                'field_name' => 'Lorem ipsum dolor sit amet',
                'field_type' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-03-20 09:00:51',
                'modified' => '2025-03-20 09:00:51',
            ],
        ];
        parent::init();
    }
}
