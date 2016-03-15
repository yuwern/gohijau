<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading"><h3><?= __('View All AGM/EGM') ?></h3></div>
			<div class="panel-body">
				<div class="search-form row">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php
						echo $this->Form->create();
						echo $this->Form->input('report_type', ['type'=>'select', 'empty'=>'Please Select', 'options'=>['AGM'=>'AGM', 'EGM'=>'EGM']]);
						echo $this->Form->input('company_name', ['type'=>'text']);
						echo $this->Form->input('year', ['class'=>'datepickermonth']);
						//echo $this->Form->input('q',['label'=>'By Name']);
					?>
					</div>
					<div class="clearfix pull-left search-button">
					<?php
						echo $this->Form->button('Filter', ['type' => 'submit',' class'=>'btn btn-success']);
						echo $this->Html->link('Reset', ['action' => 'index'], ['class'=>'btn btn-warning']);
					?>
					</div>
					<?php echo $this->Form->end();?>
				</div>		
	<div class="table">
	<p class="pull-right">
			<?= $this->Html->link(__('New Event'), ['action' => 'add'], ['class'=>'btn btn-success']) ?> </p>
				<table class="table table-striped table-bordered">
					<thead>
            <tr>
                <th><?= $this->Paginator->sort('company_name') ?></th>
                <th><?= $this->Paginator->sort('year') ?></th>
                <th><?= $this->Paginator->sort('report_type', 'Event Type') ?></th>
                <th><?= $this->Paginator->sort('report_id', 'Event Relationship To') ?></th>
                <th><?= $this->Paginator->sort('date', 'Event Date/Time') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?= h($event->company_name) ?></td>
                <td><?= h($event->year) ?></td>
                <td><?= h($event->report_type) ?></td>
                <td>
				<?php if($event->report_type == 'AGM'): ?>
					<?= $this->Html->link($event->annual_report->name, ['controller' => 'annual_reports', 'action' => 'view', $event->annual_report->id])?>
				<?php else: ?>
					<?= $this->Html->link($event->circular->name, ['controller' => 'annual_reports', 'action' => 'view', $event->circular->id]) ?>
				<?php endif;?>
				</td>
                <td><?= date('m-d-Y', strtotime($event->date)) ?>&nbsp;<?= h($event->time) ?></td>
                <td><?= h($event->created) ?></td>
                <td class="actions">
					<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $event->id], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $event->id], ['escape'=>false]) ?>
					<?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $event->id], ['escape'=>false, 'confirm' => __('Are you sure you want to delete?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="row">
		<div class="col-lg-6">
			<div class="pagination-panel">
				<?= $this->Paginator->counter(
					'Page {{page}} of {{pages}}, showing {{current}} records out of
					 {{count}} total'
				); ?>
			</div>
		</div>
		<div class="col-lg-6 text-right">
			<div class="pagination-panel">
				<ul class="pagination pagination-sm man">
					<?= $this->Paginator->prev('< ' . __('previous')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('next') . ' >') ?>
				</ul>
			</div>
		</div>
	</div>	
</div>
</div>
		</div>
	</div>
</div>