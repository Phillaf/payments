<div class="actions columns large-2 medium-3">
    <h3><?= __('Plans') ?></h3>
    <ul class="side-nav">
    </ul>
</div>
<div class="plans index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('amount') ?></th>
            <th><?= $this->Paginator->sort('interval_count') ?></th>
            <th><?= $this->Paginator->sort('trial_period_days') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($plans as $plan): ?>
        <tr>
            <td><?= $this->Number->format($plan->id) ?></td>
            <td><?= $plan->name ?></td>
            <td><?= $this->Number->format($plan->amount) ?></td>
            <td><?= $this->Number->format($plan->interval_count) ?></td>
            <td><?= $this->Number->format($plan->trial_period_days) ?></td>
            <td><?= h($plan->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Buy'), ['controller' => 'charges', 'action' => 'test', $plan->id]) ?>
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
