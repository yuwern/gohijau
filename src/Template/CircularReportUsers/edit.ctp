
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Edit Circular Report User') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($circularReportUser) ?>

        <?php
            echo $this->Form->input('circular_id', ['options' => $circulars]);
            echo $this->Form->input('passcode');
            echo $this->Form->input('user_pdf_file');
            echo $this->Form->input('broker_code');
            echo $this->Form->input('broker_type');
            echo $this->Form->input('name_of_broker');
            echo $this->Form->input('cds_ac_no');
            echo $this->Form->input('name_of_shareholders');
            echo $this->Form->input('account_qualifiers');
            echo $this->Form->input('icno');
            echo $this->Form->input('share_holdings');
            echo $this->Form->input('status');
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

