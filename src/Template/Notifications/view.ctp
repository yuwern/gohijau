<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($notification->id) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Edit Notification'), ['action' => 'edit', $notification->id], ['class'=>'btn btn-success']) ?>
			<?= $this->Form->postLink(__('Delete Notification'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id), 'class'=>'btn btn-danger']) ?> 
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $notification->has('company') ? $this->Html->link($notification->company->name, ['controller' => 'Companies', 'action' => 'view', $notification->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($notification->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Content') ?></th>
            <td><?= h($notification->content) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $notification->has('user') ? $this->Html->link($notification->user->email, ['controller' => 'Users', 'action' => 'view', $notification->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($notification->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Refer Id') ?></th>
            <td><?= $this->Number->format($notification->refer_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($notification->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $notification->status ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
</div>
	</div>
</div>