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
        // Create payment gateway
        $this->_name = 'Stripe';
        
        $this->_gateway = Omnipay::create('Stripe');
        $this->_gateway->setApiKey($config['apiKey']);
    }

    public function purchaseInternal($data, $chargeable)
    {
        $formData = array( 
            'number' => $data['card-number'], 
            'expiryMonth' => $data['expiry-month'], 
            'expiryYear' => $data['expiry-year'],
            'cvv' => $data['card-cvc'],
        );
        
        $params = array(
            'name' => $chargeable['name'],
            'description' => $chargeable['description'],
            'amount' => $chargeable['amount_unit'],
            'currency' => $chargeable['currency'],
            'receipt_email' => 'test@mail.com',
            'receipt_number' => '0',
            'card' => $formData,
        );

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
        
        // Set reponse fields 
        // todo: better way?
        $purchaseData = $response->getData();
        $this->amount = $purchaseData['amount'];
        $this->currency = $purchaseData['currency'];
        $this->status = $purchaseData['status'];
        $this->paid = $purchaseData['paid'];
    }
}
