<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanTypesTable Test Case
 */
class PlanTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlanTypesTable
     */
    protected $PlanTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PlanTypes',
        'app.MonthlyPlans',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PlanTypes') ? [] : ['className' => PlanTypesTable::class];
        $this->PlanTypes = $this->getTableLocator()->get('PlanTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PlanTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PlanTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
