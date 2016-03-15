<?php //print_r($announcements);?>
	</header>
	<div class="container">
		<div class="row breadcrumb_sec">
			<div class="col-md-12 col-xs-6">
				<ol class="breadcrumb">
				  <li><?= $this->Html->link('My Account',  ['controller' => 'users', 'action' => 'dashboard', '_full' => true], ['class' => 'button']);?></li>
				  <li class="active">Announcements</li>
				</ol>
			</div>
		</div>
	</div>
							
    <div class="container ">
<div class="panel panel-default eve_bg"> <div class="panel-body">
	<div class="col-md-12 ">
				<?php echo $this->Form->create('User', ['type'=>'get']);?>
				<div class="form-group text col-sm-6">
					<input type="text" name="keyword" value="<?php echo empty($this->request->query['keyword'])?'':$this->request->query['keyword'];?>" placeholder="Keyword" class="form-control " id="keyword">
				</div>
				<div class="form-group select  col-sm-3">
				<?php
					echo $this->Form->select('year', [
						'2016'=>'2016','2015'=>'2015','2014'=>'2014','2013'=>'2013','2013'=>'2013'
					], ['empty'=>'All Years', 'value'=>empty($this->request->query['year'])?'':$this->request->query['year']]);
				?>
				</div>		
				<div class="form-group text  col-sm-3">
					<?php
						echo $this->Form->select(
							'category_type',
							['Annual Report'=>'Annual Report', 'Circular'=>'Circular', 'News'=>'News'],
							['empty' => 'All Categories', 'class'=>'form-control', 'value'=>empty($this->request->query['category_type'])?'':$this->request->query['category_type']]
						);
					?>
				</div>
			<div class="col-md-12 text-center">
				<?php
					echo $this->Form->button('Search', ['type' => 'submit',' class'=>'btn btn-success']);
				?>
			</div>
			<?php echo $this->Form->end();?>
		</div>
</div> </div>		
		<div class="row featurette account">
			<div class="col-md-12">
				 <div class="highlights">
					<table class="table custom_table">
						<thead>
						  <tr>
							<th>Date</th>
							<th>Details</th>
						  </tr>
						</thead>
						<tbody>
						<?php foreach ($announcements as $announcement): ?>
						<?php //print_R($announcement); ?>
						  <tr>
							<td><?php echo date('m/d/Y', strtotime($announcement->created)) ?></td>
							
							<td><a href="#demo<?= ($announcement->id) ?>" class="toggle plus" data-toggle="collapse"><?php echo(strip_tags($this->Text->truncate($announcement->content,50))); ?></a></td>
							
						  </tr>
						<tr id="demo<?= h($announcement->id) ?>" class="collapse demo">
								<td colspan="4">
									<div class="collapse_cont col-md-12">
										<div class="row">
												<div class="col-md-5 left_cont">
												<p><?php echo $this->Html->image('../front_end/images/sime_darby.png');?></p>
													COMPANY NAME: <?= $announcement->annual_report->company_name; ?><br/>
													REPORT TYPE:<?= $announcement->category_type; ?><br/>
													REPORT YEAR:<?= $announcement->annual_report->report_year; ?><br/>
													DATE: <?php echo date('m-d-Y', strtotime($announcement->created)) ?><br/>
													
													WEBSITE: <a href="#" title="VISIT OFFICIAL WEBSITE" target="_blank">VISIT OFFICIAL WEBSITE</a>
												</div>
												<div class="col-md-7 right_cont">
												<?= $announcement->content; ?>
												</div>
										</div>
									</div>
							  </td>
							</tr>
						  <?php endforeach; ?> 
						</tbody>
					</table>
				 </div>
			</div>
		</div>
		
      <!-- /END THE FEATURETTES -->

	</div><!-- /.container -->
 