<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($announcement->title) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Edit Announcement'), ['action' => 'edit', $announcement->id], ['class'=>'btn btn-success']) ?>
			<?= $this->Form->postLink(__('Delete Announcement'), ['action' => 'delete', $announcement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $announcement->id), 'class'=>'btn btn-danger']) ?> 
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $announcement->has('user') ? $this->Html->link($announcement->user->email, ['controller' => 'Users', 'action' => 'view', $announcement->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Annual Report') ?></th>
            <td><?= $announcement->has('annual_report') ? $this->Html->link($announcement->annual_report->name, ['controller' => 'AnnualReports', 'action' => 'view', $announcement->annual_report->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Category Type') ?></th>
            <td><?= h($announcement->category_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($announcement->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $announcement->status ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($announcement->date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($announcement->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($announcement->modified) ?></td>
        </tr>
		<tr>
            <th><?= __('Content') ?></th>
            <td><?= $this->Text->autoParagraph($announcement->content) ?></td>
        </tr>
    </table>
</div>
	</div>
</div>