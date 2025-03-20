<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ExerciseTrainingDivisionController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ExerciseTrainingDivisionController Test Case
 *
 * @uses \App\Controller\ExerciseTrainingDivisionController
 */
class ExerciseTrainingDivisionControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     * @uses \App\Controller\ExerciseTrainingDivisionController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\ExerciseTrainingDivisionController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\ExerciseTrainingDivisionController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\ExerciseTrainingDivisionController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\ExerciseTrainingDivisionController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test export method
     *
     * @return void
     * @uses \App\Controller\ExerciseTrainingDivisionController::export()
     */
    public function testExport(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
