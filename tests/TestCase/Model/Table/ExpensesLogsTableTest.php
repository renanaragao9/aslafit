<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpensesLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpensesLogsTable Test Case
 */
class ExpensesLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpensesLogsTable
     */
    protected $ExpensesLogs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ExpensesLogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ExpensesLogs') ? [] : ['className' => ExpensesLogsTable::class];
        $this->ExpensesLogs = $this->getTableLocator()->get('ExpensesLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ExpensesLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ExpensesLogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
