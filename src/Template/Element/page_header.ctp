<!DOCTYPE html>
<!--<html lang="en" class="bg">-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
   <link rel="icon" href="favicon.ico">

    <title>GoHijau</title>

    <!-- Bootstrap core CSS -->
   
	<?php echo $this->Html->css('../front_end/css/bootstrap.min'); ?>
	<?php echo $this->Html->css('../front_end/css/custom.css'); ?>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<?php echo $this->Html->css('../front_end/css/ie10-viewport-bug-workaround.css'); ?>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
   <?php echo $this->Html->script('../front_end/js/ie-emulation-modes-warning.js');?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Crimson+Text:400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
  </head>

  <body role="document">
	<header class="head_bg">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <?php echo $this->Html->link(
								$this->Html->image('logo_v2.png'), array(
																		'controller'=>'Pages',
																		'action'=>'home',
																		
																	), 
																	array(
																	'class' => 'navbar-brand',
																	'escape' => false)
							);?>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><?php echo $this->Html->link(
												'HOME',
												array(
													'controller'=>'Pages',
													'action'=>'home',
												),
												array(
													'rel'=>'tooltip',
													'escape'=>false  //NOTICE THIS LINE ***************
												)
											); ?></li>
            <li class="<?php echo ($this->request->params['pass'][0] == 'about')?'active':'inactive'; ?>">
			<?php echo $this->Html->link(
												'ABOUT',
												array(
													'controller'=>'Pages',
													'action'=>'home',
													'about',
												),
												array(
													'rel'=>'tooltip',
													'escape'=>false  //NOTICE THIS LINE ***************
												)
											); ?></li>
            <li class="<?php echo ($this->request->params['pass'][0] == 'feature')?'active':'inactive'; ?>">
			<?php echo $this->Html->link(
												'FEATURES',
												array(
													'controller'=>'Pages',
													'action'=>'home',
													'feature',
												),
												array(
													'rel'=>'tooltip',
													'escape'=>false  //NOTICE THIS LINE ***************
												)
											); ?></li>
            <li class="<?php echo ($this->request->params['pass'][0] == 'contact')?'active':'inactive'; ?>">
					<?php echo $this->Html->link(
												'CONTACT',
												array(
													'controller'=>'Pages',
													'action'=>'home',
													'contact',
												),
												array(
													'rel'=>'tooltip',
													'escape'=>false  //NOTICE THIS LINE ***************
												)
											); ?>
			<?php $verify_login =  $this->request->session()->read('Auth.User.id');?>
			<?php if(!empty($verify_login)) {?>
			<li class="<?php echo ($this->request->params['controller'] == 'contacts' && $this->request->params['action'] == 'index')?'active':'inactive'; ?>">
				<?php echo $this->Html->link('Logout',['controller'=>'users','action'=>'logout'],['rel'=>'tooltip','escape'=>false]); ?>
			</li>
			<li>
				<?php echo $this->Html->link('My Account',['controller'=>'users','action'=>'dashboard'],['class'=>'reg', 'rel'=>'tooltip', 'escape'=>false]); ?>
			</li>
			<?php } else { ?>
			<li class="dropdown">
              <a href="#" title="Sign In" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SIGN IN </a>
              <ul class="dropdown-menu">
				<form>
				  <div class="form-group">
					<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
				  </div>
				  <div class="form-group">
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				  </div>
				  <div class="form-group">
					<a class="help-block" href="#" title="Forget Password">*Forget Password</a>
				  </div>
				  <div class="text-center">
				  <button type="submit" class="btn btn-default" title="Sign In">Sign In</button>
				  </div>
				</form>
              </ul>
            </li>
            <li>
			<?php echo $this->Html->link(
										'REGISTER',
										array(
											'controller'=>'Pages',
											'action'=>'home',
											'register',
											
										),
										array(
											'class' => 'reg',
											'rel'=>'tooltip',
											'escape'=>false  //NOTICE THIS LINE ***************
										)
									); ?></li>
			 <li class="has-sub search">
					<div class="head-search">
						<form id="header-search" action="#">
							<input type="search" name="s" id="s" placeholder="Search" title="search">
						</form>
					</div>
                  </li>
			<?php } ?>
          </ul>
		
        </div><!--/.nav-collapse -->
      </div>
    </nav>