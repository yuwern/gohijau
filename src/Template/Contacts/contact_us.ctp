<div class="container"><h1 class="title"><?php echo $page->title; ?></h1></div>
	</header>
	<div class="container banner text-center">
	 <img src="<?php echo $this->request->webroot . 'front_end/images/features_banner.jpg'; ?>" alt="GoHijau" />

    </div>
	<div class="container contact_form">
      <div class="row">
		<div class="col-md-7">
		<?= $this->Flash->render('positive') ?>
		<?= $this->Flash->render() ?>
		<?= $this->Form->create($contact, ['class'=>'horizontal']) ?>
			<div class="form-group">
				<label for="inputtext1" class="col-sm-3 control-label">Name</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('name', array(
							'class' => 'form-control',
							'id' => 'inputtext1',
							'div'=>false,
							'label'=>false
						));?>						  
				</div>
			</div>

			  <div class="form-group">
				<label for="inputtext6" class="col-sm-3 control-label">Email</label>
					<div class="col-sm-9">
						<?php echo $this->Form->input('email', array(
								'class' => 'form-control',
								'id' => 'inputtext6',
								'div'=>false,
								'label'=>false,
								'placeholder' =>"",
							));?>						  
					</div>
			  </div>
			  <div class="form-group">
				<label for="inputtext7" class="col-sm-3 control-label">Phone</label>
				<div class="col-sm-9">
					<?php echo $this->Form->input('phone_no', array(
							'class' => 'form-control',
							'id' => 'inputtext7',
							'div'=>false,
							'label'=>false,
							'placeholder' =>"",
						));?>						  
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputtext7" class="col-sm-3 control-label">Message</label>
				<div class="col-sm-9">
					<?php echo $this->Form->textarea('message', ['rows' => '5', 'cols' => '10', 'style'=>'height:150px;']);?>						  
				</div>
			  </div>
			  
			  <div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
				
				<?php echo $this->Form->submit('Send now',array('class' => 'btn btn-default', 'title' => 'Send now')); ?>
				<?= $this->Form->end() ?>
				</div>
			  </div>
			</form>
		</div>
		<?php echo $page->content; ?>
      </div>
	  <!-- /.row -->
 </div>