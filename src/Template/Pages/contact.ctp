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
<?= $this->element('page_header'); ?>
<div class="container"><h1 class="title">Contact Us</h1></div>
	</header>
	<div class="container banner text-center">
	 <img src="<?php echo $this->request->webroot . 'front_end/images/features_banner.jpg'; ?>" alt="GoHijau" />

    </div>
	<?= $this->Flash->render('positive') ?>
			<div class="container contact_form">
      <div class="row">
		
		<div class="col-md-7">
		<?= $this->Form->create($page) ?>
			<form class="form-horizontal"> 
			  <div class="form-group">
				 <label for="inputtext1" class="col-sm-3 control-label">Name</label>
						    <div class="col-sm-9">
								<?php echo $this->Form->input('name', array(
										'class' => 'form-control',
										'id' => 'inputtext1',
										'div'=>false,
										'label'=>false
									));?>						  
							</div>
				</div>

			  <div class="form-group">
				<label for="inputtext6" class="col-sm-3 control-label">Email</label>
							<div class="col-sm-9">
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
				<label for="inputtext7" class="col-sm-3 control-label">Phone</label>
				<div class="col-sm-9">
								<?php echo $this->Form->input('phone', array(
										'class' => 'form-control',
										'id' => 'inputtext7',
										'div'=>false,
										'label'=>false,
										'placeholder' =>"",
									));?>						  
							</div>
			  </div>
			  <div class="form-group">
				<label for="inputtext7" class="col-sm-3 control-label">Message</label>
				<div class="col-sm-9">
								<?php echo $this->Form->textarea('textarea', ['rows' => '5', 'cols' => '5']);?>						  
							</div>
			  </div>
			  
			  <div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
				
				<?php echo $this->Form->submit('Send now',array('class' => 'btn btn-default', 'title' => 'Send now')); ?>
				<?= $this->Form->end() ?>
				  
				</div>
			  </div>
			</form>
		</div>
		<div class="col-md-4 col-md-offset-1">
		<div class="address_block">
            <h3>Contact Details</h3>
			<p class="bor"></p>
            <ul class="list-unstyled">
              <li><strong>Phone:</strong> +603 8888 9999  </li>
              <li><strong>Mobile:</strong> +603 8888 9999  </li>
              <li><strong>Email:</strong> <a href="mailto:askme@gohijau.my">askme@gohijau.my</a></li>
            </ul>
          </div>
		  <div><img src="<?php echo $this->request->webroot . 'front_end/images/map.JPG'; ?>" alt="GoHijau" /></div>
		</div>
      </div><!-- /.row -->



 </div>
	
 <?= $this->element('footer'); ?>
