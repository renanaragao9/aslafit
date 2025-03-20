<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatisticsLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatisticsLogsTable Test Case
 */
class StatisticsLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StatisticsLogsTable
     */
    protected $StatisticsLogs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.StatisticsLogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('StatisticsLogs') ? [] : ['className' => StatisticsLogsTable::class];
        $this->StatisticsLogs = $this->getTableLocator()->get('StatisticsLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->StatisticsLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\StatisticsLogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
