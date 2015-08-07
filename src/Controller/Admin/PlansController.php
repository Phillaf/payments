<?php
namespace GintonicCMS\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Plans Controller
 *
 * @property \GintonicCMS\Model\Table\PlansTable $Plans
 */
class PlansController extends AppController
{

    public $paginate = [
        'limit' => 25,
        'order' => [
            'Plans.created' => 'desc'
        ]
    ];
    
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        /*$this->paginate = [];
        $this->set('plans', $this->paginate($this->Plans));
        $this->set('_serialize', ['plans']);*/
        $aros = TableRegistry::get('Aros');
        $plans = $this->Plans->find()
            ->contain(['Aros']);
        $plans = $this->Plans->bindRoles($this->paginate($plans));
        $this->set('plans', $plans);
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
        $plan = $this->Plans->get($id, [
            'contain' => ['Subscriptions']
        ]);
        $this->set('plan', $plan);
        $this->set('_serialize', ['plan']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        debug($this->request->data);
        if ($this->request->is('post')) {
            $plan = $this->Plans->newEntity($this->request->data);
            if ($this->Plans->save($plan)) {
                $this->Flash->set(__('The plan has been saved successfully.'), [
                    'element' => 'GintonicCMS.alert',
                    'params' => ['class' => 'alert-success']
                ]);
                return $this->redirect([
                    'controller' => 'plans',
                    'action' => 'index'
                ]);
            }
            $this->Flash->set(__('Unable to add plan.'), [
                'element' => 'GintonicCMS.alert',
                'params' => ['class' => 'alert-danger']
            ]);
            $this->set('plan', $plan);
        } 
    }

    /**
     * Edit method
     *
     * @param string|$id Plan id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id)
    {
        $plan = $this->Plans->get($id)->accessible('password', true);
        if ($this->request->is(['post', 'put'])) {
            if ($this->request->data['pwd'] != 'dummy') {
                $this->request->data['password'] = $this->request->data['pwd'];
            }
            $plan = $this->Plans->patchEntity($plan, $this->request->data);
            if ($this->Plans->save($plan)) {
                $this->Flash->set(__('Plan updated successfully'), [
                    'element' => 'GintonicCMS.alert',
                    'params' => ['class' => 'alert-success']
                ]);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set(__('Error updating the plan'), [
                'element' => 'GintonicCMS.alert',
                'params' => ['class' => 'alert-danger']
            ]);
        }
        $this->set(compact('plan'));
    }

    /**
     * Delete method
     *
     * @param string|$id Plan id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id)
    {
        $user = $this->Plans->get($id);
        if ($this->Plans->delete($user)) {
            $this->Flash->set(__('Plans deleted'), [
                'element' => 'GintonicCMS.alert',
                'params' => ['class' => 'alert-success']
            ]);
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->set(__('Error deleting plan'), [
            'element' => 'GintonicCMS.alert',
            'params' => ['class' => 'alert-danger']
        ]);
        return $this->redirect(['action' => 'index']);
    }
}
