<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading"><h3><?= __('Annual Report Users') ?></h3></div>
			<div class="panel-body">
				<div class="search-form row">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php
						echo $this->Form->create();
						echo $this->Form->input('passcode', ['type'=>'text']);
						echo $this->Form->input('name_of_broker', ['type'=>'text']);
						echo $this->Form->input('icno');
						echo $this->Form->input('account_qualifiers',['type'=>'text']);
					?>
					</div>
					<div class="clearfix pull-left search-button">
					<?php
						echo $this->Form->button('Filter', ['type' => 'submit',' class'=>'btn btn-success']);
						echo $this->Html->link('Reset', ['action' => 'index', $this->request->params['pass'][0] ], ['class'=>'btn btn-warning']);
					?>
					</div>
					<?php echo $this->Form->end();?>
				</div>	
	<div class="table">
				<table class="table table-striped table-bordered">
					<thead>
            <tr>
                <th><?= $this->Paginator->sort('passcode') ?></th>
                <th><?= $this->Paginator->sort('icno') ?></th>
                <th><?= $this->Paginator->sort('name_of_shareholders') ?></th>
                <th><?= $this->Paginator->sort('name_of_broker') ?></th>
                <th><?= $this->Paginator->sort('account_qualifiers') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($annualReportUsers as $annualReportUser): ?>
            <tr>
                <td><?= h($annualReportUser->passcode) ?></td>
                <td><?= h($annualReportUser->icno) ?></td>
                <td><?= h($annualReportUser->name_of_shareholders) ?></td>
                <td><?= h($annualReportUser->name_of_broker) ?></td>
                <td><?= h($annualReportUser->account_qualifiers) ?></td>
                <td class="actions">
					<?= $this->Html->link('<span class="glyphicon glyphicon-save"></span>', ['action'=>'download', $annualReportUser->user_pdf_file, $this->request->params['pass'][0]], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $annualReportUser->id, $this->request->params['pass'][0]], ['escape'=>false]) ?>
					<?php //$this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $annualReportUser->id, $this->request->params['pass'][0]], ['escape'=>false]) ?>
					<?php //$this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $annualReportUser->id, $this->request->params['pass'][0]], ['escape'=>false, 'confirm' => __('Are you sure you want to delete ?')]) ?>
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