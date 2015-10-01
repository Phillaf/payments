<?php
namespace Payments\Test\TestCase\Model\Entity;

use Cake\TestSuite\TestCase;
use Payments\Model\Entity\PaypalRestCharge;

/**
 * Payments\Model\Entity\PaypalRestCharge Test Case
 */
class PaypalRestChargeTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->PaypalRestCharge = new PaypalRestCharge();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaypalRestCharge);

        parent::tearDown();
    }

    /**
     * Test create method
     *
     * @return void
     */
    public function testCreate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test purchaseChargeable method
     *
     * @return void
     */
    public function testPurchaseChargeable()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
