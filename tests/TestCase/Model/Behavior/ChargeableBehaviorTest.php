<?php
namespace Payments\Test\TestCase\Model\Behavior;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Payments\Model\Behavior\ChargeableBehavior;

/**
 * Payments\Model\Behavior\ChargeableBehavior Test Case
 */
class ChargeableBehaviorTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Tags = TableRegistry::get('Payments.Laptops', ['table' => 'laptops']);
        $this->Tags->addBehavior('Payments.Chargeable');
        $this->ChargeableBehavior = $this->Tags->behaviors()->Chargeable;

        //parent::setUp();
        //$this->ChargeableBehavior = new ChargeableBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChargeableBehavior);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test purchase method
     *
     * @return void
     */
    public function testPurchase()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
