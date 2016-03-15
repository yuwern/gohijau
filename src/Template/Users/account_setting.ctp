<?php //print_r($user);?>
	</header>
	<div class="container">
		<div class="row breadcrumb_sec">
			<div class="col-md-12 col-xs-6">
				<ol class="breadcrumb">
				  <li><?= $this->Html->link('My Account',  ['controller' => 'users', 'action' => 'dashboard', '_full' => true], ['class' => 'button']);?></li>
				  <li class="active">Account Setting</li>
				</ol>
			</div>
		</div>
	</div>
					
   <div class="container contact_form">
      <div class="row col-md-7">
		<h3>EDIT PROFILE</h3>
		<hr>
		<div>
			<br/ >
			<?= $this->Flash->render('profile') ?>

			<?= $this->Form->create($user, ['class' =>'form-horizontal', 'context' => ['validator' => 'register'], 'novalidate' => false]); ?>
			  <div class="form-group">
				<label for="name" class="col-sm-5 control-label">Name</label>
				<div class="col-sm-7">
				  <input type="text"  name="username" required class="form-control" value="<?php echo $user->username;?>" id="username" placeholder="">
					<?php
					if ($this->Form->isFieldError('username')) {
						echo $this->Form->error('username');
					} 
					?>
				</div>
			  </div>
			
			
			
			  <div class="form-group">
				<label for="email" class="col-sm-5 control-label">Email</label>
				<div class="col-sm-7">
				  <input type="text" readonly class="form-control" required name="email" id="email" value="<?php echo $user->email;?>" placeholder="">
					<?php
					if ($this->Form->isFieldError('email')) {
						echo $this->Form->error('email');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="phone" class="col-sm-5 control-label">Phone</label>
				<div class="col-sm-7">
				  <input type="text" readonly class="form-control" required name="phone" id="phone12"  value="<?php echo $user->phone;?>"  placeholder="">
					<?php
					if ($this->Form->isFieldError('phone')) {
						echo $this->Form->error('phone');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-5 col-sm-7">
				  <input type="submit" name="button" class="btn btn-default" title="Send now" value="Update Profile" />
				</div>
			  </div>
			<?= $this->Form->end() ?>
		</div>
		<h3>CHANGE PASSWORD</h3>
		<hr>
		<div>
			<br/ >
			<?= $this->Flash->render('password') ?>
			<?= $this->Form->create($user, ['class' =>'form-horizontal', 'context' => ['validator' => 'reset']]); ?>
			  <div class="form-group">
				<label for="password" class="col-sm-5 control-label">Old Password</label>
				<div class="col-sm-7">
				  <input type="password" name="old_password" required class="form-control" value="" id="old_password" placeholder="">
					<?php
					if ($this->Form->isFieldError('old_password')) {
						echo $this->Form->error('old_password');
					} 
					?>
				</div>
			  </div>
			
			
			
			  <div class="form-group">
				<label for="new_password" class="col-sm-5 control-label">New Password</label>
				<div class="col-sm-7">
				  <input type="password" class="form-control" required name="new_password" id="new_password" value="" placeholder="">
					<?php
					if ($this->Form->isFieldError('new_password')) {
						echo $this->Form->error('new_password');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="confirm_password1" class="col-sm-5 control-label">Confirm Password</label>
				<div class="col-sm-7">
				  <input type="password" class="form-control" required name="confirm_password1" id="confirm_password1"  value=""  placeholder="">
					<?php
					if ($this->Form->isFieldError('confirm_password1')) {
						echo $this->Form->error('confirm_password1');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-5 col-sm-7">
				  <input type="submit"  name="button" class="btn btn-default" title="Send now" value="Change Password" />
				</div>
			  </div>
			<?= $this->Form->end() ?>
		</div>
      </div><!-- /.row -->
	  
	  
 </div>
 