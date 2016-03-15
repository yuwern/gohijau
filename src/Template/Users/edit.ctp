<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Edit User') ?></div>
				</div>
				<div class="portlet-body">
					<?= $this->Form->create($user) ?>
					<?php
						echo $this->Form->input('username');
						echo $this->Form->input('email');
						echo $this->Form->input('first_name');
						echo $this->Form->input('last_name');
						echo $this->Form->input('active', ['type'=>'select', 'options'=>['0'=>'No', '1'=>'Yes']]);
						echo $this->Form->input('group_id');
						//echo $this->Form->input('role', ['type'=>'select', 'options'=>['admin'=>'Super Admin', 'admin'=>'Admin']]);
					?>
					<?= $this->Form->button(__('Submit')) ?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
