<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Subscription'), ['action' => 'edit', $subscription->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subscription'), ['action' => 'delete', $subscription->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscription->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subscriptions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscription'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="subscriptions view large-10 medium-9 columns">
    <h2><?= h($subscription->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Plan') ?></h6>
            <p><?= $subscription->has('plan') ? $this->Html->link($subscription->plan->name, ['controller' => 'Plans', 'action' => 'view', $subscription->plan->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Customer') ?></h6>
            <p><?= $subscription->has('customer') ? $this->Html->link($subscription->customer->id, ['controller' => 'Customers', 'action' => 'view', $subscription->customer->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($subscription->id) ?></p>
            <h6 class="subheader"><?= __('Application Fee Percent') ?></h6>
            <p><?= $this->Number->format($subscription->application_fee_percent) ?></p>
            <h6 class="subheader"><?= __('Tax Percent') ?></h6>
            <p><?= $this->Number->format($subscription->tax_percent) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Start') ?></h6>
            <p><?= h($subscription->start) ?></p>
            <h6 class="subheader"><?= __('Current Period Start') ?></h6>
            <p><?= h($subscription->current_period_start) ?></p>
            <h6 class="subheader"><?= __('Current Period End') ?></h6>
            <p><?= h($subscription->current_period_end) ?></p>
            <h6 class="subheader"><?= __('Ended At') ?></h6>
            <p><?= h($subscription->ended_at) ?></p>
            <h6 class="subheader"><?= __('Canceled At') ?></h6>
            <p><?= h($subscription->canceled_at) ?></p>
            <h6 class="subheader"><?= __('Trial Start') ?></h6>
            <p><?= h($subscription->trial_start) ?></p>
            <h6 class="subheader"><?= __('Trial End') ?></h6>
            <p><?= h($subscription->trial_end) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Cancel At Period End') ?></h6>
            <p><?= $subscription->cancel_at_period_end ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Stripe Subscription Id') ?></h6>
            <?= $this->Text->autoParagraph(h($subscription->stripe_subscription_id)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Status') ?></h6>
            <?= $this->Text->autoParagraph(h($subscription->status)) ?>
        </div>
    </div>
</div>
