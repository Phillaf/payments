<?php
namespace GintonicCMS\Controller;

use GintonicCMS\Controller\AppController;

/**
 * Plans Controller
 *
 * @property \GintonicCMS\Model\Table\PlansTable $Plans
 */
class PlansController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        //$this->paginate = [];
        $this->set('plans', $this->paginate($this->Plans));
        $this->set('_serialize', ['plans']);
    }

    /**
     * View method
     *
     * @param string|null $id Plan id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $plan = $this->Plans->get($id);
        $this->set('plan', $plan);
        $this->set('_serialize', ['plan']);
    }
}
