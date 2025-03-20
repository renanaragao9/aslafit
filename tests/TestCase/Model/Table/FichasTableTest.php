<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FichasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FichasTable Test Case
 */
class FichasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FichasTable
     */
    protected $Fichas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Fichas',
        'app.Students',
        'app.Assessments',
        'app.DietPlans',
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
        $config = $this->getTableLocator()->exists('Fichas') ? [] : ['className' => FichasTable::class];
        $this->Fichas = $this->getTableLocator()->get('Fichas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Fichas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FichasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FichasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
