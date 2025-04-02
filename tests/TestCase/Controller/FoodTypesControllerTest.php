<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\FoodTypesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\FoodTypesController Test Case
 *
 * @uses \App\Controller\FoodTypesController
 */
class FoodTypesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.FoodTypes',
        'app.Foods',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\FoodTypesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\FoodTypesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\FoodTypesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\FoodTypesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\FoodTypesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test export method
     *
     * @return void
     * @uses \App\Controller\FoodTypesController::export()
     */
    public function testExport(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
