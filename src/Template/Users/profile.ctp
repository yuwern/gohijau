<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('My Profile') ?></div>
				</div>
				<div class="portlet-body">
				<?php echo $this->Form->create($user, ['type' => 'file']); ?>				
					
					<?php
						echo $this->Form->input('email');
						echo $this->Form->input('first_name');
						echo $this->Form->input('last_name');
						echo $this->Html->image('../files/Users/avatar/'. $user->avatar, ['width'=>'100px']);
					?>
					<?php echo $this->Form->input('avatar', ['type' => 'file']); ?>
					
					<?= $this->Form->button(__('Submit')) ?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
