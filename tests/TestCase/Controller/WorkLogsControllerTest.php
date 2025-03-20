<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\WorkLogsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\WorkLogsController Test Case
 *
 * @uses \App\Controller\WorkLogsController
 */
class WorkLogsControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     * @uses \App\Controller\WorkLogsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\WorkLogsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\WorkLogsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\WorkLogsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\WorkLogsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test export method
     *
     * @return void
     * @uses \App\Controller\WorkLogsController::export()
     */
    public function testExport(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
