<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Charge'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="charges index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('customer_id') ?></th>
            <th><?= $this->Paginator->sort('amount') ?></th>
            <th><?= $this->Paginator->sort('paid') ?></th>
            <th><?= $this->Paginator->sort('refunded') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($charges as $charge): ?>
        <tr>
            <td><?= $this->Number->format($charge->id) ?></td>
            <td>
                <?= $charge->has('customer') ? $this->Html->link($charge->customer->id, ['controller' => 'Customers', 'action' => 'view', $charge->customer->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($charge->amount) ?></td>
            <td><?= h($charge->paid) ?></td>
            <td><?= h($charge->refunded) ?></td>
            <td><?= h($charge->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $charge->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $charge->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $charge->id], ['confirm' => __('Are you sure you want to delete # {0}?', $charge->id)]) ?>
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
