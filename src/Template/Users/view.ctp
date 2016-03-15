<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($user->id) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Update'), ['action' => 'edit', $user->id], ['class'=>'btn btn-success']) ?>   
			<?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class'=>'btn btn-danger']) ?> 
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
					<tr><th><?= __('Username') ?></th><td><?= h($user->username) ?></td></tr>
					<tr><th><?= __('Email') ?></th><td><?= h($user->email) ?></td></tr>
					<tr><th><?= __('First Name') ?></th><td><?= h($user->first_name) ?></td></tr>
					<tr><th><?= __('Last Name') ?></th><td><?= h($user->last_name) ?></td></tr>
					<tr><th><?= __('Last Name') ?></th><td><?= h($user->last_name) ?></td></tr>
					<tr><th><?= __('Active Status') ?></th><td><?= $user->active ? __('Yes') : __('No'); ?></td></tr>
				</tbody>
			</table>
		</div>
	</div>
</div>