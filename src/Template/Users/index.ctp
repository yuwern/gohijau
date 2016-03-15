<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading"><h3><?= __('Users') ?></h3></div>
			<div class="panel-body">
				<div class="search-form row">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php
						echo $this->Form->create();
						echo $this->Form->input('username', ['type'=>'text']);
						echo $this->Form->input('email', ['type'=>'text']);
						echo $this->Form->input('q',['label'=>'By Name']);
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
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><?= $this->Paginator->sort('username') ?></th>
							<th><?= $this->Paginator->sort('email') ?></th>
							<th><?= $this->Paginator->sort('phone') ?></th>
							<th><?= $this->Paginator->sort('group') ?></th>
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
						<tr>
							<td><?= h($user->username) ?></td>
							<td><?= h($user->email) ?></td>
							<td><?= h($user->phone) ?></td>
							<td><?= h($user->group->name) ?></td>
							<td class="actions">
								<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $user->id], ['escape'=>false]) ?>
								<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $user->id], ['escape'=>false]) ?>
								<?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $user->id], ['escape'=>false, 'confirm' => __('Are you sure you want to delete {0}?', $user->username)]) ?>
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
								<?= $this->Paginator->numbers() ?>
							</ul>
						</div>
					</div>
				</div>	
				</div>
			</div>
		</div>
	</div>
</div>

