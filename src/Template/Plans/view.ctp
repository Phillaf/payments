<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Plan'), ['action' => 'edit', $plan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Plan'), ['action' => 'delete', $plan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Plans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plan'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subscriptions'), ['controller' => 'Subscriptions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subscription'), ['controller' => 'Subscriptions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="plans view large-10 medium-9 columns">
    <h2><?= h($plan->name) ?></h2>
    <div class="row">
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($plan->id) ?></p>
            <h6 class="subheader"><?= __('Amount') ?></h6>
            <p><?= $this->Number->format($plan->amount) ?></p>
            <h6 class="subheader"><?= __('Interval Count') ?></h6>
            <p><?= $this->Number->format($plan->interval_count) ?></p>
            <h6 class="subheader"><?= __('Trial Period Days') ?></h6>
            <p><?= $this->Number->format($plan->trial_period_days) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($plan->created) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Stripe Plan Id') ?></h6>
            <?= $this->Text->autoParagraph(h($plan->stripe_plan_id)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <?= $this->Text->autoParagraph(h($plan->name)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Currency') ?></h6>
            <?= $this->Text->autoParagraph(h($plan->currency)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Interval') ?></h6>
            <?= $this->Text->autoParagraph(h($plan->interval)) ?>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Subscriptions') ?></h4>
    <?php if (!empty($plan->subscriptions)): ?>
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
        <?php foreach ($plan->subscriptions as $subscriptions): ?>
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
