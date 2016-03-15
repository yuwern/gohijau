<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading"><h3><?= __('View All Electronic Circular') ?></h3></div>
			<div class="panel-body">
					<div class="search-form row">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php
						echo $this->Form->create();
						echo $this->Form->input('name', ['type'=>'text']);
						echo $this->Form->input('company_name', ['type'=>'text']);
						echo $this->Form->input('circular_year',['label'=>'Report Year', 'class'=>'datepickermonth']);
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
			<?= $this->Html->link(__('New Circular'), ['action' => 'add'], ['class'=>'btn btn-success']) ?> </p>
				<table class="table table-striped table-bordered">
					<thead>
            <tr>
                <th><?= $this->Paginator->sort('name', 'Circular Name') ?></th>
                <th><?= $this->Paginator->sort('company_name') ?></th>
                <th><?= $this->Paginator->sort('circular_year') ?></th>
                <th><?= $this->Paginator->sort('subject', 'Circular Subject') ?></th>
                <th><?= $this->Paginator->sort('created', 'Date Created') ?></th>
                <th><?= $this->Paginator->sort('modified', 'Last Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($circulars as $circular): ?>
            <tr>
                <td><?= h($circular->name) ?></td>
                <td><?= h($circular->company_name) ?></td>
                <td><?= h($circular->circular_year) ?></td>
                <td><?= h($circular->subject) ?></td>
                <td><?= h($circular->created) ?></td>
                <td><?= h($circular->modified) ?></td>
                <td class="actions">
					<?= $this->Html->link('<span class="glyphicon glyphicon-save"></span>', ['action'=>'download', $circular->id, $circular->name], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-wrench"></span>', ['controller'=>'circular_report_users','action' => 'index', $circular->id], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $circular->id], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $circular->id], ['escape'=>false]) ?>
					<?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $circular->id], ['escape'=>false, 'confirm' => __('Are you sure you want to delete?')]) ?>
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
					<?= $this->Paginator->numbers() ?>
				</ul>
			</div>
		</div>
	</div>	
</div>
</div>
		</div>
	</div>
</div>