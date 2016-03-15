
	</header>
	<div class="container">
		<div class="row breadcrumb_sec">
			<div class="col-md-12">
				<ol class="breadcrumb">
				  <li><a href="#" title="My Account">My Account</a></li>
				  <li class="active">Circular View</li>
				</ol>
				<h6>WELCOME <?php echo $this->request->session()->read('Auth.User.username');?> :</h6>
			</div>
		</div>
	</div>
    <div class="container ">
	<div class="">
        <div class="col-md-8">
			 <div class="highlights MB30">
							 <hr>
			 <h5>Annual Report</h5>
				<h1><?= $circular->title; ?></h1>
				<h4 class="text-danger"><?= $circular->title; ?></h4>
				
				
				<table class="table custom_table">
					
					<tbody>
						
					<tr id="demo" class="eve_bg" aria-expanded="true">
							<td colspan="4">
								<div class="collapse_cont col-md-12">
									<div class="row">
										<div class="col-md-3 left_cont">
										<p><?php echo $this->Html->image("../files/Companies/image_url/".$circular->company->image_url,['width'=>'100px']);?></p>
										
										</div>
										<div class="col-md-7 right_cont">
												<p class="f10">NAME:<a>  <?= $circular->company['name']; ?></a></p>
												<p class="f10">STOCK CODE: <?= $circular->company['stock_code']; ?></p>
												<p class="f10">MARKET:<?= $circular->company['market']; ?></p>
												<p class="f10">SECTOR: <?= $circular->company->sector; ?></p>
												<p class="f10">WEBSITE: <a href="<?= $circular->company->website; ?>" title="VISIT OFFICIAL WEBSITE" target="_blank">VISIT OFFICIAL WEBSITE</a></p>
												<p class="f10">Year : <?= $circular->report_year;?></p>
										</div>
									</div>
								</div>
						  </td>
					  </tr>
					  
						
					</tbody>
					</table>
					<div class="col-md-12">
						<b><?= $circular->subject;?></b>
						<b><?= $circular->content;?></b>
						</div>
								
								<div class="col-md-12 eve_bg">
								<a href="<?= $this->Url->build('/annual_reports/report-download/'.$circular->id);?>"><p><?php echo $this->Html->image('../front_end/images/pdf.png');?></p>
								<div class="col-md-6 right_cont">
								<p class="f9"><?= $circular->name;?></p>
								</div>
								</a>
								</div>
				</div>
				
		</div>		
		
        <div class="col-md-4">
			<div class="note_tab">
					<h4>Related Announcements</h4>
					<div role="tabpanel" class="tab-pane active news" id="news">
					
						<?php 
						if(!empty($announcements)):
							foreach($announcements as $announcement): ?>
							<div class="news_sec">
								<div class="news_info col-md-8 col-sm-10">
									<p><b><?= $announcement->type; ?></b> <br /><?= $this->Text->truncate($announcement->content, 150, ['ellipsis' => '<a href="#" class="rmore" title="Read More">>> Read More</a>', 'exact' => false]) ?></p>
									<p><?= $announcement->date; ?></p>
								</div>
							</div>
						<?php endforeach;
						else:
							echo "<p>No realted annoucements found</p>";
						endif;
						?>
					</div>		
				</div>
			</div>
        </div>
		
      <!-- /END THE FEATURETTES -->

	</div><!-- /.container -->
 