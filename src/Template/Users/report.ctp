
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Select Report') ?></div>
				</div>
				<div class="portlet-body events">
				
    <?= $this->Form->create('User', ['type'=>'get']) ?>
		<div class="form-group">
			<label class="col-md-4 control-label">1. Select Report Type</label>
			<div class="col-md-12">
				<div class="checkbox">
						<?php echo $this->Form->input('active_users', array(
								  'label' => 'List of all Active users',
                                  'type'=>'checkbox', 
								  'value' =>'active_users',
								  'checked' =>empty($this->request->query['active_users'])?'':'checked',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
					) ); ?>
							<?php echo $this->Form->input('verfied_users', array(
                                  'label' => 'List of all Verified users',  
								  'type'=>'checkbox', 
								  'checked' =>empty($this->request->query['verfied_users'])?'':'checked',
								  'value' =>'verfied_users',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
					) ); ?>
							<?php echo $this->Form->input('user_logins', array(
                                  'label' => 'User Login all',  
								  'checked' =>empty($this->request->query['user_logins'])?'':'checked',
                                  'type'=>'checkbox', 
								  'value' =>'user_logins',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
					) ); ?>
						<?php echo $this->Form->input('rsvp', array(
                                  'label' => 'RSVP List for Event',  
								  'checked' =>empty($this->request->query['rsvp'])?'':'checked',
                                  'type'=>'checkbox', 
								  'value' =>'rsvp',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
					) ); ?>
					<?php echo $this->Form->input('list_of_users_report', array(
								  'label' => ' List of users READ Electronic Report - Annual Report',
                                  'type'=>'checkbox', 
								  'checked' =>empty($this->request->query['list_of_users_report'])?'':'checked',
								  'value' =>'list_of_users_report',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
					) ); ?>
					<?php echo $this->Form->input('downloads_of_users_report', array(
								  'label' => 'List of users Downloaded Electronic Report - Annual Report',
								  'checked' =>empty($this->request->query['downloads_of_users_report'])?'':'checked',
                                  'type'=>'checkbox',
								  'value' =>'downloads_of_users_report',								  
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
					) ); ?>
				<?php echo $this->Form->input('readed_report', array(
								  'label' => 'List of users READ Electronic Report - Circular',
								  'checked' =>empty($this->request->query['readed_report'])?'':'checked',
                                  'type'=>'checkbox', 
								  'value' =>'readed_report',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
				) ); ?>
				  <?php echo $this->Form->input('downloaded_report', array(
							'label'=>' List of users Downloaded Electronic Report - Circular',
								  'checked' =>empty($this->request->query['downloaded_report'])?'':'checked',
							'value' =>'downloaded_report',
						  'type'=>'checkbox', 
						  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
				  ) ); ?>
				</div>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="jsevent" style="<?php echo (!empty($this->request->query['rsvp']))?'display:block':'display:none';?>">
			<?php
				echo $this->Form->input('company_id', ['type'=>'select','empty'=>'Please Select','id'=>'report-company-name', 'value'=>empty($this->request->query['company_id'])?'':$this->request->query['company_id']]);
				echo $this->Form->input('year', ['type'=>'select', 'id'=>'reportyear', 'value'=>empty($this->request->query['year'])?'':$this->request->query['year']]);
				echo $this->Form->input('event_id_new', ['type'=>'select', 'options'=>!empty($reports)?$reports:'','id'=>'eventslist', 'value'=>empty($this->request->query['event_id_new'])?'':$this->request->query['event_id_new']]);
			?>
		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="report" style="<?php echo (!empty($this->request->query['readed_report']) || !empty($this->request->query['downloaded_report']) || !empty($this->request->query['downloads_of_users_report']) || !empty($this->request->query['list_of_users_report']))?'display:block':'display:none';?>">
        <?php    
			echo $this->Form->input('company_name', ['type'=>'select', 'options'=>!empty($companies)?$companies:'', 'id'=>'event-company-name', 'value'=>empty($this->request->query['company_name'])?'':$this->request->query['company_name']]);
			echo $this->Form->input('year', ['type'=>'select', 'id'=>'eventyear', 'value'=>empty($this->request->query['year'])?'':$this->request->query['year']]);
			echo $this->Form->input('report_id', ['type'=>'select', 'value'=>empty($this->request->query['report_id'])?'':$this->request->query['report_id']]);
        ?>
		<?php if((!empty($this->request->query['downloads_of_users_report']) || !empty($this->request->query['list_of_users_report']))):?>
			<input type="hidden" value="AGM" name="report_type" class="form-control " id="report-type">
		<?php endif;?>		
		
		<?php if(!empty($this->request->query['readed_report']) || !empty($this->request->query['downloaded_report'])):?>
			<input type="hidden" value="EGM" name="report_type" class="form-control " id="report-type">
		<?php endif;?>
		</div>
    <?= $this->Form->button(__('Generate Report'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>

				<?php if(!empty($this->request->query)):?>
				<div class="table">
	<div class="pull-right">
			<?= $this->Html->link(__('Export Excel'), ['action' => 'report', 'type'=>'excel',  '?' =>$this->request->query], ['class'=>'btn btn-warning']) ?> 
			<?= $this->Html->link(__('Export PDF'), ['action' => 'report', 'type'=>'pdf',  '?' =>$this->request->query], ['class'=>'btn btn-warning']) ?> 
		</div>
				<table class="table table-striped table-bordered">
					<?php if(!empty($users)): ?>
					<thead>
						<tr>
							<th><?= $this->Paginator->sort('username') ?></th>
							<th><?= $this->Paginator->sort('email') ?></th>
							<th><?= $this->Paginator->sort('phone') ?></th>
							<th><?= $this->Paginator->sort('activated_date') ?></th>
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
						<tr>
							<td><?= h($user->username) ?></td>
							<td><?= h($user->email) ?></td>
							<td><?= h($user->phone) ?></td>
							<td><?= h($user->activated_date) ?></td>
							<td class="actions">
								<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $user->id], ['escape'=>false]) ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<?php elseif(!empty($events)):?>
						<thead>
						<tr>
							<th><?= $this->Paginator->sort('username') ?></th>
							<th><?= $this->Paginator->sort('email') ?></th>
							<th><?= $this->Paginator->sort('phone') ?></th>
							<th><?= $this->Paginator->sort('activated_date') ?></th>
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($events as $event): ?>
						<tr>
							<td><?= h($event->user->username) ?></td>
							<td><?= h($event->user->email) ?></td>
							<td><?= h($event->user->phone) ?></td>
							<td><?= h($event->user->activated_date) ?></td>
							<td class="actions">
								<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $event->user->id], ['escape'=>false]) ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>	<?php elseif(!empty($user_logins)):?>
						<thead>
						<tr>
							<th><?= $this->Paginator->sort('email') ?></th>
							<th><?= $this->Paginator->sort('date') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($user_logins as $user_login): ?>
						<tr>
							<td><?= h($user_login->user->email) ?></td>
							<td><?= h($user_login->created) ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>	<?php elseif(!empty($circulars)):?>
						<thead>
						<tr>
							<th><?= $this->Paginator->sort('username') ?></th>
							<th><?= $this->Paginator->sort('email') ?></th>
							<th><?= $this->Paginator->sort('phone') ?></th>
							<th><?= $this->Paginator->sort('activated_date') ?></th>
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($circulars as $circular): ?>
						<tr>
							<td><?= h($circular->user->username) ?></td>
							<td><?= h($circular->user->email) ?></td>
							<td><?= h($circular->user->phone) ?></td>
							<td><?= h($circular->user->activated_date) ?></td>
							<td class="actions">
								<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $circular->user->id], ['escape'=>false]) ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>	
					<?php elseif(!empty($reports)):?>
						<thead>
						<tr>
							<th><?= $this->Paginator->sort('username') ?></th>
							<th><?= $this->Paginator->sort('email') ?></th>
							<th><?= $this->Paginator->sort('phone') ?></th>
							<th><?= $this->Paginator->sort('activated_date') ?></th>
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($reports as $report): ?>
						<tr>
							<td><?= h($report->user->username) ?></td>
							<td><?= h($report->user->email) ?></td>
							<td><?= h($report->user->phone) ?></td>
							<td><?= h($report->user->activated_date) ?></td>
							<td class="actions">
								<?= $this->Html->link('<span class="glyphicon glyphicon-eye-open"></span>', ['action' => 'view', $report->user->id], ['escape'=>false]) ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>					<?php endif;?>
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
				<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>

