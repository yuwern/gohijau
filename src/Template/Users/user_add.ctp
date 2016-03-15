<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Add Super User') ?></div>
				</div>
				<div class="portlet-body">
					<?= $this->Form->create($user) ?>
						<?php
							echo $this->Form->input('username');
							echo $this->Form->input('phone');
							echo $this->Form->input('email');
							echo $this->Form->input('password');
							echo $this->Form->input('first_name');
							echo $this->Form->input('last_name');
							echo $this->Form->input('active', ['type'=>'select', 'options'=>['1'=>'Yes', '0'=>'No']]);
						?>
					<?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
