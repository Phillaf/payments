<?php
namespace GintonicCMS\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use GintonicCMS\Model\Entity\Plan;
use GintonicCMS\Model\Entity\Customer;

/**
 * Charge Entity.
 */
class Charge extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'stripe_charge_id' => true,
        'customer_id' => true,
        'amount' => true,
        'currency' => true,
        'status' => true,
        'paid' => true,
        'receipt_email' => true,
        'receipt_number' => true,
        'refunded' => true,
        'failure_message' => true,
        'stripe_charge' => true,
        'customer' => true,
    ];
    
    /**
     * Create a stripe charge
     * For Example:
     * $charge = $this->Charge->createPlanCharge($data);
     * $charge->createPlanCharge();
     *
     * @return The full charge data array
     */
    public function createPlanCharge($data)
    {
        // Validate info
        if ($data['plan_id'] == null) {
            return $data;
        }
        
        // Retrieve plan information
        $plan = TableRegistry::get('Plans')->get($data['plan_id']);
        
        \Stripe\Stripe::setApiKey("sk_test_2vQPWEBWBoUUiGSxsF0CjpQL");  // Test API key for now
        
        // Get the credit card details submitted by the user
        $token = $data['stripeToken'];
        
        // Create the charge on Stripe's servers - this will charge the user's card
        try {
            $stripe_charge = \Stripe\Charge::create(array(
              "amount" => $plan['amount'], // amount in cents, again
              "currency" => $plan['currency'],
              "source" => $token,
              "description" => "Charge: " + $plan['name'])
            );
            debug("Worked");
            $data['paid'] = 1;
            $data['amount'] = $plan['amount'];
            $data['currency'] = $plan['currency'];
            $data['receipt_email'] = 'y.cadoret@gintonicweb.com';
            $data['receipt_number'] = '1233456';
        } 
        catch(\Stripe\Error\Card $e) 
        {
            // The card has been declined
            debug("Declined!");
            $data['paid'] = 0;
        }
        
        // The charge was successful, create customer and subscription entry
        if ($data['paid'] == 0) {
            $customer = TableRegistry::get('Customer')->newEntity([
                'user_id' => 'New Article',
                'created' => new DateTime('now')
            ]);
        }
        
        return $data;
    }
}
