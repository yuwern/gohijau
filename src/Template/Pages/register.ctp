<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<!DOCTYPE html>
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
   <body role="document" class="wrapper_bg">
	<div class="bg">
	<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse contact_bg">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <?php echo $this->Html->link(
								$this->Html->image('logo.png'), array(
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
            <li>
			<?php echo $this->Html->link(
										'HOME',
										array(
											'controller'=>'Pages',
											'action'=>'home',
											
										),
										array(
											'rel'=>'tooltip',
											'escape'=>false  //NOTICE THIS LINE ***************
										)
									); ?>
			</li>
            <li ><?php echo $this->Html->link(
										'ABOUT',
										array(
											'controller'=>'Pages',
											'action'=>'home',
											'about'
											
										),
										array(
											'rel'=>'tooltip',
											'escape'=>false  //NOTICE THIS LINE ***************
										)
									); ?></li>
            <li>
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
            <li >
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
											); ?></li>
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
					<a class="help-block" href="#" title="Forget Password">*Forget Password</a>
				  </div>
				  <div class="text-center">
				  <button type="submit" class="btn btn-default" title="Sign In">Sign In</button>
				  </div>
				</form>
              </ul>
            </li>
            <li class="active"><a href="#" title="Register" class="reg">REGISTER</a></li>
			 <li class="has-sub search">
					<div class="head-search">
						<form id="header-search" action="#">
							<input type="search" name="s" id="s" placeholder="Search" title="search">
						</form>
					</div>
                  </li>
          </ul>
		
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	</header>

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
		<?= $this->Form->create($page) ?>
			<form class="form-horizontal"> 
			  <div class="form-group">
				 <label for="inputtext1" class="col-sm-5 control-label">Name</label>
						    <div class="col-sm-7">
								<?php echo $this->Form->input('name', array(
										'class' => 'form-control',
										'id' => 'inputtext1',
										'div'=>false,
										'label'=>false
									));?>						  
							</div>
				</div>
			  <div class="form-group">
				<label for="inputtext2" class="col-sm-5 control-label">Account qualifiers</label>
							<div class="col-sm-7">
								<?php echo $this->Form->input('account_qualifiers', array(
										'class' => 'form-control',
										'id' => 'inputtext2',
										'div'=>false,
										'label'=>false,
										'placeholder' =>"* For nominee account",
									));?>						  
							</div>
				  
			  </div>
			  <div class="form-group">
				<label for="inputtext3" class="col-sm-5 control-label">Activation Key</label>
							<div class="col-sm-7">
								<?php echo $this->Form->input('activation_key', array(
										'class' => 'form-control',
										'id' => 'inputtext3',
										'div'=>false,
										'label'=>false,
										'placeholder' =>"* 8 digits registration letter",
									));?>						  
							</div>
			  </div>
			  <div class="form-group">
				<label for="inputtext4" class="col-sm-5 control-label">CDS Acc. No.</label>
							<div class="col-sm-7">
								<?php echo $this->Form->input('cd_acc_no', array(
										'class' => 'form-control',
										'id' => 'inputtext4',
										'div'=>false,
										'label'=>false,
										'placeholder' =>"",
									));?>						  
							</div>
			  </div>
			  <div class="form-group">
				<label for="inputtext5" class="col-sm-5 control-label">I.C. / Company Reg. No.</label>
							<div class="col-sm-7">
								<?php echo $this->Form->input('company_no', array(
										'class' => 'form-control',
										'id' => 'inputtext5',
										'div'=>false,
										'label'=>false,
										'placeholder' =>"",
									));?>						  
							</div>
			  </div>
			  <div class="form-group">
				<label for="inputtext6" class="col-sm-5 control-label">Email</label>
							<div class="col-sm-7">
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
				<label for="inputtext7" class="col-sm-5 control-label">Phone</label>
				<div class="col-sm-7">
				  <input type="number" class="form-control sm_box" id="inputtext7" placeholder="">
				  <input type="number" class="form-control md_box" id="inputtext7" placeholder="">
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-5 col-sm-7">
				
				<?php echo $this->Form->submit('Send now',array('class' => 'btn btn-default', 'title' => 'Send now')); ?>
				<?= $this->Form->end() ?>
				  
				</div>
			  </div>
			</form>
		</div>
      </div><!-- /.row -->



 </div><!-- /.container -->
      <!-- FOOTER -->
      <footer>
	  <div class="container">
        <p><a href="#" title="ABOUT GOHIJAU">ABOUT GOHIJAU</a></p>
	</div>
      </footer>
	<div class="container foot">
	   <p>COPYRIGHT &copy; 2015 GOHIJAU SDN BHD (888999-M). ALL RIGHTS RESERVED <span class="ML15">|</span> 
	   
	   
	   <?php echo $this->Html->link(
	'PRIVACY POLICY',
    array(
        'controller'=>'Pages',
        'action'=>'home',
        'privacy'
    ),
    array(
        'rel'=>'tooltip',
        'escape'=>false  //NOTICE THIS LINE ***************
    )
); ?>
	   
	   
	   |   <?php echo $this->Html->link(
	'TERMS &amp; CONDITIONS',
    array(
        'controller'=>'Pages',
        'action'=>'home',
        'terms'
    ),
    array(
        'rel'=>'tooltip',
        'escape'=>false  //NOTICE THIS LINE ***************
    )
); ?></p>
	</div>
   
</div>
	<?php echo $this->Html->script('../front_end/js/jquery.min.js');?>
	<?php echo $this->Html->script('../front_end/js/bootstrap.min.js');?>
	   <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<?php echo $this->Html->script('../front_end/js/ie10-viewport-bug-workaround.js');?>


  </body>
</html>

