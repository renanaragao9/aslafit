<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EquipmentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EquipmentsTable Test Case
 */
class EquipmentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EquipmentsTable
     */
    protected $Equipments;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Equipments',
        'app.Exercises',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Equipments') ? [] : ['className' => EquipmentsTable::class];
        $this->Equipments = $this->getTableLocator()->get('Equipments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Equipments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EquipmentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
