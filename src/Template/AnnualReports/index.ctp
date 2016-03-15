<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading"><h3><?= __('View All Annual Reports') ?></h3></div>
			<div class="panel-body">
				<div class="search-form row">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php
						echo $this->Form->create();
						echo $this->Form->input('name', ['type'=>'text']);
						echo $this->Form->input('company_name', ['type'=>'text']);
						echo $this->Form->input('report_year',['label'=>'Report Year', 'class'=>'datepickermonth']);
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
			<?= $this->Html->link(__('New Annual Report'), ['action' => 'add'], ['class'=>'btn btn-success']) ?> </p>
				<table class="table table-striped table-bordered table-hover">
					<thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('company_name') ?></th>
                <th><?= $this->Paginator->sort('report_year') ?></th>
                <th><?= $this->Paginator->sort('created', 'Date Created') ?></th>
                <th><?= $this->Paginator->sort('shareholder_file_path', 'ShareHolder File') ?></th>
                <th><?= $this->Paginator->sort('report_pdf_file_path', 'Report PDF') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($annualReports as $annualReport): ?>
            <tr>
                <td><?= h($annualReport->name) ?></td>
                <td><?= h($annualReport->company_name) ?></td>
                <td><?= h($annualReport->report_year) ?></td>
                <td><?= h($annualReport->created) ?></td>
                <td><?= $this->Html->link($annualReport->shareholder_file_path, '/files/AnnualReports/shareholder_file_path/'. $annualReport->shareholder_file_path) ?></td>
                <td><?= $this->Html->link($annualReport->report_pdf_file_path, '/files/AnnualReports/report_pdf_file_path/'. $annualReport->report_pdf_file_path) ?></td>
                <td class="actions">
					<?= $this->Html->link('<span class="glyphicon glyphicon-save"></span>', ['action'=>'download', $annualReport->id, $annualReport->name], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-wrench"></span>', ['controller'=>'annual_report_users','action' => 'index', $annualReport->id], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $annualReport->id], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $annualReport->id], ['escape'=>false]) ?>
					<?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $annualReport->id], ['escape'=>false, 'confirm' => __('Are you sure you want to delete?')]) ?>
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
					<?= $this->Paginator->numbers() ?>
			</div>
		</div>
	</div>	
</div>
</div>
		</div>
	</div>
</div>