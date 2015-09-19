[![Build Status](https://travis-ci.org/gintonicweb/payments.svg)](https://travis-ci.org/gintonicweb/payments)

# payments


*Warning: Do not use, very early stage*

Wrapper for thephpleague/Omnipay. Attach the "chargeable" behavior to your own 
models to automaticly process the payments through the gateway of your choice.


## Installation

Using [composer](http://getcomposer.org).

```
composer require gintonicweb/payments:dev-master
```

Load the plugin in ```bootstrap.php``` like:

```
Plugin::load('Payments');
```

Here's the list of options you can add to your applications' ```bootstrap.php```
file

```
Configure::write('Payments' => [
    'PayPal_Express' => [
        'username' => 'example_username',
        'password' => 'example_password',
        'signature' => 'example_signature',
        'testMode' => true,
    ],
    'Stripe' => [
        'apiKey' => 'example_key',
    ],
]);
```

Attach the chargeable behavior to your own ```ItemsTable.php``` (or any table
requiring payments processing) like this. 

```
$this->addBehavior('Payments.Chargeable', [
    'gateway' => 'PayPal_Express',
    'fields' => [
        'amount' => 'my_amount_field',
        'name' => 'my_name_field',
        'description' => 'my_description_field',
        'currency' => 'USD',
    ]
    'defaults' => [
        'amount' => '10.00',
        'name' => 'Generic Item Name',
        'description' => 'Generic Item description here',
        'currency' => 'USD',
    ]
]);
```

Use the 'fields' section to map which fields in your database to use for 
transactions. If all of the items use the same value, which is common for
currency for example, you can skip the database lookup and set id as a default 
option.

## Usage

Create a form and collect credit card information. The following credit card fields(prefixed with 'pay-') are required:  
* card-number
* card-expiry-month
* card-expiry-year
* card-cvc

Some extra fields are also available to add billing or shipping information to a payment. The following customer information fields(prefixed with 'pay-bill-' or 'pay-ship-') are available: 
* firstName
* lastName
* name
* company
* address1
* address2
* city
* postcode
* state
* country
* phone
* fax. 

```
<?php $this->Form->create($item) ?>
    echo $this->Form->input('pay-bill-firstname', ['type' => 'text', 'label' => 'First Name']);
    echo $this->Form->input('pay-bill-lastname', ['type' => 'text', 'label' => 'Last Name']);
    echo $this->Form->input('pay-card-number', ['type' => 'text', 'label' => 'Card Number']);
    echo $this->Form->input('pay-card-expiry-month', ['type' => 'text', 'label' => 'Expiration Month']);
    echo $this->Form->input('pay-card-expiry-year', ['type' => 'text', 'label' => 'Expiration Year']);
    echo $this->Form->input('pay-card-cvc', ['type' => 'text', 'label' => 'CVC']);
<?php $this->Form->end() ?>
```


Call purchase() on the entity.
```
public function purchase($item_id)
{        
    $item = $this->Item->newEntity();
    if ($this->request->is('post')) {

        $user = $this->Auth->user();
        $this->request->data['user_id'] = $user['id'];
        $this->request->data['item_id'] = $item_id;
        
        // Create the requested charge
        $charge = $this->Items->purchase($user, $this->request->data);
        if ($charge) {
            $this->Flash->success('Purchase successful');
        } else {
            $this->Flash->error('Purchase error');
        }
    }
    $this->set(compact('item'));
}
```

The passed data in ```$this->request->data``` must be the following

```
TODO
```
