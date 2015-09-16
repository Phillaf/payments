<?php
namespace Payments\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Omnipay\Omnipay;
use Payments\Model\Entity\AbstractCharge;

/**
 * PaypalRestCharge Entity.
 */
class PaypalRestCharge extends AbstractCharge
{
    /**
     * Todo: doc block
     */
    public function create($config)
    {
        // Create payment gateway
        $this->_name = 'PayPal_Rest';
        
        $this->_gateway = Omnipay::create($this->_name);
        $this->_gateway->setClientId($config['clientId']);
        $this->_gateway->setSecret($config['secret']);
        $this->_gateway->setTestMode($config['testMode']);
    }

    /**
     * Todo: doc block
     */
    public function purchaseChargeable($data, $chargeable)
    { 
        $params = [
            'cancelUrl' => 'http://cms/payments/plans/cancel',
            'returnUrl' => 'http://cms/payments/plans/success',
            'description' => $chargeable->description,
            'amount' => $chargeable->amount_unit,
            'currency' => $chargeable->currency,
            'card' => $cardData,
        ];
        
        // todo: authorize ?
            
        $response = $this->_gateway->purchase($params)->send();

        return $response;
    }
}
