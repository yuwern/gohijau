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

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        GoHijau - Login
    </title>
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
	
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>	
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Crimson+Text:400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
  </head>

  <body class="head_bg">
	<?= $this->element('header'); ?>
      <div class="container contact contact_form">
      <div class="col-md-5 col-sm-5">
		<h2>Forgot Password</h2>
	
		<div>
			<div class="col-sm-11">
			<?= $this->Flash->render() ?>
			<?= $this->Flash->render('auth') ?>
			</div>
			<?= $this->Form->create('Users', ['class'=>'form-horizontal', 'context' => ['validator' => 'reset']]) ?>
			  <div class="form-group">
				<div class="col-sm-11">
				  <input type="email" name="email" required class="form-control" id="inputtext1" placeholder="Email">
				<?php
					if ($this->Form->isFieldError('email')) {
						echo $this->Form->error('email');
					} 
					?>
				</div>
			  </div>
			 
			  
			  <div class="form-group">
				<div class="col-sm-11 text-center">
				  <input type="submit" class="btn btn-default" title="Send now" value="Send" />
				</div>
			  </div>
			<?= $this->Form->end() ?>
		</div>
      </div>
	  <div class="col-md-7 col-sm-7">
		<?= $this->Html->image('mac.png',['alt'=>'GoHijau', 'title'=>'GoHijau']) ?>
	  </div>
 </div><!-- /.container -->
 
      <!-- FOOTER -->
       <footer>
	  <div class="container">
        <p>
			
			<?php echo $this->Html->link('ABOUT GOHIJAU',['controller'=>'Pages','action'=>'about'],['rel'=>'tooltip','escape'=>false]); ?>
		</p>
	</div>
      </footer>
	<div class="container foot">
	   <p>COPYRIGHT &copy; 2015 GOHIJAU SDN BHD (888999-M). ALL RIGHTS RESERVED <span class="ML15">|</span> 
			<?php echo $this->Html->link('PRIVACY POLICY',['controller'=>'Pages','action'=>'privacy'],['rel'=>'tooltip','escape'=>false]); ?>
			|   
			<?php echo $this->Html->link('TERMS &amp; CONDITIONS',['controller'=>'Pages','action'=>'terms'],['rel'=>'tooltip','escape'=>false]); ?>
		</p>
	</div>
   

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<?php echo $this->Html->script('../front_end/js/jquery.min.js');?>
	<?php echo $this->Html->script('../front_end/js/bootstrap.min.js');?>
	   <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<?php echo $this->Html->script('../front_end/js/ie10-viewport-bug-workaround.js');?>
    
  </body>
</html>
