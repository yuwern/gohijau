    <div class="container contact_form">
      <div class="row col-md-7">
		<h2>Have a question?</h2>
		<p>Contact lorem ipsum dolor sit amet,</p>
		<p>consectetur adipiscing elit, sed do eiusmod</p>
		<div class="contact_info">
		<p><span>HOTLINE</span>  <a href="tel:+603 8888 9999" title="Call" class="tel">+603 8888 9999</p>
		<p><span>EMAIL</span> <a href="mailto:askme@gohijau.my" title="askme@gohijau.my">askme@gohijau.my</a></p>
		</div>
		<br />
			<?= $this->Flash->render() ?>
			<div class="row">
				<p style="line-height: 1;">One Time Password (OTP) has been sent to your mobile ******<?php echo substr($user->phone, -4);?>, please enter the same here to login.</p>
			</div>
		<div>
			<?= $this->Form->create($user, ['class' =>'form-horizontal', 'context' => ['validator' => 'register'], 'novalidate' => false]); ?>
			  <div class="form-group">
				<label for="otp_password" class="col-sm-5 control-label">Enter One Time Password</label>
				<div class="col-sm-7">
				  <input type="text" class="form-control" name="otp_password" id="otp_password" value="<?php echo $user->otp_password;?>"  placeholder="pass code">
					<?php
					if ($this->Form->isFieldError('otp_password')) {
						echo $this->Form->error('otp_password');
					} 
					?>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-5 col-sm-7">
				  <input type="submit" class="btn btn-default" title="Send now" value="Confirm" />
				</div>
			  </div>
			<?= $this->Form->end() ?>
		</div>
      </div><!-- /.row -->
	</div>
	<!-- /.container -->
