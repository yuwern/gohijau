
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Add Contact') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($contact) ?>

        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('phone_no');
            echo $this->Form->input('message');
            echo $this->Form->input('status');
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

