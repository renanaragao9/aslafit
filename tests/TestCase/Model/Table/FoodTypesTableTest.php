<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FoodTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FoodTypesTable Test Case
 */
class FoodTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FoodTypesTable
     */
    protected $FoodTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.FoodTypes',
        'app.Foods',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('FoodTypes') ? [] : ['className' => FoodTypesTable::class];
        $this->FoodTypes = $this->getTableLocator()->get('FoodTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->FoodTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FoodTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
