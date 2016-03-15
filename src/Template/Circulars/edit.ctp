
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Edit Circular') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($circular, ['type' => 'file']) ?>

			<?php
            //echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('name', ['label'=>'Circular Name']);
            echo $this->Form->input('company_name');
            echo $this->Form->input('circular_year',['class'=>'datepicker-default form-control datepickermonth', 'label'=>'Annual report Year']);

            echo $this->Form->input('subject');
			?>
			<div class="form-group text required">
				<label>Share Holder File : </label>
				<?php
					echo $this->Html->link('Share Holder File', '/files/AnnualReports/shareholder_file_path/'. $circular->shareholder_list_file).' <br />';
				?>
				<label>Report PDF File : </label>
				<?php
					echo $this->Html->link('Report Pdf File', '/files/AnnualReports/report_pdf_file_path/'. $circular->report_pdf);
				?>
			</div>
		<?php echo $this->Form->input('content', ['label'=>'Description']); ?>
	
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

