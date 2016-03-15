<?php //pr($newsSnippet); ?>
	</header>
	<div class="container">
		<div class="row breadcrumb_sec">
			<div class="col-md-12">
				<ol class="breadcrumb">
				  <li><a href="#" title="My Account"><?php echo $newsSnippet->title; ?></a></li>
				  <li class="active">Read More</li>
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
			 <h5>News</h5>
				<h1><?php echo $newsSnippet->title; ?></h1>
				<p><?php echo $this->Html->image("../files/NewsSnippets/image/$newsSnippet->image",['width'=>'400px']);?></p>
					<p><?php //echo $this->Html->image('../front_end/images/abt_banner.jpg');?></p>
					<div class="col-md-12">
						<p><?php echo $newsSnippet->content; ?></p>
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
						if(!empty($newsSnippets)):
						foreach($newsSnippets as $newsSnippet): ?>
							<div class="news_sec">
								<?php if(!empty($newsSnippet->image)):?>
									<div class="news_img col-md-4 col-sm-2"><?php echo $this->Html->image("../files/NewsSnippets/image/$newsSnippet->image",['width'=>'80px']);?></div>
								<?php else: ?>
									<div class="news_img col-md-4 col-sm-2"><?php echo $this->Html->image('../front_end/images/news3.jpg');?></div>
								<?php endif; ?>
								<div class="news_info col-md-8 col-sm-10">
									<p><b><?= $newsSnippet->title; ?></b> <br /><?= $this->Text->truncate($newsSnippet->content, 150, ['ellipsis' => '', 'exact' => false]) ?></p>
									<?= $this->Html->link('>>> Read More',  ['controller' => 'NewsSnippets', 'action' => 'ReadMore', $newsSnippet->id, '_full' => true], ['class' => 'button']);?>
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
 