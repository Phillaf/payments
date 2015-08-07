<?php
namespace GintonicCMS\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use GintonicCMS\Model\Entity\Charge;

/**
 * Charges Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Customers
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
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
            'className' => 'GintonicCMS.Customers'
        ]);
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
            
        /*$validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');*/
            
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
            
        /*$validator
            ->add('refunded', 'valid', ['rule' => 'boolean'])
            ->requirePresence('refunded', 'create')
            ->notEmpty('refunded');
            
        $validator
            ->requirePresence('failure_message', 'create')
            ->notEmpty('failure_message');*/

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        return $rules;
    }
}
