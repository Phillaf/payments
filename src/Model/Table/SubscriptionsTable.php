<?php
namespace GintonicCMS\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use GintonicCMS\Model\Entity\Subscription;

/**
 * Subscriptions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Plans
 * @property \Cake\ORM\Association\BelongsTo $Customers
 */
class SubscriptionsTable extends Table
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

        $this->table('subscriptions');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'INNER',
            'className' => 'GintonicCMS.Plans'
        ]);
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
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->add('cancel_at_period_end', 'valid', ['rule' => 'boolean'])
            ->requirePresence('cancel_at_period_end', 'create')
            ->notEmpty('cancel_at_period_end');

        $validator
            ->add('application_fee_percent', 'valid', ['rule' => 'decimal'])
            ->requirePresence('application_fee_percent', 'create')
            ->notEmpty('application_fee_percent');

        $validator
            ->add('start', 'valid', ['rule' => 'datetime'])
            ->requirePresence('start', 'create')
            ->notEmpty('start');

        $validator
            ->add('current_period_start', 'valid', ['rule' => 'datetime'])
            ->requirePresence('current_period_start', 'create')
            ->notEmpty('current_period_start');

        $validator
            ->add('current_period_end', 'valid', ['rule' => 'datetime'])
            ->requirePresence('current_period_end', 'create')
            ->notEmpty('current_period_end');

        $validator
            ->add('tax_percent', 'valid', ['rule' => 'decimal'])
            ->requirePresence('tax_percent', 'create')
            ->notEmpty('tax_percent');

        $validator
            ->add('ended_at', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('ended_at');

        $validator
            ->add('canceled_at', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('canceled_at');

        $validator
            ->add('trial_start', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('trial_start');

        $validator
            ->add('trial_end', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('trial_end');

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
        $rules->add($rules->existsIn(['stripe_subscription_id'], 'StripeSubscriptions'));
        $rules->add($rules->existsIn(['plan_id'], 'Plans'));
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        return $rules;
    }
}
