
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Add Users Event') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($usersEvent) ?>

        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('event_id', ['options' => $events]);
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

