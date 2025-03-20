<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemTypesTable Test Case
 */
class ItemTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemTypesTable
     */
    protected $ItemTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ItemTypes',
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
        $config = $this->getTableLocator()->exists('ItemTypes') ? [] : ['className' => ItemTypesTable::class];
        $this->ItemTypes = $this->getTableLocator()->get('ItemTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ItemTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ItemTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
