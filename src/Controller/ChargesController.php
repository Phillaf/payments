<?php
namespace GintonicCMS\Controller;

use GintonicCMS\Controller\AppController;

/**
 * Charges Controller
 *
 * @property \GintonicCMS\Model\Table\ChargesTable $Charges
 */
class ChargesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers']
        ];
        $this->set('charges', $this->paginate($this->Charges));
        $this->set('_serialize', ['charges']);
    }

    /**
     * View method
     *
     * @param string|null $id Charge id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $charge = $this->Charges->get($id, [
            'contain' => ['Customers']
        ]);
        $this->set('charge', $charge);
        $this->set('_serialize', ['charge']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $charge = $this->Charges->newEntity();
        if ($this->request->is('post')) {
            $charge = $this->Charges->patchEntity($charge, $this->request->data);
            if ($this->Charges->save($charge)) {
                $this->Flash->success(__('The charge has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The charge could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Charges->Customers->find('list', ['limit' => 200]);
        $this->set(compact('charge', 'customers'));
        $this->set('_serialize', ['charge']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Charge id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $charge = $this->Charges->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $charge = $this->Charges->patchEntity($charge, $this->request->data);
            if ($this->Charges->save($charge)) {
                $this->Flash->success(__('The charge has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The charge could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Charges->Customers->find('list', ['limit' => 200]);
        $this->set(compact('charge', 'customers'));
        $this->set('_serialize', ['charge']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Charge id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $charge = $this->Charges->get($id);
        if ($this->Charges->delete($charge)) {
            $this->Flash->success(__('The charge has been deleted.'));
        } else {
            $this->Flash->error(__('The charge could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * Test method
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
            
            $charge = $this->Charges->patchEntity($charge, $chargeData);
            debug($charge);
            /*if ($this->Charges->save($charge)) {
                $this->Flash->success(__('The charge has been saved.'));
                return $this->redirect(['action' => 'plan']);
            } else {
                $this->Flash->error(__('The charge could not be saved. Please, try again.'));
            }*/
        }
        $customers = $this->Charges->Customers->find('list', ['limit' => 200]);
        $this->set(compact('charge', 'customers'));
        $this->set('_serialize', ['charge']); 
    }
}
