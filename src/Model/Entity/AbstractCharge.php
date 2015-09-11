<?php
namespace Payments\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\InternalErrorException;
use Payments\Model\Entity\Plan;
use Payments\Model\Entity\Subscription;

use Cake\I18n\Time;

/**
 * AbstractCharge Entity.
 */
abstract class AbstractCharge extends Entity
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
    abstract public function create($config);
    abstract protected function purchaseInternal($data, $chargeable);
    
    public function purchase($data, $userId, $chargeable)
    {
        // Purchase with gateway gateway
        $response = $this->purchaseInternal($data, $chargeable);
        
        // Check response status
        if (!is_null($response)) {
            if ($response->isSuccessful()) {
                // Payment succeeded
                $this->status = 'succeeded';
                $this->paid = true;
                debug("Great success");
            } elseif ($response->isRedirect()) {
                // Payments need a redirect
                // todo: nothing, not supposed to happen ?
            } else {
                // Payment failed, display message
                $this->status = 'failed';
                $this->paid = false;
                debug("Great fail");
                echo $response->getMessage();
            }
        }
        
        // todo: fill in extra fields
        $this->amount = $chargeable->amount;
        $this->currency = $chargeable->currency;
        $this->charged_with = $this->_name;
        $this->user_id = $userId;
        $this->receipt_email = 'test@mail.com';
        $this->receipt_number = '01234';
        $this->id = null;
    }
}
