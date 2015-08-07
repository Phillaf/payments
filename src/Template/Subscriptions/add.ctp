<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Subscriptions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="subscriptions form large-10 medium-9 columns">
    <?= $this->Form->create($subscription) ?>
    <fieldset>
        <legend><?= __('Add Subscription') ?></legend>
        <?php
            echo $this->Form->input('stripe_subscription_id');
            echo $this->Form->input('plan_id', ['options' => $plans]);
            echo $this->Form->input('customer_id', ['options' => $customers]);
            echo $this->Form->input('status');
            echo $this->Form->input('cancel_at_period_end');
            echo $this->Form->input('application_fee_percent');
            echo $this->Form->input('start');
            echo $this->Form->input('current_period_start');
            echo $this->Form->input('current_period_end');
            echo $this->Form->input('tax_percent');
            echo $this->Form->input('ended_at');
            echo $this->Form->input('canceled_at');
            echo $this->Form->input('trial_start');
            echo $this->Form->input('trial_end');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
