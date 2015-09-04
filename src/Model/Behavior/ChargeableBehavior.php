<?php

namespace Payments\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
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
        
        //'amount' => 0,
        //'currency' => 'USD',
        //'name' => "Item",
        //'description' => "Item Description"
    ];
    
    public function initialize(array $config)
    {
        if (is_null($config['amount'])) {
            // OMG
        }
    }
    
    public function purchase($ccData, $userId, $chargeableId, $quantity)
    {
        // Get payments configuration
        $config = Configure::read('Payments');
        $gatewayName = $config['gateway'];
        
        $chargeTable = TableRegistry::get('Payments.Charges');
        $charge = $chargeTable->newEntity();
        
        // todo: Manage names
        $chargeable[$this->config['amount']];
        
        // todo: Manage defaults

        // Get the chargeable entity
        $chargeable =  $this->_table->find()->where([$this->_table->primaryKey() . ' IN' => $chargeableId])->hydrate(false)->toArray();
        $charge->purchase($config, $ccData, $chargeable);
         
        
        $charge = $chargeTable->patchEntity($charge, $chargeData);
        if ($this->Charges->save($charge)) {
            $this->Flash->success(__('The charge has been saved.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The charge could not be saved. Please, try again.'));
        } 
    }
}
