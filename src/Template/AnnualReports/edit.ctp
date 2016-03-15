
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Edit Annual Report') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($annualReport) ?>

        <?php
            //echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('name', ['label'=>'Annual Report Name']);
            echo $this->Form->input('company_name');
            echo $this->Form->input('report_year',['class'=>'datepicker-default form-control datepickermonth', 'label'=>'Annual report Year']);
            //echo $this->Html->link('Share Holder File', 'files/AnnualReports/shareholder_file_path/'. $annualReport->shareholder_file_path);
			//echo $this->Form->input('shareholder_file_path', ['type' => 'file', 'label'=>'Shareholder List File(xls, xlsx)']);
            //echo $this->Html->link('Report Pdf File', 'files/AnnualReports/report_pdf_file_path/'. $annualReport->report_pdf_file_path);
            //echo $this->Form->input('report_pdf_file_path', ['type' => 'file', 'label'=>'Annual Report Pdf']);
        ?>
			<div class="form-group text required">
				<label>Share Holder File : </label>
				<?php
					echo $this->Html->link('Share Holder File', '/files/AnnualReports/shareholder_file_path/'. $annualReport->shareholder_file_path).' <br />';
				?>
				<label>Report PDF File : </label>
				<?php
					echo $this->Html->link('Report Pdf File', '/files/AnnualReports/report_pdf_file_path/'. $annualReport->report_pdf_file_path);
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

