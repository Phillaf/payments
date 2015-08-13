<?php
namespace Payments\Model\Entity;

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
        '*' => true,
        'id' => false,
    ];
}
