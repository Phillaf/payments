<?php
namespace Payments\Controller;

use Cake\Core\Configure;

use App\Controller\AppController;
use Payments\Model\Entity\ChargePaypal;

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
        // Get payments configuration
        $config = Configure::read('Payments');
        $gatewayName = $config['gateway'];
        
        $charge = $this->Charges->newEntity(null, $config);
        if ($this->request->is('post')) {

            $user = $this->Auth->user();
            $this->request->data['user_id'] = $user['id'];
            $this->request->data['plan_id'] = $plan_id;
            
            // Create the requested charge
            $chargeData = $charge->purchasePlan($config[$gatewayName], $this->request->data);
            
            debug($chargeData);
            // Save it in the database
            $charge = $this->Charges->patchEntity($charge, $chargeData);
            if ($this->Charges->save($charge)) {
                $this->Flash->success(__('The charge has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The charge could not be saved. Please, try again.'));
            }
        }
        $users = $this->Charges->Users->find('list', ['limit' => 200]);
        $this->set(compact('charge', 'users'));
        $this->set('_serialize', ['charge']); 
    }
}
