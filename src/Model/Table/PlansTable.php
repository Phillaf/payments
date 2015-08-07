<?php
/**
 * GintonicCMS : Full Stack Content Management System (http://gintoniccms.com)
 * Copyright (c) Philippe Lafrance (http://phillafrance.com)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Philippe Lafrance (http://phillafrance.com)
 * @link          http://gintoniccms.com GintonicCMS Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace GintonicCMS\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\ResultSet;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use GintonicCMS\Model\Entity\Plan;

/**
 * Plans Model
 *
 * @property \Cake\ORM\Association\BelongsTo $StripePlans
 * @property \Cake\ORM\Association\HasMany $Subscriptions
 * @property \Cake\ORM\Association\HasMany $Aros
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
        $this->table('plans');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Subscriptions', [
            'foreignKey' => 'plan_id',
            'className' => 'GintonicCMS.Subscriptions'
        ]);
        $this->hasMany('Acl.Aros', [
            'conditions' => ['Aros.model' => 'Plans'],
            'foreignKey' => 'foreign_key'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');
            
        $validator
            ->add('amount', 'valid', ['rule' => 'numeric'])
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');
            
        $validator
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');
            
        $validator
            ->requirePresence('interval_type', 'create')
            ->notEmpty('interval_type');
            
        $validator
            ->add('interval_count', 'valid', ['rule' => 'numeric'])
            ->requirePresence('interval_count', 'create')
            ->notEmpty('interval_count');
            
        $validator
            ->add('trial_period_days', 'valid', ['rule' => 'numeric'])
            ->requirePresence('trial_period_days', 'create')
            ->notEmpty('trial_period_days');

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
        $rules->add($rules->isUnique(['name']));
        return $rules;
    }
    
    /**
     * TODO: docblock
     */
    public function bindRoles(ResultSet $plans)
    {
        // Avoid loading the association and condition in current model by using
        // the aros directly from the TableRegistry
        $aros = TableRegistry::get('Aros');

        return $plans->map(function ($row) use (&$aros) {
            $row->roles = [];

            foreach ($row->aros as $aro) {
                $roles = $aros
                    ->find('path', ['for' => $aro['id']])
                    ->select(['id'])
                    ->distinct();
                $roleGroup = $aros->find()
                    ->where([
                        'Aros.id IN' => $roles,
                    ])
                    ->where(['alias IS NOT' => null])
                    ->hydrate(false);
                foreach ($roleGroup as $role) {
                    $row->roles[] = $role;
                }
            }

            return $row;
        });
    }
}
