<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderInvoicesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderInvoicesTable Test Case
 */
class OrderInvoicesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderInvoicesTable
     */
    protected $OrderInvoices;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.OrderInvoices',
        'app.Orders',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderInvoices') ? [] : ['className' => OrderInvoicesTable::class];
        $this->OrderInvoices = $this->getTableLocator()->get('OrderInvoices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrderInvoices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrderInvoicesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrderInvoicesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
