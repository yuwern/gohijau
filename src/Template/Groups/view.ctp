<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($group->name) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Edit Group'), ['action' => 'edit', $group->id], ['class'=>'btn btn-success']) ?>
			<?= $this->Form->postLink(__('Delete Group'), ['action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # {0}?', $group->id), 'class'=>'btn btn-danger']) ?> 
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($group->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($group->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($group->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($group->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($group->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Username') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Password') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Phone') ?></th>
                <th><?= __('Token Expires') ?></th>
                <th><?= __('Token') ?></th>
                <th><?= __('Is Phone Verified') ?></th>
                <th><?= __('Is Email Verified') ?></th>
                <th><?= __('Activation Date') ?></th>
                <th><?= __('Avatar') ?></th>
                <th><?= __('Active') ?></th>
                <th><?= __('Is Super User') ?></th>
                <th><?= __('Group Id') ?></th>
                <th><?= __('Role') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($group->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->first_name) ?></td>
                <td><?= h($users->last_name) ?></td>
                <td><?= h($users->phone) ?></td>
                <td><?= h($users->token_expires) ?></td>
                <td><?= h($users->token) ?></td>
                <td><?= h($users->is_phone_verified) ?></td>
                <td><?= h($users->is_email_verified) ?></td>
                <td><?= h($users->activation_date) ?></td>
                <td><?= h($users->avatar) ?></td>
                <td><?= h($users->active) ?></td>
                <td><?= h($users->is_super_user) ?></td>
                <td><?= h($users->group_id) ?></td>
                <td><?= h($users->role) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
	</div>
</div>