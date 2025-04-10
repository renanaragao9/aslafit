<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExercisesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExercisesTable Test Case
 */
class ExercisesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExercisesTable
     */
    protected $Exercises;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Exercises',
        'app.Equipments',
        'app.MuscleGroups',
        'app.ExerciseTrainingDivision',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Exercises') ? [] : ['className' => ExercisesTable::class];
        $this->Exercises = $this->getTableLocator()->get('Exercises', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Exercises);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ExercisesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ExercisesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
