<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading"><h3><?= __('Pages') ?></h3></div>
			<div class="panel-body">
					<div class="search-form row">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php
						echo $this->Form->create();
						echo $this->Form->input('title', ['type'=>'text']);
					?>
					</div>
					<div class="clearfix pull-left search-button">
					<?php
						echo $this->Form->button('Filter', ['type' => 'submit',' class'=>'btn btn-success']);
						echo $this->Html->link('Reset', ['action' => 'index'], ['class'=>'btn btn-warning']);
					?>
					</div>
					<?php echo $this->Form->end();?>
				</div>		
	<div class="table">
	<p class="pull-right">
			<?= $this->Html->link(__('New Page'), ['action' => 'add'], ['class'=>'btn btn-success']) ?> </p>
				<table class="table table-striped table-bordered">
					<thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page): ?>
            <tr>
                <td><?= h($page->title) ?></td>
                <td><?= h($page->created) ?></td>
                <td><?= h($page->modified) ?></td>
               
                <td class="actions">
					<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $page->id], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $page->id], ['escape'=>false]) ?>
					<?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $page->id], ['escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $page->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="row">
		<div class="col-lg-6">
			<div class="pagination-panel">
				<?= $this->Paginator->counter(
					'Page {{page}} of {{pages}}, showing {{current}} records out of
					 {{count}} total'
				); ?>
			</div>
		</div>
		<div class="col-lg-6 text-right">
			<div class="pagination-panel">
				<ul class="pagination pagination-sm man">
					<?= $this->Paginator->prev('< ' . __('previous')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('next') . ' >') ?>
				</ul>
			</div>
		</div>
	</div>	
</div>
</div>
		</div>
	</div>
</div>