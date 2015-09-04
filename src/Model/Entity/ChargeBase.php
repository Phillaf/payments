<?php
namespace Payments\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\InternalErrorException;
use Payments\Model\Entity\Plan;
use Payments\Model\Entity\Subscription;

use Cake\I18n\Time;

/**
 * ChargeBase Entity.
 */
abstract class ChargeBase extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'amount' => true,
        'currency' => true,
        'status' => true,
        'paid' => true,
        'charged_with' => true,
        'receipt_email' => true,
        'receipt_number' => true,
        'user' => true,
    ];
    
    protected $_name;
    protected $_gateway;
    
    // Abstract functions
    abstract protected function create($config);
    abstract protected function purchase($data, $chargeable);
    
    public function purchase($config, $data, $chargeable)
    {
        // Setup gateway
        $this->create($config);
        $purchaseData = $this->purchase($data, $chargeable);
        
        // \todo Extra fields
        $this->charged_with = $this->_name;
        
        $this->user_id = $data['user_id'];
        $this->receipt_email = 'test@mail.com';
        $this->receipt_number = '01234';
        $this->id = null;
        
        // Proceed to subscription
        $this->subscribePlan($data['plan_id'], $data['user_id']);
        
        return $purchaseData;
    }
    
    public function purchaseProduct($data)
    {
        // Retrieve product information
        $product = ChargeBase::getProduct($data['product_id']);
        
        // Setup gateway
        $this->create($data);
        $purchaseData['charged_with'] = $this->$_name;
        
        $purchaseData = $this->purchase($data);
        

        
        return $purchaseData;
    }

    /*private function getPlan($plan_id)
    {
        // Validate info
        if (is_null($plan_id)) {
            throw new InternalErrorException('Invalid Plan Index.');
        }
        
        debug(TableRegistry::get('Plans'));
        debug(TableRegistry::get('Payments.Plans'));

        $tmp = TableRegistry::get('Payments.Plans')->getPrice($plan_id);
        debug($tmp); exit;
        
        // Retrieve plan information
        $plan = TableRegistry::get('Plans')->get($plan_id);
        $plan['amount_unit'] = $plan['amount']/100.0;   // Plan amount should be in cents
        
        debug($plan); exit;
        
        return $plan;
    }*/

    private function getProduct($product_id)
    {
        // Validate info
        if (is_null($product_id)) {
            throw new InternalErrorException('Invalid Product Index.');
        }
        
        // TODO
        $product = TableRegistry::get('Products')->get($product_id);
        $product['amount_unit'] = $product['amount']/100.0;   // Product price should be in cents
        
        return $product;
    }
    
      private function subscribePlan($plan_id, $user_id)
    {
        // Validate info
        if (is_null($plan_id)) {
            throw new InternalErrorException('Invalid Product Index.');
        }
        else if (is_null($user_id)) {
            throw new InternalErrorException('Invalid User Index.');
        }
        
        // Create a subscription
        // TODO: validate if exists already
        $subscription = TableRegistry::get('Subscriptions')->newEntity();
        
        // Fill in info
        $subInfo['plan_id'] = $plan_id;
        $subInfo['current_period_end'] = Time::now();   // todo: add plan time
        
        // Save it in the database
        $subscription = TableRegistry::get('Subscriptions')->patchEntity($subscription, $subInfo);
        if (TableRegistry::get('Subscriptions')->save($subscription)) {
            //$this->Flash->success(__('The subscription has been saved.'));
            //return $this->redirect(['action' => 'index']);
            debug('Subscription success');
        } else {
            //$this->Flash->error(__('The subscription could not be saved. Please, try again.'));
            debug('Subscription failed');
        } 
    
        debug($subscription);
        
        return $subscription;
    }
}
