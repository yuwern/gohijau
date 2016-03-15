<div class="col-lg-12">
	<div class="portlet box portlet-green">
		<div class="portlet-header">
			<div class="caption"><?= h($newsSnippet->title) ?></div>
		</div>
		<div class="portlet-body">
			<?= $this->Html->link(__('Edit News Snippet'), ['action' => 'edit', $newsSnippet->id], ['class'=>'btn btn-success']) ?>
			<?= $this->Form->postLink(__('Delete News Snippet'), ['action' => 'delete', $newsSnippet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $newsSnippet->id), 'class'=>'btn btn-danger']) ?> 
			<p>&nbsp;</p>
			<table class="table table-striped table-bordered detail-view">
				<tbody>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($newsSnippet->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($newsSnippet->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($newsSnippet->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $newsSnippet->status ? __('Yes') : __('No'); ?></td>
         </tr>     

		 <tr>
            <th><?= __('Content Type') ?></th>
            <td> <?= $this->Text->autoParagraph(h($newsSnippet->content_type)); ?></td>
         </tr>
		 <tr>
            <th><?= __('Content') ?></th>
            <td> <?= $this->Text->autoParagraph($newsSnippet->content); ?></td>
         </tr>
    </table>
</div>
	</div>
</div>