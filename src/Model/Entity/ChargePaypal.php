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

    public function purchaseInternal($data, $chargeable)
    {
        $params = array(
            'cancelUrl' => 'http://cms/payments/charges/index',
            'returnUrl' => 'http://cms/payments/plans/charge', 
            'description' => $chargeable['description'],
            'amount' => $chargeable['amount_unit'],
            'currency' => $chargeable['currency'],
        );
            
        $response = $this->_gateway->purchase($params)->send();

        if ($response->isSuccessful()) {
            // payment was successful: update database
            debug("Great success");
        } elseif ($response->isRedirect()) {
            // redirect to offsite payment gateway
            debug("Great redirect");
            $response->redirect();
        } else {
            // payment failed: display message to customer
            debug("Great fail");
            echo $response->getMessage();
        }
        
        $purchaseData = $response->getData();
        
        // Set reponse fields 
        // todo: better way?
        $this->amount = $purchaseData['amount'];
        $this->currency = $purchaseData['currency'];
        $this->status = $purchaseData['status'];
        $this->paid = $purchaseData['paid'];
        
        return $data;
    }
}
