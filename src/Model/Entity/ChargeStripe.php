<?php
namespace Payments\Model\Entity;

use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Payments\Model\Entity\ChargeBase;
use Omnipay\Omnipay;

/**
 * Charge Entity.
 */
class ChargeStripe extends ChargeBase
{
    public function create($config)
    {
        debug($config);
        // Create payment gateway
        $this->_gateway = Omnipay::create('Stripe');
        $this->_gateway->setApiKey($config['apiKey']);
    }

    public function purchase($data)
    {
        $formData = array( 
            'number' => $data['card-number'], 
            'expiryMonth' => $data['expiry-month'], 
            'expiryYear' => $data['expiry-year'],
            'cvv' => $data['card-cvc'],
        );
        
        $params = array(
            'name'		        => $data['name'],
            'description' 	    => 'Test Plan',
            'amount' 	        => $data['amount'],
            'currency' 	        => $data['currency'],
            'receipt_email'     => 'test@mail.com',
            'receipt_number'    => '0',
            'card'              => $formData,
        );
        
        debug($params);
        $response = $this->_gateway->purchase($params)->send();

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
        
        $purchaseData = $response->getData();
        
        // Not filled in response ??
        $purchaseData['receipt_email'] = 'test@mail.com';
        $purchaseData['receipt_number'] = '0';
        $purchaseData['id'] = null;
        
        return $purchaseData;
    }
}
