<?php
namespace Payments\Test\TestCase\Model\Entity;

use Cake\TestSuite\TestCase;
use Payments\Model\Entity\PaypalExpressCharge;

/**
 * Payments\Model\Entity\PaypalExpressCharge Test Case
 */
class PaypalExpressChargeTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->PaypalExpressCharge = new PaypalExpressCharge();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaypalExpressCharge);

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
