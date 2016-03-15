
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Add Announcement') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($announcement, ['type' => 'file']) ?>

        <?php
            echo $this->Form->input('category_type',['type'=>'select', 'empty'=>'Please Select Type', 'options'=>['Annual Report'=>'Annual Report', 'Circular'=>'Circular']]);
            echo $this->Form->input('related_id', ['options' => $annualReports]);
            echo $this->Form->input('date',['type'=>'text', 'class'=>'datetimepicker-date']);
            echo $this->Form->input('title');
            echo $this->Form->input('attachment', ['type' => 'file', 'label'=>'Attachment']);
            echo $this->Form->input('content');
			echo $this->CKEditor->replace('content');
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

