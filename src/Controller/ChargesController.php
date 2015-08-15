<?php
namespace Payments\Controller;

use App\Controller\AppController;

/**
 * Charges Controller
 *
 * @property \Payments\Model\Table\ChargesTable $Charges
 */
class ChargesController extends AppController
{

    /**
     * Charge plan method
     *
     * @return void Redirects on successful test, renders view otherwise.
     */
    public function plan($plan_id = null)
    {
        $charge = $this->Charges->newEntity();
        if ($this->request->is('post')) {

            $user = $this->Auth->user();
            $this->request->data['user_id'] = $user['id'];
            $this->request->data['plan_id'] = $plan_id;
            
            debug($this->request->data);
            
            // Create the requested charge
            $chargeData = $charge->createPlanCharge($this->request->data);
            
            debug($chargeData);
            // Save it in the database
            $charge = $this->Charges->patchEntity($charge, $chargeData);
            if ($this->Charges->save($charge)) {
                $this->Flash->success(__('The charge has been saved.'));
                return $this->redirect(['action' => 'charges']);
            } else {
                $this->Flash->error(__('The charge could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Charges->Customers->find('list', ['limit' => 200]);
        $this->set(compact('charge', 'customers'));
        $this->set('_serialize', ['charge']); 
    }
}
