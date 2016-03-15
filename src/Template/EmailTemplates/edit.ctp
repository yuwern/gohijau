
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Edit Email Template') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($emailTemplate) ?>

        <?php
            echo $this->Form->input('from');
            echo $this->Form->input('reply_to');
            echo $this->Form->input('subject');
            echo $this->Form->input('email_content');
            echo $this->Form->input('email_variables');
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

