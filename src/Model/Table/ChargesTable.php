<?php
namespace Payments\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Network\Exception\InternalErrorException;
use Payments\Model\Entity\PaypalExpressCharge;
use Payments\Model\Entity\PaypalRestCharge;
use Payments\Model\Entity\StripeCharge;

/**
 * Charges Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ChargesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('charges');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Payments.Users'
        ]);
    }


    public function newEntity($data = null, array $options = [])
    {
        if ($data === null) {
            if (isset($options['gateway'])) {
                if ($options['gateway'] == 'Stripe') {
                    $entity = new StripeCharge([], ['source' => $this->registryAlias()]);
                }
                else if ($options['gateway'] == 'PayPal_Express') {
                        $entity = new PaypalExpressCharge([], ['source' => $this->registryAlias()]);
                }
                else if ($options['gateway'] == 'PayPal_Rest') {
                        $entity = new PaypalRestCharge([], ['source' => $this->registryAlias()]);
                }
                else {
                    throw new InternalErrorException('Invalid Payment Gateway');
                }
                return $entity;
            }
        }
        
        return parent::newEntity($data, $options);
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
            
        $validator
            ->add('amount', 'valid', ['rule' => 'numeric'])
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');
            
        $validator
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');
            
        $validator
            ->add('paid', 'valid', ['rule' => 'boolean'])
            ->requirePresence('paid', 'create')
            ->notEmpty('paid');
            
        $validator
            ->requirePresence('receipt_email', 'create')
            ->notEmpty('receipt_email');
            
        $validator
            ->requirePresence('receipt_number', 'create')
            ->notEmpty('receipt_number');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
