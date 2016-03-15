<?php //pr($annualReport); ?>
	</header>
	<div class="container">
		<div class="row breadcrumb_sec">
			<div class="col-md-12">
				<ol class="breadcrumb">
				  <li><a href="#" title="My Account">My Account</a></li>
				  <li class="active">Annual Report View</li>
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
				<h1><?= $annualReport->name; ?></h1>
				<h4 class="text-danger"><?= $annualReport->company_name; ?></h4>
				
				
				<table class="table custom_table">
					
					<tbody>
						
					<tr id="demo" class="eve_bg" aria-expanded="true">
							<td colspan="4">
								<div class="collapse_cont col-md-12">
									<div class="row">
										<div class="col-md-3 left_cont">
										<p><?php echo $this->Html->image("../files/Companies/image_url/".$annualReport->company->image_url,['width'=>'100px']);?></p>
										
										</div>
										<div class="col-md-7 right_cont">
												<p class="f10">NAME:<a>  <?= $annualReport->company['name']; ?></a></p>
												<p class="f10">STOCK CODE: <?= $annualReport->company['stock_code']; ?></p>
												<p class="f10">MARKET:<?= $annualReport->company['market']; ?></p>
												<p class="f10">SECTOR: <?= $annualReport->company->sector; ?></p>
												<p class="f10">WEBSITE: <a href="<?= $annualReport->company->website; ?>" title="VISIT OFFICIAL WEBSITE" target="_blank">VISIT OFFICIAL WEBSITE</a></p>
												<p class="f10">Year : <?= $annualReport->report_year;?></p>
										</div>
									</div>
								</div>
						  </td>
					  </tr>
					  
						
					</tbody>
					</table>
					<div class="col-md-12">
						</div>
								
								<div class="col-md-12 eve_bg">
								<a href="<?= $this->Url->build('/annual_reports/report-download/'.$annualReport->id);?>"><p><?php echo $this->Html->image('../front_end/images/pdf.png');?></p>
								<div class="col-md-6 right_cont">
								<p class="f9"><?= $annualReport->name;?></p>
								</div>
								</a>
								</div>
				</div>
				
		</div>		
		
        <div class="col-md-4">
			<div class="note_tab MB30">
				<h4>
					<a class="active" href="#news" aria-controls="news" role="tab" data-toggle="tab" class="info" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna" data-placement="right">News</a><a href="#" class="info" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna" data-placement="right"><?php echo $this->Html->image('../front_end/images/info.png');?></a> | 
					<a href="#notifications" aria-controls="notifications" role="tab" data-toggle="tab" class="info" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna" data-placement="right">Notifications</a><a href="#" class="info" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna" data-placement="right"><?php echo $this->Html->image('../front_end/images/info.png');?></a> 
				</h4>
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active news" id="news">
						<?php 
						if(!empty($news_snippets)):
						foreach($news_snippets as $news_snippet): ?>
							<div class="news_sec">
								<?php if(!empty($newsSnippet->image)):?>
									<div class="news_img col-md-4 col-sm-2"><?php echo $this->Html->image("../files/NewsSnippets/image/$news_snippet->image",['width'=>'80px']);?></div>
								<?php else: ?>
									<div class="news_img col-md-4 col-sm-2"><?php echo $this->Html->image('../front_end/images/news3.jpg');?></div>
								<?php endif; ?>
								<div class="news_info col-md-8 col-sm-10">
									<p><b><?= $news_snippet->title; ?></b> <br /><?= $this->Text->truncate($news_snippet->content, 150, ['ellipsis' =>  $this->Html->link('>>> Read More', ['controller'=>'NewsSnippets', 'action' => 'ReadMore',$news_snippet->id], ['escape'=>false, 'title'=>'Read More','class'=>"rmore"]), 'exact' => false]) ?></p>
								</div>
							</div>
						<?php endforeach;
						else:
							echo "<p>No News found</p>";
						endif;
						?>				
					</div>		
					<div role="tabpanel" class="tab-pane notifications news" id="notifications">
						<?php 
						if(!empty($notification)):
							foreach($notifications as $notification): ?>
							<div class="news_sec">
								<div class="news_info col-md-8 col-sm-10">
									<p><b><?= $notification->type; ?></b> <br /><?= $this->Text->truncate($notification->content, 150, ['ellipsis' => '<a href="#" class="rmore" title="Read More">>> Read More</a>', 'exact' => false]) ?></p>
								</div>
							</div>
						<?php endforeach;
						else:
							echo "<p>No New Notifications found</p>";
						endif;
						?>
					</div>
				</div>
			</div>
			<div class="note_tab ">
				<div id="date-popover" class="popover top"
				 style="cursor: pointer; display: block; margin-left: 33%; margin-top: -50px; width: 175px;">
					<div class="arrow"></div>
					<h3 class="popover-title" style="display: none;"></h3>

					<div id="date-popover-content" class="popover-content"></div>
				</div>
				<div class="news">
					<div id="my-calendar"></div>
				</div>
			</div>
		</div>
      </div>
		
      <!-- /END THE FEATURETTES -->

	</div><!-- /.container -->
 