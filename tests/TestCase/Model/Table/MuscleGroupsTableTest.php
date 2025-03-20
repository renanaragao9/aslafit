<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MuscleGroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MuscleGroupsTable Test Case
 */
class MuscleGroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MuscleGroupsTable
     */
    protected $MuscleGroups;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.MuscleGroups',
        'app.Exercises',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MuscleGroups') ? [] : ['className' => MuscleGroupsTable::class];
        $this->MuscleGroups = $this->getTableLocator()->get('MuscleGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MuscleGroups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MuscleGroupsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
