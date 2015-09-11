<?php
namespace Payments\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Payments\Model\Entity\Plan;
use Payments\Model\Behavior\ChargeableBehavior;


/**
 * Plans Model
 *
 * @property \Cake\ORM\Association\HasMany $Subscriptions
 */
class PlansTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
       parent::initialize($config);

        $this->table('plans');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Subscriptions', [
            'foreignKey' => 'plan_id',
            'className' => 'Payments.Subscriptions'
        ]);
        
        //$this->addBehavior('Payments.Chargeable');
        $this->addBehavior('Payments.Chargeable', ['amount' => 'amount', 'currency' => 'currency', 'name' => 'name']);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        return $validator;
    }
}
