<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExerciseTrainingDivisionTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExerciseTrainingDivisionTable Test Case
 */
class ExerciseTrainingDivisionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExerciseTrainingDivisionTable
     */
    protected $ExerciseTrainingDivision;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ExerciseTrainingDivision',
        'app.Fichas',
        'app.Exercises',
        'app.TrainingDivisions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ExerciseTrainingDivision') ? [] : ['className' => ExerciseTrainingDivisionTable::class];
        $this->ExerciseTrainingDivision = $this->getTableLocator()->get('ExerciseTrainingDivision', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ExerciseTrainingDivision);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ExerciseTrainingDivisionTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ExerciseTrainingDivisionTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
