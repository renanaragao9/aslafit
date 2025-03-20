<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StorageLocationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StorageLocationsTable Test Case
 */
class StorageLocationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StorageLocationsTable
     */
    protected $StorageLocations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.StorageLocations',
        'app.Items',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('StorageLocations') ? [] : ['className' => StorageLocationsTable::class];
        $this->StorageLocations = $this->getTableLocator()->get('StorageLocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->StorageLocations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\StorageLocationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
