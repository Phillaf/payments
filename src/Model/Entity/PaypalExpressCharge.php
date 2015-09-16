<?php
namespace Payments\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Omnipay\Omnipay;
use Payments\Model\Entity\AbstractCharge;

/**
 * PaypalExpressCharge Entity.
 */
class PaypalExpressCharge extends AbstractCharge
{

    /**
     * TODO: doc block
     */
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

    /**
     * TODO: doc block
     */
    public function purchaseChargeable($card, $chargeable)
    {
        $params = [
            'cancelUrl' => 'http://cms/payments/plans/cancel',
            'returnUrl' => 'http://cms/payments/plans/success',
            'description' => $chargeable->description,
            'amount' => $chargeable->amount_unit,
            'currency' => $chargeable->currency,
        ];

        $response = $this->_gateway->purchase($params)->send();
        
        // todo: redirect

        /*if ($response->isSuccessful()) {
            // payment was successful: update database
            debug("Great success");
        } elseif ($response->isRedirect()) {
            // redirect to offsite payment gateway
            debug("Great redirect");
            //$response->redirect();
        } else {
            // payment failed: display message to customer
            debug("Great fail");
            echo $response->getMessage();
        }*/
       
        
        return $response;
    }
}
