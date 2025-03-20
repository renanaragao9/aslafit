<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MonthlyPlansTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MonthlyPlansTable Test Case
 */
class MonthlyPlansTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MonthlyPlansTable
     */
    protected $MonthlyPlans;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.MonthlyPlans',
        'app.FormPayments',
        'app.PlanTypes',
        'app.Students',
        'app.Collaborators',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MonthlyPlans') ? [] : ['className' => MonthlyPlansTable::class];
        $this->MonthlyPlans = $this->getTableLocator()->get('MonthlyPlans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MonthlyPlans);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MonthlyPlansTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MonthlyPlansTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
