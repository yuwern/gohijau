<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($annualReport->name) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Edit Annual Report'), ['action' => 'edit', $annualReport->id], ['class'=>'btn btn-success']) ?>
			<?= $this->Form->postLink(__('Delete Annual Report'), ['action' => 'delete', $annualReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $annualReport->id), 'class'=>'btn btn-danger']) ?> 
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
					<tr>
						<th><?= __('Added User') ?></th>
						<td><?= $annualReport->has('user') ? $this->Html->link($annualReport->user->email, ['controller' => 'Users', 'action' => 'view', $annualReport->user->id]) : '' ?></td>
					</tr>
					<tr>
						<th><?= __('Annual Report Name') ?></th>
						<td><?= h($annualReport->name) ?></td>
					</tr>
					<tr>
						<th><?= __('Company Name') ?></th>
						<td><?= h($annualReport->company_name) ?></td>
					</tr>
					<tr>
						<th><?= __('Report Year') ?></th>
						<td><?= h($annualReport->report_year) ?></td>
					</tr>
					<tr>
						<th><?= __('Shareholder File Path') ?></th>
						<td>				<?php
					echo $this->Html->link('Share Holder File', '/files/AnnualReports/shareholder_file_path/'. $annualReport->shareholder_file_path).' <br />';
				?></td>
					</tr>
					<tr>
						<th><?= __('Report Pdf File Path') ?></th>
						<td><?php
					echo $this->Html->link('Report Pdf File', '/files/AnnualReports/report_pdf_file_path/'. $annualReport->report_pdf_file_path);
				?></td>
					</tr>
					<tr>
						<th><?= __('Created') ?></th>
						<td><?= h($annualReport->created) ?></td>
					</tr>
					<tr>
						<th><?= __('Modified') ?></th>
						<td><?= h($annualReport->modified) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>