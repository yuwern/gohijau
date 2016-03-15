<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($event->title) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id], ['class'=>'btn btn-success']) ?>
			<?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id), 'class'=>'btn btn-danger']) ?> 
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('Created By') ?></th>
            <td><?= $event->has('user') ? $this->Html->link($event->user->email, ['controller' => 'Users', 'action' => 'view', $event->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Company Name') ?></th>
            <td><?= h($event->company_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Year') ?></th>
            <td><?= h($event->year) ?></td>
        </tr>
        <tr>
            <th><?= __('Venue') ?></th>
            <td><?= h($event->venue) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($event->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Event Relationship To') ?></th>
                            <td>
				<?php if($event->report_type == 'AGM'): ?>
					<?= $this->Html->link($event->annual_report->name, ['controller' => 'annual_reports', 'action' => 'view', $event->annual_report->id])?>
				<?php else: ?>
					<?= $this->Html->link($event->circular->name, ['controller' => 'annual_reports', 'action' => 'view', $event->circular->id]) ?>
				<?php endif;?>
				</td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($event->date) ?></td>
        </tr>
        <tr>
            <th><?= __('Time') ?></th>
            <td><?= h($event->time) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($event->created) ?></td>
        </tr>
		<tr>
            <th><?= __('Event Type') ?></th>
            <td> <?= $this->Text->autoParagraph(h($event->event_type)); ?></td>
        </tr>
		<tr>
            <th><?= __('Report Type') ?></th>
            <td> <?= $this->Text->autoParagraph(h($event->report_type)); ?></td>
        </tr>
		<tr>
            <th><?= __('Descripiton') ?></th>
            <td> <?= $this->Text->autoParagraph($event->descripiton); ?></td>
        </tr>
    </table>
</div>
	</div>
</div>