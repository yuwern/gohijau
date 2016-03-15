<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        GoHijau - <?= $this->fetch('title') ?>
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
<body>
	<?php if($this->request->params['controller'] == 'Pages'  && $this->request->params['action'] == 'home'):?>
		<?= $this->element('header_home'); ?>
	<?php else:?>
		<?= $this->element('header'); ?>
	<?php endif; ?>
    
    <?= $this->fetch('content') ?>
 <footer>
	  <div class="container">
	  
	 
	 
        <p>
			<?php if($this->request->session()->read('Auth.User.username')) { ?>
			
			<?php } else { ?>
			 <?php echo $this->Html->link('GET AN ACCOUNT TODAY',['controller'=>'Users','action'=>'login'],['rel'=>'tooltip','escape'=>false]); ?>
			<?php } ?>
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
