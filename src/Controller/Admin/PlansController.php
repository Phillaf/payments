<?php
namespace Payments\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Plans Controller
 *
 * @property \Payments\Model\Table\PlansTable $Plans
 * @property \Payments\Model\Table\PlansTable $Plans
 * @property \Payments\Model\Table\PlansTable $Plans
 */
class PlansController extends AppController
{

    public $paginate = [
        'limit' => 25,
        'order' => [
            'Plans.created' => 'desc'
        ]
    ];
    
}
