<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DocumentsFixture
 */
class DocumentsFixture extends TestFixture
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
                'documentable_type' => 'Lorem ipsum dolor sit amet',
                'documentable_id' => 1,
                'document_type' => 'Lorem ipsum dolor sit amet',
                'document_number' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
                'created' => '2025-03-20 08:44:58',
                'modified' => '2025-03-20 08:44:58',
            ],
        ];
        parent::init();
    }
}
