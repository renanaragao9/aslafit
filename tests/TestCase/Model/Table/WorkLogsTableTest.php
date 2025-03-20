<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkLogsTable Test Case
 */
class WorkLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkLogsTable
     */
    protected $WorkLogs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.WorkLogs',
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
        $config = $this->getTableLocator()->exists('WorkLogs') ? [] : ['className' => WorkLogsTable::class];
        $this->WorkLogs = $this->getTableLocator()->get('WorkLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->WorkLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\WorkLogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\WorkLogsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
