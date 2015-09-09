<?php
namespace Payments\Controller;

use App\Controller\AppController;

/**
 * Plans Controller
 *
 * @property \Payments\Model\Table\PlansTable $Plans
 */
class PlansController extends AppController
{
    /* Charge plan method
    *
    * @return void Redirects on successful test, renders view otherwise.
    */
    public function charge($plan_id = null)
    {        
        $plan = $this->Plans->newEntity();
        if ($this->request->is('post')) {

            $user = $this->Auth->user();
            $this->request->data['user_id'] = $user['id'];
            $this->request->data['plan_id'] = $plan_id;
            
            // Create the requested charge
            $charge = $this->Plans->purchase($this->request->data, $user, $plan_id, 1);
            
            // Save it in the database
            //$charge = $this->Charges->patchEntity($charge, $chargeData);
            /*if ($this->Charges->save($charge)) {
                $this->Flash->success(__('The charge has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The charge could not be saved. Please, try again.'));
            } */
        }
        //$users = $this->Charges->Users->find('list', ['limit' => 200]);
        $this->set(compact('plan'));
        $this->set('_serialize', ['plan']);
    }
}
