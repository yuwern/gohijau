
<div class="users-create">
	<div class="row">
		<div class="col-lg-12">
			<div class="portlet box portlet-green">
				<div class="portlet-header">
					<div class="caption"><?= __('Edit Snippet') ?></div>
				</div>
				<div class="portlet-body">
				
    <?= $this->Form->create($newsSnippet, ['type' => 'file']) ?>

        <?php
            echo $this->Form->input('content_type', ['type'=>'select', 'prompt'=>'Please Select', 'options'=>['Annual Report'=>'Annual Report', 'Circular'=>'Circular']]);
            echo $this->Form->input('title');
			if(!empty($newsSnippet->image)){
				echo "<img src='../../files/NewsSnippets/image/$newsSnippet->image' class='img-thumbnail' width='304'>";
			}
            echo $this->Form->input('image',['type'=>'file' ,'required'=>false]);
            echo $this->Form->input('content');
			echo $this->CKEditor->replace('content'); 
           // echo $this->Form->input('status');
        ?>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
			</div>
		</div>
	</div>
</div>

