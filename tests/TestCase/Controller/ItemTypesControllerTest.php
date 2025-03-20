<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ItemTypesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ItemTypesController Test Case
 *
 * @uses \App\Controller\ItemTypesController
 */
class ItemTypesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ItemTypes',
        'app.Items',
        'app.ItemsFields',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\ItemTypesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\ItemTypesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\ItemTypesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\ItemTypesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\ItemTypesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test export method
     *
     * @return void
     * @uses \App\Controller\ItemTypesController::export()
     */
    public function testExport(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
