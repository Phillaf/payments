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
use Cake\Datasource\EntityInterface;

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
    
    /** 
     * Initialize the chargeable behavior
     *
     * @param array $config
     * @return void
     */
    public function initialize(array $config)
    {
        if (is_null($config['amount'])) {
            throw new InternalErrorException('The \'amount\' field is required.');
        }
    }
    
    /**
     * Purchase a chargeable item with the configurated payment gateway
     *
     * @param array $cardData
     * @param integer $userId
     * @param integer $chargeableId
     * @param interger $quantity
     * @return \Payments\Entity\Charge;
     */
    public function purchase(array $cardData, $userId, $chargeableId, $quantity)
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
    
    /**
     * Set the fields of the desired chargeable objects. If any field does
     * not exist in the database, the default configuration value is used.
     *
     * @param \Cake\Datasource\EntityInterface $chargeable
     * @return \Cake\Datasource\EntityInterface
     */
    protected function setFields(EntityInterface $chargeable)
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
