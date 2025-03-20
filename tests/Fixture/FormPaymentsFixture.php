<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FormPaymentsFixture
 */
class FormPaymentsFixture extends TestFixture
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
                'flag' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'created' => '2025-03-20 08:51:17',
                'modified' => '2025-03-20 08:51:17',
            ],
        ];
        parent::init();
    }
}
