<?php

namespace Payments\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\InternalErrorException;
use Cake\Core\Configure;
use Cake\Utility\Hash;

/**
 * Chargeable Behavior
 *
 */
class ChargeableBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'amount' => null,
        'currency' => null,
        'name' => null,
        'description' => null,
        'defaultCurrency' => 'CAD',
        'defaultName' => 'Item',
        'defaultDescription' => 'Item Description'
    ];
    
    public function initialize(array $config)
    {
        if (is_null($config['amount'])) {
            throw new InternalErrorException('The \'amount\' field is required.');
        }
    }
    
    public function purchase($cardData, $userId, $chargeableId, $quantity)
    {
        // todo: deal with gateway config somewhere else
        // Get payments configuration
        $gatewayConfig = Configure::read('Payments');
        $gatewayName = $gatewayConfig['gateway'];
        
        $chargeTable = TableRegistry::get('Payments.Charges');
        $charge = $chargeTable->newEntity(null, $gatewayConfig);
        
        // Get the chargeable entity
        $chargeable = $this->_table
            ->find()
            ->where([$this->_table->primaryKey() . ' IN' => $chargeableId])
            ->first();
            
        $chargeable = $this->setFields($chargeable);

        // Create a charge and process it
        $charge->create($gatewayConfig[$gatewayName]);
        $charge->purchase($cardData, $userId, $chargeable);
        
        // Save it in the data base
        if (!$chargeTable->save($charge)) {
            // todo: message
            return $charge;
        }
        return $charge;
    }
    
    protected function setFields($chargeable)
    {   
        // Set necessary fields
        $chargeable->amount = $chargeable->{$this->_config['amount']};
        $chargeable->amount_unit = $chargeable->amount/100.0;   // Plan amount should be in cents
        
        // Default currency field
        if (is_null($this->_config['currency']) || !isset($chargeable->{$this->_config['currency']})) {
            $chargeable->currency = $this->_defaultConfig['defaultCurrency'];
        }
        else {
            $chargeable->currency = $chargeable->{$this->_config['currency']};
        }
        
        // Default name field
        if (is_null($this->_config['name']) || !isset($chargeable->{$this->_config['name']})) {
            $chargeable->name = $this->_defaultConfig['defaultName'];
        }
        else {
            $chargeable->name = $chargeable->{$this->_config['name']};
        }
        
        // Default description field
        if (is_null($this->_config['description']) || !isset($chargeable->{$this->_config['description']})) {
            $chargeable->description = $this->_defaultConfig['defaultDescription'];
        }
        else {
            $chargeable->description = $chargeable->{$this->_config['description']};
        }
        
        return $chargeable;
    }
}
