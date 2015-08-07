<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Charges'), ['controller' => 'Charges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Charge'), ['controller' => 'Charges', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subscriptions'), ['controller' => 'Subscriptions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscription'), ['controller' => 'Subscriptions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="customers view large-10 medium-9 columns">
    <h2><?= h($customer->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $customer->has('user') ? $this->Html->link($customer->user->email, ['controller' => 'Users', 'action' => 'view', $customer->user->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($customer->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($customer->created) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Deliquent') ?></h6>
            <p><?= $customer->deliquent ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Stripe Customer Id') ?></h6>
            <?= $this->Text->autoParagraph(h($customer->stripe_customer_id)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Currency') ?></h6>
            <?= $this->Text->autoParagraph(h($customer->currency)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Charges') ?></h4>
    <?php if (!empty($customer->charges)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Stripe Charge Id') ?></th>
            <th><?= __('Customer Id') ?></th>
            <th><?= __('Amount') ?></th>
            <th><?= __('Currency') ?></th>
            <th><?= __('Status') ?></th>
            <th><?= __('Paid') ?></th>
            <th><?= __('Receipt Email') ?></th>
            <th><?= __('Receipt Number') ?></th>
            <th><?= __('Refunded') ?></th>
            <th><?= __('Failure Message') ?></th>
            <th><?= __('Created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($customer->charges as $charges): ?>
        <tr>
            <td><?= h($charges->id) ?></td>
            <td><?= h($charges->stripe_charge_id) ?></td>
            <td><?= h($charges->customer_id) ?></td>
            <td><?= h($charges->amount) ?></td>
            <td><?= h($charges->currency) ?></td>
            <td><?= h($charges->status) ?></td>
            <td><?= h($charges->paid) ?></td>
            <td><?= h($charges->receipt_email) ?></td>
            <td><?= h($charges->receipt_number) ?></td>
            <td><?= h($charges->refunded) ?></td>
            <td><?= h($charges->failure_message) ?></td>
            <td><?= h($charges->created) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Charges', 'action' => 'view', $charges->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Charges', 'action' => 'edit', $charges->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Charges', 'action' => 'delete', $charges->id], ['confirm' => __('Are you sure you want to delete # {0}?', $charges->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Subscriptions') ?></h4>
    <?php if (!empty($customer->subscriptions)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Stripe Subscription Id') ?></th>
            <th><?= __('Plan Id') ?></th>
            <th><?= __('Customer Id') ?></th>
            <th><?= __('Status') ?></th>
            <th><?= __('Cancel At Period End') ?></th>
            <th><?= __('Application Fee Percent') ?></th>
            <th><?= __('Start') ?></th>
            <th><?= __('Current Period Start') ?></th>
            <th><?= __('Current Period End') ?></th>
            <th><?= __('Tax Percent') ?></th>
            <th><?= __('Ended At') ?></th>
            <th><?= __('Canceled At') ?></th>
            <th><?= __('Trial Start') ?></th>
            <th><?= __('Trial End') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($customer->subscriptions as $subscriptions): ?>
        <tr>
            <td><?= h($subscriptions->id) ?></td>
            <td><?= h($subscriptions->stripe_subscription_id) ?></td>
            <td><?= h($subscriptions->plan_id) ?></td>
            <td><?= h($subscriptions->customer_id) ?></td>
            <td><?= h($subscriptions->status) ?></td>
            <td><?= h($subscriptions->cancel_at_period_end) ?></td>
            <td><?= h($subscriptions->application_fee_percent) ?></td>
            <td><?= h($subscriptions->start) ?></td>
            <td><?= h($subscriptions->current_period_start) ?></td>
            <td><?= h($subscriptions->current_period_end) ?></td>
            <td><?= h($subscriptions->tax_percent) ?></td>
            <td><?= h($subscriptions->ended_at) ?></td>
            <td><?= h($subscriptions->canceled_at) ?></td>
            <td><?= h($subscriptions->trial_start) ?></td>
            <td><?= h($subscriptions->trial_end) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Subscriptions', 'action' => 'view', $subscriptions->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Subscriptions', 'action' => 'edit', $subscriptions->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subscriptions', 'action' => 'delete', $subscriptions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscriptions->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
