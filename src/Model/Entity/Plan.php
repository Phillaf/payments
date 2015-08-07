<?php
namespace GintonicCMS\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plan Entity.
 */
class Plan extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'stripe_plan_id' => true,
        'name' => true,
        'amount' => true,
        'currency' => true,
        'interval_type' => true,
        'interval_count' => true,
        'trial_period_days' => true,
        'stripe_plan' => true,
        'subscriptions' => true,
    ];
}
