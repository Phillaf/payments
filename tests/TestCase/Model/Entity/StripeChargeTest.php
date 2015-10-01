<?php
namespace Payments\Test\TestCase\Model\Entity;

use Cake\TestSuite\TestCase;
use Payments\Model\Entity\StripeCharge;

/**
 * Payments\Model\Entity\StripeCharge Test Case
 */
class StripeChargeTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->StripeCharge = new StripeCharge();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StripeCharge);

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
