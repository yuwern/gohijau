
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Edit Page') ?></div>
				</div>
				<div class="portlet-body page">
				
    <?= $this->Form->create($page) ?>

        <?php
            echo $this->Form->input('slug');
            echo $this->Form->input('title');
            echo $this->Form->input('content');
			echo $this->CKEditor->replace('content'); 
            echo $this->Form->input('status');
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

