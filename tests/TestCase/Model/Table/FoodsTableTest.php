<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FoodsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FoodsTable Test Case
 */
class FoodsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FoodsTable
     */
    protected $Foods;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Foods',
        'app.DietPlans',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Foods') ? [] : ['className' => FoodsTable::class];
        $this->Foods = $this->getTableLocator()->get('Foods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Foods);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FoodsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
