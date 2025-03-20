<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DietPlansTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DietPlansTable Test Case
 */
class DietPlansTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DietPlansTable
     */
    protected $DietPlans;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.DietPlans',
        'app.Students',
        'app.MealTypes',
        'app.Foods',
        'app.Fichas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DietPlans') ? [] : ['className' => DietPlansTable::class];
        $this->DietPlans = $this->getTableLocator()->get('DietPlans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->DietPlans);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DietPlansTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DietPlansTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
