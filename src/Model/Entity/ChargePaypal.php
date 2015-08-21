<?php
namespace Payments\Model\Entity;

use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Payments\Model\Entity\ChargeBase;
use Omnipay\Omnipay;

/**
 * Charge Entity.
 */
class ChargePaypal extends ChargeBase
{
    public function create($config)
    {
        // Create payment gateway
        $this->_name = 'PayPal_Express';
        
        $this->_gateway = Omnipay::create($this->_name);
        $this->_gateway->setUsername($config['username']);
        $this->_gateway->setPassword($config['password']);
        $this->_gateway->setSignature($config['signature']);
        $this->_gateway->setTestMode($config['testMode']);
    }

    public function purchase($data)
    {
        $params = array(
            'cancelUrl' 	=> 'http://cms/payments/charges/index',
            'returnUrl' 	=> 'http://cms/payments/charges/index', 
            'description' 	=> 'Test',
            'amount' 	    => $data['amount'],
            'currency' 	    => $data['currency'],
        );
            
        $response = $this->_gateway->purchase($params)->send();

        if ($response->isSuccessful()) {
            // payment was successful: update database
            debug("Great success");
            debug ($response);
        } elseif ($response->isRedirect()) {
            // redirect to offsite payment gateway
            debug("Great redirect");
            $response->redirect();
        } else {
            // payment failed: display message to customer
            debug("Great fail");
            echo $response->getMessage();
        }
        
        $data = $response->getData();
        
        // Not filled in response ??
        $data['receipt_email'] = 'test@mail.com';
        $data['receipt_number'] = '0';
        $data['id'] = null;
        
        return $data;
    }
}
