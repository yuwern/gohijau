
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Create New AGM/EGM') ?></div>
				</div>
				<div class="portlet-body events">
				
    <?= $this->Form->create($event) ?>
		<div class="form-group">
			<label class="col-md-3 control-label">Event Type</label>
			<div class="col-md-9">
				<div class="checkbox">
					<?php echo $this->Form->input('event_type', ['type'=>'radio', 'id'=>'event_type',  'label'=>false, 'options'=>['AGM'=>'AGM', 'EGM'=>'EGM']]);?>
				</div>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
        <?php
            echo $this->Form->input('company_name', ['type'=>'select','id'=>'event-company-name']);
            echo $this->Form->input('report_type', ['type'=>'hidden']);
			echo $this->Form->input('year', ['type'=>'select', 'id'=>'eventyear']);
            echo $this->Form->input('report_id', ['label' =>'Event Relationship to Annual Report or Circular', 'type'=>'select']);
            echo $this->Form->input('date', ['label' =>'Event Date', 'type'=>'text', 'class'=>'datetimepicker-date']);
			echo "<div style='clear:both'></div>";
            echo $this->Form->input('time', ['label' =>'Event Time', 'type'=>'text', 'class'=>'datetimepicker-time']);
            echo $this->Form->input('venue', ['label' =>'Event Venue']);
            echo $this->Form->input('title', ['label' =>'Event Title']);
            echo $this->Form->input('descripiton', ['label' =>'Event Description']);
			echo $this->CKEditor->replace('descripiton'); 
           // echo $this->Form->input('status');
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

