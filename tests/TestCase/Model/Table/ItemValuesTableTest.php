<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemValuesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemValuesTable Test Case
 */
class ItemValuesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemValuesTable
     */
    protected $ItemValues;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ItemValues',
        'app.Items',
        'app.ItemsFields',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ItemValues') ? [] : ['className' => ItemValuesTable::class];
        $this->ItemValues = $this->getTableLocator()->get('ItemValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ItemValues);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ItemValuesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ItemValuesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
