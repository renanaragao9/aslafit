<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TrainingDivisionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TrainingDivisionsTable Test Case
 */
class TrainingDivisionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TrainingDivisionsTable
     */
    protected $TrainingDivisions;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.TrainingDivisions',
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
        $config = $this->getTableLocator()->exists('TrainingDivisions') ? [] : ['className' => TrainingDivisionsTable::class];
        $this->TrainingDivisions = $this->getTableLocator()->get('TrainingDivisions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TrainingDivisions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TrainingDivisionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
