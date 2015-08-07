<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Charges'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="charges form large-10 medium-9 columns">
    <?= $this->Form->create($charge) ?>
    <fieldset>
        <legend><?= __('Add Charge') ?></legend>
        <?php
            echo $this->Form->input('stripe_charge_id');
            echo $this->Form->input('customer_id', ['options' => $customers]);
            echo $this->Form->input('amount');
            echo $this->Form->input('currency');
            echo $this->Form->input('status');
            echo $this->Form->input('paid');
            echo $this->Form->input('receipt_email');
            echo $this->Form->input('receipt_number');
            echo $this->Form->input('refunded');
            echo $this->Form->input('failure_message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
