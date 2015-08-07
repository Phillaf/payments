<?php $this->Html->addCrumb('Plans', ['action' => 'index']) ?>
<?php $this->Html->addCrumb('Index') ?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Plans</h3>
                <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover">
                <tbody>
                    <tr>
                                            <th><?= $this->Paginator->sort('id') ?></th>
                                            <th><?= $this->Paginator->sort('amount') ?></th>
                                            <th><?= $this->Paginator->sort('interval_count') ?></th>
                                            <th><?= $this->Paginator->sort('trial_period_days') ?></th>
                                            <th><?= $this->Paginator->sort('created') ?></th>
                                            <th></th>
                    </tr>
                <?php foreach ($plans as $plan): ?>
                    <tr>
                                    <td><?= $this->Number->format($plan->id) ?></td>
                                    <td><?= $this->Number->format($plan->amount) ?></td>
                                    <td><?= $this->Number->format($plan->interval_count) ?></td>
                                    <td><?= $this->Number->format($plan->trial_period_days) ?></td>
                                    <td><?= h($plan->created) ?></td>
                                    <td>
                            <div class="pull-right">
                                <?= $this->Html->link(
                                    '<i class="fa fa-eye"></i>',
                                    ['action' => 'view', $plan->id],
                                    ['escape' => false, 'class' => 'btn btn-default']
                                )?>
                                <?= $this->Html->link(
                                    '<i class="fa fa-pencil"></i>',
                                    ['action' => 'edit', $plan->id],
                                    ['escape' => false, 'class' => 'btn btn-default']
                                )?>
                                <?= $this->Form->postLink(
                                    '<button class="btn btn-default"><i class="fa fa-times"></i></button>',
                                    ['action' => 'delete', $plan->id],
                                    [
                                        'escape' => false,
                                        'confirm' => __('Are you sure you want to delete # {0}?', $plan->id)
                                    ]
                                )?>
                            </div>
                        </td>
                    </tr>
        
                <?php endforeach; ?>
                </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <div class="btn-group pull-left">
                    <?= $this->Html->link(
                        __('New Plan'),
                        ['action' => 'add'],
                        ['class' => 'btn btn-primary', 'escape' => false]
                    );?>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                                    <li><a href="#"><?= __('No associated action') ?></a></li>
                                    </ul>
                </div>
                <div class="pull-right">
                    <ul class="pagination pagination no-margin">
                        <?= $this->Paginator->prev('< ') ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(' >') ?>
                    </ul>
                </div>
                <p class="text-center"><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
    </div>
</div>
