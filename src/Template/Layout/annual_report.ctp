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
        GoHijau:
        <?= $this->fetch('title') ?>
    </title>
    <!-- Bootstrap core CSS -->
   
	<?php echo $this->Html->css('../front_end/css/bootstrap.min'); ?>
	<?php echo $this->Html->css('../front_end/css/custom.css'); ?>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<?php echo $this->Html->css('zabuto_calendar.css'); ?>
	<?php echo $this->Html->css('../front_end/css/ie10-viewport-bug-workaround.css'); ?>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]> <?php echo $this->Html->script('../front_end/js/ie8-responsive-file-warning.js');?><![endif]-->
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
	<header class="head_bg">
		<?= $this->element('header'); ?>
		<div class="container"><h1 class="title">MY ACCOUNT</h1></div>
		
		<?= $this->element('sub_menu'); ?>
	</header>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
     <!-- FOOTER -->
      <footer>
	  <div class="container">
        <p>
			
			<?php echo $this->Html->link('ABOUT GOHIJAU',['controller'=>'Pages','action'=>'about'],['rel'=>'tooltip','escape'=>false]); ?>
		</p>
	</div>
      </footer>
	<div class="container foot">
	   <p>COPYRIGHT &copy; 2015 GOHIJAU SDN BHD (888999-M). ALL RIGHTS RESERVED <span class="ML15">|</span> <a <?php echo $this->Html->link('PRIVACY POLICY',['controller'=>'Pages','action'=>'home', 'privacy'],['rel'=>'tooltip','escape'=>false]); ?> | <a href="#" title="TERMS &amp; CONDITIONS">TERMS &amp; CONDITIONS</a></p>
	</div>
   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<?php echo $this->Html->script('../front_end/js/jquery.min.js');?>
	<?php echo $this->Html->script('../front_end/js/bootstrap.min.js');?>
	<?php echo $this->Html->script('zabuto_calendar.js');?>
	   <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<?php echo $this->Html->script('../front_end/js/ie10-viewport-bug-workaround.js');?>
    
	
	<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<script type="text/javascript">

$(document).ready(function() {
	$('.toggle').click(function(e) {
		e.preventDefault();
		var $this = $(this);
		if ($this.next().hasClass('show')) {
			$this.next().hide();
			$this.next().removeClass('show');
			$(this).addClass('plus');
			$(this).removeClass('minus');
		} else {
			$this.next().toggleClass('show');
			$this.parent().parent().find('li .inner').removeClass('show');
			$this.parent().parent().find('li a').removeClass('minus').addClass('plus');
			$this.parent().parent().find('li .inner').slideUp(0);
			$this.next().slideToggle(0);
			$(this).removeClass('plus');
			$(this).addClass('minus');
		}
	});
});

  </script>

	<script type="application/javascript">
		$(document).ready(function () {
			$("#date-popover").popover({html: true, trigger: "manual"});
			$("#date-popover").hide();
			$("#date-popover").click(function (e) {
				$(this).hide();
			});

			$("#my-calendar").zabuto_calendar({
				ajax: {
					url: "/gohijau/events/getEvents",
					modal: true
				},
				legend: [
					{type: "text", label: "Going", badge: "00"},
					{type: "block", label: "Not Going"}
				]
			});
		});
	</script>
  </body>

</html>
