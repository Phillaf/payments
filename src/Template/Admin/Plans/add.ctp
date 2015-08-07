<?php $this->Html->addCrumb('Plans', ['action' => 'index']) ?>
<?php $this->Html->addCrumb('Add') ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= __('Add Plan') ?></h3>
            </div>
            <?= $this->Form->create($plan, [
                'templates' => [
                    'submitContainer' => '{{content}}'
                ],
            ]) ?>
                <div class="box-body">
                    <?php
                                    echo $this->Form->input('stripe_plan_id');
                                    echo $this->Form->input('name');
                                    echo $this->Form->input('amount');
                                    echo $this->Form->input('currency');
                                    echo $this->Form->input('interval_type');
                                    echo $this->Form->input('interval_count');
                                    echo $this->Form->input('trial_period_days');
                                ?>
                </div>
                <div class="box-footer">
                    <?= $this->Form->submit(
                        __('Submit'),
                        [
                            'class' => 'btn btn-primary',
                        ]
                    ) ?> 
                    <div class="btn-group">
                        <?= $this->Html->link(
                            __('Cancel'),
                            ['action' => 'index'],
                            ['class' => 'btn btn-default']
                        );?>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><?= $this->Html->link(__('List Plans'), ['action' => 'index']) ?></li>
                            <hr/>
                                                                        </ul>
                    </div>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
