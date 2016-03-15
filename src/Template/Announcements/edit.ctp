
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Edit Announcement') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($announcement, ['type' => 'file']) ?>

        <?php
            echo $this->Form->input('related_id', ['options' => $annualReports]);
            echo $this->Form->input('category_type');
            echo $this->Form->input('date');
            echo $this->Form->input('title');
		?>
			<div class="form-group text">
				<?php
					echo $this->Form->input('attachment', ['type' => 'file', 'label'=>'Attachment']);
					if(!empty($announcement->attachment))
						echo $this->Html->link('Attachment File', '/files/Announcement/attachment/'. $announcement->attachment).' <br />';
				?>
			</div>
		<?php
			echo $this->Form->input('content');
			echo $this->CKEditor->replace('content');
            echo $this->Form->input('status', ['type'=>'select', 'options'=>['1'=>'Yes', '0'=>'No']]);
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

