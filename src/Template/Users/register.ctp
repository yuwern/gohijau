    <div class="container contact_form">
      <div class="row col-md-7">
		<h2>Have a question?</h2>
		<p>Contact lorem ipsum dolor sit amet,</p>
		<p>consectetur adipiscing elit, sed do eiusmod</p>
		<div class="contact_info">
		<p><span>HOTLINE</span>  <a href="tel:+603 8888 9999" title="Call" class="tel">+603 8888 9999</p>
		<p><span>EMAIL</span> <a href="mailto:askme@gohijau.my" title="askme@gohijau.my">askme@gohijau.my</a></p>
		</div>
		<div>
			<br/ >
			<?= $this->Flash->render() ?>

			<?= $this->Form->create($user, ['class' =>'form-horizontal', 'context' => ['validator' => 'register']]); ?>
			  <div class="form-group">
				<label for="name" class="col-sm-5 control-label">Name</label>
				<div class="col-sm-7">
				  <input type="text" name="username" required class="form-control" value="<?php echo $user->username;?>" id="username" placeholder="">
					<?php
					if ($this->Form->isFieldError('username')) {
						echo $this->Form->error('username');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="account_qualifiers" class="col-sm-5 control-label">Account qualifiers</label>
				<div class="col-sm-7">
				  <input type="text" class="form-control" name="account_qualifiers" id="account_qualifiers" value="<?php echo $user->account_qualifiers;?>" placeholder="* For nominee account">
					<?php
					if ($this->Form->isFieldError('account_qualifiers')) {
						echo $this->Form->error('account_qualifiers');
					} 
					?>
					</div>
			  </div>
			  <div class="form-group">
				<label for="activation_key" class="col-sm-5 control-label">Activation Key</label>
				<div class="col-sm-7">
				  <input type="text" class="form-control" required name="activation_key" id="activation_key" value="<?php echo $user->activation_key;?>"  placeholder="* 8 digits registration letter">
					<?php
					if ($this->Form->isFieldError('activation_key')) {
						echo $this->Form->error('activation_key');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="cds_acc_no" class="col-sm-5 control-label">CDS Acc. No.</label>
				<div class="col-sm-7">
				  <input type="text" class="form-control" required name="cds_acc_no" id="cds_acc_no" value="<?php echo $user->cds_acc_no;?>"  placeholder="">
					<?php
					if ($this->Form->isFieldError('cds_acc_no')) {
						echo $this->Form->error('cds_acc_no');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="company_reg_no" class="col-sm-5 control-label">I.C. / Company Reg. No.</label>
				<div class="col-sm-7">
				  <input type="text" class="form-control" name="company_reg_no" value="<?php echo $user->company_reg_no;?>" id="company_reg_no" placeholder="">
					<?php
					if ($this->Form->isFieldError('company_reg_no')) {
						echo $this->Form->error('company_reg_no');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<label for="email" class="col-sm-5 control-label">Email</label>
				<div class="col-sm-7">
				  <input type="email" class="form-control" required name="email" id="email" value="<?php echo $user->email;?>" placeholder="">
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
				  <input type="text" class="form-control sm_box" name="country_phone_no"  value="<?php echo $user->country_phone_no;?>" id="country_phone_no" placeholder="+60">
				  <input type="text" class="form-control md_box" required name="phone" id="phone"  value="<?php echo $user->phone;?>"  placeholder="">
					<?php
					if ($this->Form->isFieldError('phone')) {
						echo $this->Form->error('phone');
					} 
					?>
				</div>
			  </div>
			  <?php if(!empty($this->request->data['already_exist'])):?>
				  <div class="form-group">
					<div class="col-sm-offset-5 col-sm-7">
					  <input type="submit" name="button" class="btn btn-default" title="Proceed" value="Proceed" />
					</div>
				  </div>
				<?php else:?>
				  <div class="form-group">
					<div class="col-sm-offset-5 col-sm-7">
					  <input type="submit"  name="button" class="btn btn-default" title="Send now" value="Send now" />
					</div>
				  </div>
				<?php endif;?>
			<?= $this->Form->end() ?>
		</div>
      </div><!-- /.row -->
	</div>
	<!-- /.container -->
