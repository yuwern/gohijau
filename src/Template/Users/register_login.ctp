    <div class="container contact_form">
      <div class="row col-md-7">
		<h2>Login</h2>
		<div>
			<br/ >
			<?= $this->Flash->render() ?>

			<?= $this->Form->create($user, ['class' =>'form-horizontal', 'context' => ['validator' => 'register'], 'novalidate' => false]); ?>
			  <div class="form-group">
				<label for="email" class="col-sm-5 control-label">Email</label>
				<div class="col-sm-7">
				  <input readonly=readonly type="text" name="email" class="form-control" value="<?php echo $user->email;?>" id="email" placeholder="">
					<?php
					if ($this->Form->isFieldError('email')) {
						echo $this->Form->error('email');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="password" class="col-sm-5 control-label">Password</label>
				<div class="col-sm-7">
				  <input type="password" class="form-control" name="password" id="password" value="" placeholder="Enter Password">
					<?php
					if ($this->Form->isFieldError('password')) {
						echo $this->Form->error('password');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-5 col-sm-7">
				<button type="submit" class="btn btn-success">LogIn
								&nbsp;<i class="fa fa-chevron-circle-right"></i></button>
				</div>
			  </div>
			<?= $this->Form->end() ?>
		</div>
      </div><!-- /.row -->
	</div>
	<!-- /.container -->
