<!DOCTYPE html>
<html lang="en">
<head><title>Gohijau | Page Not Found</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <?= $this->Html->meta('icon') ?>

    <!--Loading bootstrap css-->
    <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <?php echo $this->Html->css('../theme/vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css');?>
    <?php echo $this->Html->css('../theme/vendors/font-awesome/css/font-awesome.min.css');?>
    <?php echo $this->Html->css('../theme/vendors/bootstrap/css/bootstrap.min.css');?>
    <?php echo $this->Html->css('../theme/vendors/animate.css/animate.css');?>
    <?php echo $this->Html->css('../theme/css/pink-blue.css');?>
    <?php echo $this->Html->css('../theme/css/style-responsive.css');?>
</head>
<body id="error-page" class="animated bounceInLeft">
<?= $this->fetch('content') ?>
<?php echo $this->Html->script('../theme/js/jquery-1.9.1.js');?>
<?php echo $this->Html->script('../theme/js/jquery-migrate-1.2.1.min.js');?>
<?php echo $this->Html->script('../theme/js/jquery-ui.js');?>
<?php echo $this->Html->script('../theme/vendors/bootstrap/js/bootstrap.min.js');?>
<?php echo $this->Html->script('../theme/vendors/bootstrap-hover-dropdown.js');?>
<?php echo $this->Html->script('../theme/js/html5shiv.js');?>
<?php echo $this->Html->script('../theme/js/respond.min.js');?>
</body>
</html>