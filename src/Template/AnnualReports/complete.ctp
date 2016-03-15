<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($annualReport->name) ?> Complete</div>
		</div>
		<div class="portlet-body">
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
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
						<th><?= __('No of Shareholders') ?></th>
						<td><?= h($annualReport->total_count) ?></td>
					</tr>
					<tr>
						<th><?= __('No of Shareholders Record Error') ?></th>
						<td><?= h($annualReport->failed_count) ?></td>
					</tr>
				</tbody>
			</table>
			<p><b>Complete Successfully</b></p>
			<div class="text-right">
				<?= $this->Html->link(__('Create corresponding AGM Event'), ['controller'=>'events', 'action' => 'add'], ['class'=>'btn btn-success']) ?> 
			</div>

		</div>
	</div>
</div>