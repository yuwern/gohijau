<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-green">
			<div class="panel-heading"><h3><?= __('Users Events') ?></h3></div>
			<div class="panel-body">
				<div class="usersEvents-search">
					<form id="w0" action="" method="get">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group field-search-title">
									<label class="control-label" for="search-title">Title</label>
									<input type="text" id="search-title" class="form-control" name="search[title]">
									<div class="help-block"></div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group field-search-content">
									<label class="control-label" for="search-content">Content</label>
									<input type="text" id="search-content" class="form-control" name="search[content]">

									<div class="help-block"></div>
								</div>	
							</div>
							<div class="col-md-4">
								<div class="form-group field-search-email">
									<label class="control-label" for="search-email">Email</label>
									<input type="text" id="search-email" class="form-control" name="search[email]">

									<div class="help-block"></div>
								</div>	
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Search</button>        
							<button type="reset" class="btn btn-default">Reset</button>   
						</div>
					</form>
				</div>		
	<div class="table">
	<p class="pull-right">
			<?= $this->Html->link(__('New Users Event'), ['action' => 'add'], ['class'=>'btn btn-success']) ?> </p>
				<table class="table table-striped table-bordered">
					<thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('event_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersEvents as $usersEvent): ?>
            <tr>
                <td><?= $this->Number->format($usersEvent->id) ?></td>
                <td><?= $usersEvent->has('user') ? $this->Html->link($usersEvent->user->email, ['controller' => 'Users', 'action' => 'view', $usersEvent->user->id]) : '' ?></td>
                <td><?= $usersEvent->has('event') ? $this->Html->link($usersEvent->event->title, ['controller' => 'Events', 'action' => 'view', $usersEvent->event->id]) : '' ?></td>
                <td><?= h($usersEvent->created) ?></td>
                <td><?= h($usersEvent->modified) ?></td>
                <td class="actions">
					<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $usersEvent->id], ['escape'=>false]) ?>
					<?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $usersEvent->id], ['escape'=>false]) ?>
					<?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $usersEvent->id], ['escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $usersEvent->id)]) ?>
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