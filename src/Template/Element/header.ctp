<header class="head_bg">
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		    <?php echo $this->Html->link($this->Html->image('logo_v2.png'), ['controller'=>'Pages', 'action'=>'home'], ['class' => 'navbar-brand', 'escape' => false]);?>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li class="<?php echo ($this->request->params['controller'] == 'Pages' && $this->request->params['action'] == 'home')?'active':''; ?>">
				<?php echo $this->Html->link('HOME',['controller'=>'Pages','action'=>'home'],['rel'=>'tooltip','escape'=>false]); ?>
			</li>
			<li class="<?php echo ($this->request->params['controller'] == 'Pages' && $this->request->params['action'] == 'about')?'active':''; ?>">
				<?php echo $this->Html->link('ABOUT',['controller'=>'Pages','action'=>'about'],['rel'=>'tooltip','escape'=>false]); ?>
			</li>
			<li class="<?php echo ($this->request->params['controller'] == 'Pages' && $this->request->params['action'] == 'features')?'active':''; ?>">
				<?php echo $this->Html->link('FEATURES',['controller'=>'Pages','action'=>'features'],['rel'=>'tooltip','escape'=>false]); ?>
			</li>
			<li class="<?php echo ($this->request->params['controller'] == 'Contacts' && $this->request->params['action'] == 'contactUs')?'active':''; ?>">
				<?php echo $this->Html->link('CONTACT',['controller'=>'contacts','action'=>'contact-us'],['rel'=>'tooltip','escape'=>false]); ?>
			</li>
			<?php $verify_login =  $this->request->session()->read('Auth.User.id');?>
			<?php if(!empty($verify_login)) { ?>
			<li>
				<?php echo $this->Html->link('Logout',['controller'=>'users','action'=>'logout'],['rel'=>'tooltip','escape'=>false]); ?>
			</li>
			<li>
				<?php echo $this->Html->link('My Account',['controller'=>'users','action'=>'dashboard'],['class'=>'reg', 'rel'=>'tooltip', 'escape'=>false]); ?>
			</li>
			<?php } else { ?>
			<li class="dropdown">
              <a href="#" title="Sign In" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SIGN IN </a>
              <ul class="dropdown-menu">
				<?= $this->Form->create('Users', [ 'url' => ['controller' => 'Users', 'action' => 'login']]) ?>
				  <div class="form-group">
					<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
				  </div>
				  <div class="form-group">
					<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				  </div>
				  <div class="form-group">
				  <?php echo $this->Html->link('*Forgot password',['controller'=>'users','action'=>'forgotPassword'],['rel'=>'tooltip','escape'=>false,'class'=>'help-block']); ?>
				  </div>
				  <div class="text-center">
				  <button type="submit" class="btn btn-default" title="Sign In">Sign In</button>
				  </div>
				</form>
              </ul>
            </li>
            <li>
				<?php echo $this->Html->link('REGISTER',['controller'=>'users','action'=>'register'],['class'=>'reg', 'rel'=>'tooltip', 'escape'=>false]); ?>
			</li>
			<?php } ?>
			<li class="has-sub search">
				<div class="head-search">
					<form id="header-search" action="#">
						<input type="search" name="s" id="s" placeholder="Search" title="search">
					</form>
				</div>
            </li>
          </ul>
        </div>
      </div>
    </nav>