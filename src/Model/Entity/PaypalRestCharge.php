<?php
namespace Payments\Model\Entity;

use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Payments\Model\Entity\AbstractCharge;
use Omnipay\Omnipay;

/**
 * Charge Entity.
 */
class PaypalRestCharge extends AbstractCharge
{
    public function create($config)
    {
        // Create payment gateway
        $this->_name = 'PayPal_Rest';
        
        $this->_gateway = Omnipay::create($this->_name);
        $this->_gateway->setClientId($config['clientId']);
        $this->_gateway->setSecret($config['secret']);
        $this->_gateway->setTestMode($config['testMode']);
    }

    public function purchaseInternal($data, $chargeable)
    {
        $cardData = array( 
            'number' => $data['card-number'], 
            'expiryMonth' => $data['expiry-month'], 
            'expiryYear' => $data['expiry-year'],
            'cvv' => $data['card-cvc'],
            
            // todo: required fields
            'billingAddress1'       => '1 Scrubby Creek Road',
            'billingCountry'        => 'AU',
            'billingCity'           => 'Scrubby Creek',
            'billingPostcode'       => '4999',
            'billingState'          => 'QLD',
        );
        
        $params = array(
            'cancelUrl' => 'http://cms/payments/plans/cancel',
            'returnUrl' => 'http://cms/payments/plans/success', 
            'description' => $chargeable->description,
            'amount' => $chargeable->amount_unit,
            'currency' => $chargeable->currency,
            'card' => $cardData,
        );
            
        $response = $this->_gateway->purchase($params)->send();

        return $response;
    }
}
