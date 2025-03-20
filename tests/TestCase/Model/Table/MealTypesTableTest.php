<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MealTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MealTypesTable Test Case
 */
class MealTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MealTypesTable
     */
    protected $MealTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.MealTypes',
        'app.DietPlans',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MealTypes') ? [] : ['className' => MealTypesTable::class];
        $this->MealTypes = $this->getTableLocator()->get('MealTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MealTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MealTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
