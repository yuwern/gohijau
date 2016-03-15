<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Create New Annual Report') ?></div>
				</div>
				<div class="portlet-body">
				  
    <?= $this->Form->create('', ['type' => 'file']) ?>

        <?php
            //echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('name', ['label'=>'Annual Report Name']);
            echo $this->Form->input('company_name');
			
            echo $this->Form->input('report_year',['class'=>'datepicker-default form-control datepickermonth', 'label'=>'Annual report Year']);
            echo $this->Form->input('shareholder_file_path', ['type' => 'file', 'label'=>'Shareholder List File(xls, xlsx)']);
            echo $this->Form->input('report_pdf_file_path', ['type' => 'file', 'label'=>'Annual Report Pdf']);

            echo $this->Form->input('content', ['label'=>'Description']);
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>
	<?php echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js');?>
	<script type="application/javascript">
		$('body').block({ message: "<?php echo $total;?>" }); 
	</script>