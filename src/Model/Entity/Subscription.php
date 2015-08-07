<?php
namespace GintonicCMS\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subscription Entity.
 */
class Subscription extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
