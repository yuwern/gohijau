<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($usersEvent->id) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Edit Users Event'), ['action' => 'edit', $usersEvent->id], ['class'=>'btn btn-success']) ?>
			<?= $this->Form->postLink(__('Delete Users Event'), ['action' => 'delete', $usersEvent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersEvent->id), 'class'=>'btn btn-danger']) ?> 
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $usersEvent->has('user') ? $this->Html->link($usersEvent->user->email, ['controller' => 'Users', 'action' => 'view', $usersEvent->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Event') ?></th>
            <td><?= $usersEvent->has('event') ? $this->Html->link($usersEvent->event->title, ['controller' => 'Events', 'action' => 'view', $usersEvent->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersEvent->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($usersEvent->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($usersEvent->modified) ?></td>
        </tr>
    </table>
</div>
	</div>
</div>