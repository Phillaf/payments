<?php
namespace Payments\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Omnipay\Omnipay;
use Payments\Model\Entity\AbstractCharge;

/**
 * StripeCharge Entity.
 */
class StripeCharge extends AbstractCharge
{
    /**
     * Todo: doc comment
     */
    public function create($config)
    {
        // Create payment gateway
        $this->_name = 'Stripe';
        
        $this->_gateway = Omnipay::create('Stripe');
        $this->_gateway->setApiKey($config['apiKey']);
    }

    /**
     * Todo: doc comment
     */
    public function purchaseChargeable($card, $chargeable)
    {        
        $params = [
            'name' => $chargeable->name,
            'description' => $chargeable->description,
            'amount' => $chargeable->amount_unit,
            'currency' => $chargeable->currency,
            'receipt_email' => 'test@mail.com',
            'receipt_number' => '0',
            'card' => $card,
        ];

        $response = $this->_gateway->purchase($params)->send();

        return $response;
    }
}
