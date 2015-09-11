<?php
namespace Payments\Model\Entity;

use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Payments\Model\Entity\AbstractCharge;
use Omnipay\Omnipay;

/**
 * Charge Entity.
 */
class StripeCharge extends AbstractCharge
{
    public function create($config)
    {
        // Create payment gateway
        $this->_name = 'Stripe';
        
        $this->_gateway = Omnipay::create('Stripe');
        $this->_gateway->setApiKey($config['apiKey']);
    }

    public function purchaseInternal($data, $chargeable)
    {
        $cardData = array( 
            'number' => $data['card-number'], 
            'expiryMonth' => $data['expiry-month'], 
            'expiryYear' => $data['expiry-year'],
            'cvv' => $data['card-cvc'],
        );
        
        $params = array(
            'name' => $chargeable->name,
            'description' => $chargeable->description,
            'amount' => $chargeable->amount_unit,
            'currency' => $chargeable->currency,
            'receipt_email' => 'test@mail.com',
            'receipt_number' => '0',
            'card' => $cardData,
        );

        $response = $this->_gateway->purchase($params)->send();

        return $response;
    }
}
