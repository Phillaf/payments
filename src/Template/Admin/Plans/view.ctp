<?php $this->Html->addCrumb('Plans', ['action' => 'index']) ?>
<?php $this->Html->addCrumb('View') ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h2 class="box-title"><?= h($plan->name) ?></h2>
                <div class="box-tools">
                    <?= $this->Html->link(
                        __('<i class="fa fa-pencil"></i>'), 
                        ['action' => 'edit', $plan->id],
                        [
                            'class' => 'btn btn-primary',
                            'escape' => false
                        ]
                    ) ?>
                    <?= $this->Form->postLink(
                        __('<i class="fa fa-times"></i>'), 
                        ['action' => 'delete', $plan->id],
                        [
                            'confirm' => __('Are you sure you want to delete # {0}?', $plan->id),
                            'class' => 'btn btn-primary',
                            'escape' => false
                        ]
                    ) ?>
                </div>
            </div>
            <div class="box-body">
                <div class="plans view row">
                                                    <div class="col-md-4 numbers">
                                        <strong class="subheader"><?= __('Id') ?></strong><br>
                        <p><?= $this->Number->format($plan->id) ?></p>
                                        <strong class="subheader"><?= __('Amount') ?></strong><br>
                        <p><?= $this->Number->format($plan->amount) ?></p>
                                        <strong class="subheader"><?= __('Interval Count') ?></strong><br>
                        <p><?= $this->Number->format($plan->interval_count) ?></p>
                                        <strong class="subheader"><?= __('Trial Period Days') ?></strong><br>
                        <p><?= $this->Number->format($plan->trial_period_days) ?></p>
                                    </div>
                                                    <div class="col-md-4 dates end">
                                        <strong class="subheader"><?= __('Created') ?></strong><br>
                        <p><?= h($plan->created) ?></p>
                                    </div>
                                                                                    <div class="row texts">
                        <div class="col-md-12">
                            <strong class="subheader"><?= __('Stripe Plan Id') ?></strong><br>
                            <?= $this->Text->autoParagraph(h($plan->stripe_plan_id)) ?>
                        </div>
                    </div>
                                    <div class="row texts">
                        <div class="col-md-12">
                            <strong class="subheader"><?= __('Name') ?></strong><br>
                            <?= $this->Text->autoParagraph(h($plan->name)) ?>
                        </div>
                    </div>
                                    <div class="row texts">
                        <div class="col-md-12">
                            <strong class="subheader"><?= __('Currency') ?></strong><br>
                            <?= $this->Text->autoParagraph(h($plan->currency)) ?>
                        </div>
                    </div>
                                    <div class="row texts">
                        <div class="col-md-12">
                            <strong class="subheader"><?= __('Interval Type') ?></strong><br>
                            <?= $this->Text->autoParagraph(h($plan->interval_type)) ?>
                        </div>
                    </div>
                                                </div>
            </div>
            <div class="box-footer clearfix">
                <div class="btn-group pull-left">
                    <?= $this->Html->link(
                        __('List Plans'),
                        ['action' => 'index'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><?= $this->Html->link(__('New Plan'), ['action' => 'add']) ?> </li>
                                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>



