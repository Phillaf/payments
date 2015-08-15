<?php
namespace Payments\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Payments\Model\Entity\Plan;
use Payments\Model\Entity\Customer;
use Omnipay\Omnipay;

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
        'customer_id' => true,
        'amount' => true,
        'currency' => true,
        'status' => true,
        'paid' => true,
        'receipt_email' => true,
        'receipt_number' => true,
        'customer' => true,
    ];
    
    
    public function createPlanCharge_pp($data)
    {
        // Validate info
        if (is_null($data['plan_id'])) {
            return $data;
        }
        
        // Retrieve plan information
        $plan = TableRegistry::get('Plans')->get($data['plan_id']);
        $plan['amount_unit'] = $plan['amount']/100.0;   // Plan amount should be in cents
        debug($plan);
        
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('paypal account');
   		$gateway->setPassword('paypal password');
   		$gateway->setSignature('AiPC9BjkCyDFQXbSkoZcgqH3hpacASJcFfmT46nLMylZ2R-SV95AaVCq');

        
        $formData = ['number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2016', 'cvv' => '123'];
        $params = array(
            'cancelUrl' 	=> '/payments/plans',
            'returnUrl' 	=> '/payments/plans', 
            'name'		    => $plan['name'],
            'description' 	=> 'Test',
            'amount' 	    => $plan['amount_unit'],
            'currency' 	    => $plan['currency'],
            'card'          => $formData
        );
            
        $response = $gateway->purchase($params)->send();

        if ($response->isSuccessful()) {
            // payment was successful: update database
            debug("Great success");
            debug ($response);
        } elseif ($response->isRedirect()) {
            // redirect to offsite payment gateway
            debug("Great redirect");
            //$response->redirect();
        } else {
            // payment failed: display message to customer
            debug("Great fail");
            debug ($response);
            echo $response->getMessage();
        }
    }
    
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
        if (is_null($data['plan_id'])) {
            return $data;
        }
        
        // Retrieve plan information
        $plan = TableRegistry::get('Plans')->get($data['plan_id']);
        $plan['amount_unit'] = $plan['amount']/100.0;   // Plan amount should be in cents
        debug($plan);
        
        // Create payment gateway
        $gateway = Omnipay::create('Stripe');
        $gateway->setApiKey('sk_test_2vQPWEBWBoUUiGSxsF0CjpQL');

        $formData = array(
            'number'        => $data['card-number'],
            'expiryMonth'   => $data['expiry-month'], 
            'expiryYear'    => $data['expiry-year'], 
            'cvv'           => $data['card-cvc']
        );
        
        $params = array(
            //'cancelUrl' 	    => '/payments/plans',
            //'returnUrl' 	    => '/payments/plans', 
            'name'		        => $plan['name'],
            'description' 	    => 'Test Plan',
            'amount' 	        => $plan['amount_unit'],
            'currency' 	        => $plan['currency'],
            'receipt_email'     => 'test@mail.com',
            'receipt_number'    => '0',
            'card'              => $formData,
        );
        
        debug($params);
        $response = $gateway->purchase($params)->send();

        if ($response->isSuccessful()) {
            // payment was successful: update database
            //debug($response->getData());
            debug("Great success");
        } elseif ($response->isRedirect()) {
            // redirect to offsite payment gateway
            debug("Great redirect");
            //$response->redirect();
        } else {
            // payment failed: display message to customer
            debug("Great fail");
            //echo $response->getMessage();
        }
        
        $data = $response->getData();
        
        // Not filled in response ??
        $data['receipt_email'] = 'test@mail.com';
        $data['receipt_number'] = '0';
        $data['id'] = null;
        
        // The charge was successful, create customer and subscription entry
        /*if ($data['paid'] == 0) {
            $customer = TableRegistry::get('Customer')->newEntity([
                'user_id' => 'New Article',
                'created' => new DateTime('now')
            ]);
        }*/
        
        return $data;
    }
}
