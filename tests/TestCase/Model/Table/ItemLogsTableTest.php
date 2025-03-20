<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemLogsTable Test Case
 */
class ItemLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemLogsTable
     */
    protected $ItemLogs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ItemLogs',
        'app.Items',
        'app.StorageLocations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ItemLogs') ? [] : ['className' => ItemLogsTable::class];
        $this->ItemLogs = $this->getTableLocator()->get('ItemLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ItemLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ItemLogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ItemLogsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
