<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Charge'), ['action' => 'edit', $charge->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Charge'), ['action' => 'delete', $charge->id], ['confirm' => __('Are you sure you want to delete # {0}?', $charge->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Charges'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Charge'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="charges view large-10 medium-9 columns">
    <h2><?= h($charge->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Customer') ?></h6>
            <p><?= $charge->has('customer') ? $this->Html->link($charge->customer->id, ['controller' => 'Customers', 'action' => 'view', $charge->customer->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($charge->id) ?></p>
            <h6 class="subheader"><?= __('Amount') ?></h6>
            <p><?= $this->Number->format($charge->amount) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($charge->created) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Paid') ?></h6>
            <p><?= $charge->paid ? __('Yes') : __('No'); ?></p>
            <h6 class="subheader"><?= __('Refunded') ?></h6>
            <p><?= $charge->refunded ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Stripe Charge Id') ?></h6>
            <?= $this->Text->autoParagraph(h($charge->stripe_charge_id)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Currency') ?></h6>
            <?= $this->Text->autoParagraph(h($charge->currency)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Status') ?></h6>
            <?= $this->Text->autoParagraph(h($charge->status)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Receipt Email') ?></h6>
            <?= $this->Text->autoParagraph(h($charge->receipt_email)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Receipt Number') ?></h6>
            <?= $this->Text->autoParagraph(h($charge->receipt_number)) ?>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Failure Message') ?></h6>
            <?= $this->Text->autoParagraph(h($charge->failure_message)) ?>
        </div>
    </div>
</div>
