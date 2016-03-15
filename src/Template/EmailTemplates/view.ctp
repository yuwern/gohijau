<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($emailTemplate->name) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Edit Email Template'), ['action' => 'edit', $emailTemplate->id], ['class'=>'btn btn-success']) ?>
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('From') ?></th>
            <td><?= h($emailTemplate->from) ?></td>
        </tr>
        <tr>
            <th><?= __('Reply To') ?></th>
            <td><?= h($emailTemplate->reply_to) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($emailTemplate->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Subject') ?></th>
            <td><?= h($emailTemplate->subject) ?></td>
        </tr>
        <tr>
            <th><?= __('Email Variables') ?></th>
            <td><?= h($emailTemplate->email_variables) ?></td>
        </tr>

		<tr>
            <th><?= __('Description') ?></th>
            <td><?= $this->Text->autoParagraph(($emailTemplate->description)) ?></td>
        </tr>
		<tr>
            <th><?= __('Email Content') ?></th>
            <td><?= $this->Text->autoParagraph(($emailTemplate->email_content)) ?></td>
        </tr>
    </table>
</div>
	</div>
</div>