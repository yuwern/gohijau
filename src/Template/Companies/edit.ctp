
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Edit Company') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($company, ['type' => 'file', 'novalidate' => true]) ?>

        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('stock_code');
            echo $this->Form->input('market');
            echo $this->Form->input('sector');
            echo $this->Form->input('website',array('value'=>'https://'));
			if(!empty($company->image_url)){
				echo "<img src='../../files/Companies/image_url/$company->image_url' class='img-thumbnail' width='304'>";
			}
            echo $this->Form->input('image_url', ['type' => 'file']); 
            echo $this->Form->input('description');
			echo $this->CKEditor->replace('description'); 
            echo $this->Form->input('address');
            echo $this->Form->input('phone_no');
            echo $this->Form->input('street');
            echo $this->Form->input('city');
            echo $this->Form->input('state');
            echo $this->Form->input('country');
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

