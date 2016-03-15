<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($circular->name) ?> Complete</div>
		</div>
		<div class="portlet-body">
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
					<tr>
						<th><?= __('Annual Report Name') ?></th>
						<td><?= h($circular->name) ?></td>
					</tr>
					<tr>
						<th><?= __('Company Name') ?></th>
						<td><?= h($circular->company_name) ?></td>
					</tr>
					<tr>
						<th><?= __('Report Year') ?></th>
						<td><?= h($circular->circular_year) ?></td>
					</tr>
					<tr>
						<th><?= __('Subject') ?></th>
						<td><?= h($circular->subject) ?></td>
					</tr>
					
					<tr>
						<th><?= __('No of Shareholders') ?></th>
						<td><?= h($circular->total_count) ?></td>
					</tr>
					<tr>
						<th><?= __('No of Shareholders Record Error') ?></th>
						<td><?= h($circular->failed_count) ?></td>
					</tr>
				</tbody>
			</table>
			<p><b>Complete Successfully</b></p>
			<div class="text-right">
				<?= $this->Html->link(__('Create corresponding EGM Event'), ['controller'=>'events', 'action' => 'add'], ['class'=>'btn btn-success']) ?> 
			</div>

		</div>
	</div>
</div>