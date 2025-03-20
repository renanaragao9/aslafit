<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItemsFixture
 */
class ItemsFixture extends TestFixture
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
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'quantity' => 1,
                'unit_price' => 1.5,
                'available_for_use' => 1,
                'for_sale' => 1,
                'local_storage' => 1,
                'item_type_id' => 1,
                'supplier_id' => 1,
                'storage_location_id' => 1,
                'created' => '2025-03-20 09:01:15',
                'modified' => '2025-03-20 09:01:15',
            ],
        ];
        parent::init();
    }
}
