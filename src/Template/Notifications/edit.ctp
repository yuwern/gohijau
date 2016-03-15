
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Edit Notification') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($notification) ?>

        <?php
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('type');
            echo $this->Form->input('content');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('refer_id');
            echo $this->Form->input('status');
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

