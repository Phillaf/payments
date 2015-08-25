<?php
namespace Payments\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Payments\Model\Entity\Plan;

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
        'customer_id' => true,
        'amount' => true,
        'currency' => true,
        'status' => true,
        'paid' => true,
        'receipt_email' => true,
        'receipt_number' => true,
        'customer' => true,
    ];
    
    protected $_name;
    protected $_gateway;
    
    // Abstract functions
    abstract protected function create($config);
    abstract protected function purchase($data);
    
    public function purchasePlan($config, $data)
    {
        // Retrieve plan information
        $plan = $this->getPlan($data['plan_id']);
        
        $this->create($config);
        
        // Fill in plan purchase data
        $data['name'] = $plan['name']; 
        $data['amount'] = $plan['amount_unit']; 
        $data['currency'] = $plan['currency']; 
        
        $purchaseData = $this->purchase($data);
        
        // Keep track of used gateway
        $purchaseData['gateway'] = $this->$_name;
        
        return $purchaseData;
    }
    
    public function purchaseProduct($data)
    {
        // Retrieve product information
        $product = ChargeBase::getProduct($data['product_id']);
        
        // Setup gateway
        $this->create($data);
        
        $purchaseData = $this->purchase($data);
        
        // Keep track of used gateway
        $purchaseData['gateway'] = $this->$_name;
        
        return $purchaseData;
    }

    private function getPlan($plan_id)
    {
        // Validate info
        if (is_null($plan_id)) {
            throw new InternalErrorException('Invalid Plan ID.');
        }
        
        // Retrieve plan information
        $plan = TableRegistry::get('Plans')->get($plan_id);
        $plan['amount_unit'] = $plan['amount']/100.0;   // Plan amount should be in cents
        
        return $plan;
    }

    private function getProduct($product_id)
    {
        // Validate info
        if (is_null($product_id)) {
            throw new InternalErrorException('Invalid Product ID.');
        }
        
        // TODO
        $product = TableRegistry::get('Product')->get($product_id);
        $product['amount_unit'] = $product['amount']/100.0;   // Product price should be in cents
        
        return $product;
    }
}
