<?= $this->Form->create() ?>
	<div class="header-content"><h1>Admin LogIn</h1></div>
	<div class="body-content">
		<?= $this->Flash->render('auth') ?>
		<div class="form-group">
			<div class="input-icon right"><i class="fa fa-user"></i><input type="text" placeholder="Email" name="email" class="form-control"></div>
		</div>
		<div class="form-group">
			<div class="input-icon right"><i class="fa fa-key"></i><input type="password" placeholder="Password" name="password" class="form-control"></div>
		</div>
		<div class="form-group pull-left">
			<div class="checkbox-list"><label>&nbsp;
				</label></div>
		</div>
		<div class="form-group pull-right">
			<button type="submit" class="btn btn-success">LogIn
				&nbsp;<i class="fa fa-chevron-circle-right"></i></button>
		</div>
		<div class="clearfix"></div>
	</div>
<?= $this->Form->end() ?>