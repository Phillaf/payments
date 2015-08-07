<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Subscription'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Plans'), ['controller' => 'Plans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Plan'), ['controller' => 'Plans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="subscriptions index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('plan_id') ?></th>
            <th><?= $this->Paginator->sort('customer_id') ?></th>
            <th><?= $this->Paginator->sort('cancel_at_period_end') ?></th>
            <th><?= $this->Paginator->sort('application_fee_percent') ?></th>
            <th><?= $this->Paginator->sort('start') ?></th>
            <th><?= $this->Paginator->sort('current_period_start') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($subscriptions as $subscription): ?>
        <tr>
            <td><?= $this->Number->format($subscription->id) ?></td>
            <td>
                <?= $subscription->has('plan') ? $this->Html->link($subscription->plan->name, ['controller' => 'Plans', 'action' => 'view', $subscription->plan->id]) : '' ?>
            </td>
            <td>
                <?= $subscription->has('customer') ? $this->Html->link($subscription->customer->id, ['controller' => 'Customers', 'action' => 'view', $subscription->customer->id]) : '' ?>
            </td>
            <td><?= h($subscription->cancel_at_period_end) ?></td>
            <td><?= $this->Number->format($subscription->application_fee_percent) ?></td>
            <td><?= h($subscription->start) ?></td>
            <td><?= h($subscription->current_period_start) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $subscription->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subscription->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subscription->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subscription->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
