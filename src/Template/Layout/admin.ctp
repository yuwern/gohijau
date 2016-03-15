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

$cakeDescription = 'Gohijau Admin';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?php
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Oswald:400,700,300');
		//echo $this->Html->css('../theme/vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css');
		echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css');
		echo $this->Html->css('../theme/vendors/lightbox/css/lightbox.css');
		echo $this->Html->css('../theme/vendors/iCheck/skins/all.css');
		echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.css');
		echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/css/bootstrap-datepicker.css');
		echo $this->Html->css('../theme/vendors/iCheck/skins/all.css');
		echo $this->Html->css('../theme/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css');
		echo $this->Html->css('../theme/css/pink-blue.css');
		echo $this->Html->css('../theme/css/style-responsive.css');
	?>
	 
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
	<script>
		var baseUrl = "<?php echo \Cake\Routing\Router::url('/', true); ?>";
	</script>
	<?php
		echo $this->Html->script('../theme/js/jquery-1.10.2.min.js');
		echo $this->Html->script('../theme/js/jquery-migrate-1.2.1.min.js');
		echo $this->Html->script('../js/jquery-ui.js');
		echo $this->Html->script('../theme/vendors/bootstrap/js/bootstrap.min.js');
		echo $this->Html->script('../theme/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js');
		echo $this->Html->script('../theme/js/html5shiv.js');
		echo $this->Html->script('../theme/js/respond.min.js');
		echo $this->Html->script('../theme/vendors/metisMenu/jquery.metisMenu.js');
		echo $this->Html->script('../theme/vendors/slimScroll/jquery.slimscroll.js');
		echo $this->Html->script('../theme/vendors/jquery-cookie/jquery.cookie.js');
		if(empty($this->plugin) || $this->plugin!='Acl'){
			echo $this->Html->script('../theme/vendors/iCheck/icheck.min.js');
		}
		echo $this->Html->script('../theme/vendors/iCheck/custom.min.js');
		echo $this->Html->script('../theme/vendors/jquery-news-ticker/jquery.news-ticker.js');
		echo $this->Html->script('../theme/js/jquery.menu.js');
		echo $this->Html->script('../theme/vendors/jquery-pace/pace.min.js');
		echo $this->Html->script('../theme/vendors/holder/holder.js');
		echo $this->Html->script('../theme/vendors/responsive-tabs/responsive-tabs.js');
		echo $this->Html->script('../theme/vendors/lightbox/js/lightbox.min.js');
		//echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/js/bootstrap-datepicker.js');
		echo $this->Html->script('../theme/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js');
		echo $this->Html->script('../theme/vendors/moment/moment.js');
		echo $this->Html->script('../theme/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js');
		echo $this->Html->script('../theme/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');
		echo $this->Html->script('../theme/js/main.js');
	?>
	<?php echo $this->CKEditor->loadJs(); ?>
    <?= $this->fetch('script') ?>
</head>
<body>

<!--BEGIN BACK TO TOP-->
	<a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP-->
	<?= $this->element('admin_topbar'); ?>
     <!--END TOPBAR-->
     <div id="wrapper">
		<?= $this->element('admin_sidemenu'); ?>
		
		<!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title"><?= $this->fetch('title')?></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
			<?= $this->Flash->render() ?>
			<?= $this->fetch('content') ?>
            </div>
			<!--END CONTENT-->
			<!--BEGIN FOOTER-->
            <div id="footer">
                <div class="copyright">&copy; Openwave Computing Services Pvt Ltd - <?= date('Y') ?></div>
            </div>
            <!--END FOOTER-->
		</div>
        <!--END PAGE WRAPPER-->
	</div>
</body>
</html>
