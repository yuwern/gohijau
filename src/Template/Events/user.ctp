	</header>
	<div class="container">
		<div class="row breadcrumb_sec">
			<div class="col-md-12">
				<ol class="breadcrumb">
				  <li><?= $this->Html->link('My Account',  ['controller' => 'users', 'action' => 'dashboard', '_full' => true], ['class' => 'button']);?></li>
				  <li class="active">Events</li>
				</ol>
			</div>
		</div>
	</div>
    <div class="container ">
		<div class="row featurette account">
        <div class="col-md-8">
			 <div class="highlights MB30">
				<h3>UPCOMING EVENTS<a href="#" class="info" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna" data-placement="right"><?php echo $this->Html->image('../front_end/images/info.png');?></a></h3>
				
				<table class="table custom_table">
					<thead>
					  <tr>
						<th>Date</th>
						<th>Venue</th>
						<th>Details</th>
						<th>RSVP</th>
					  </tr>
					</thead>
					<tbody>
						<?php foreach ($events as $event): ?>
						<?php if(empty($event->users_events[0]['id'])): ?>
						<tr>
							<td><?php echo date('m/d/Y', strtotime($event->date)) ?></td>
							<td class="f9 PT12"><?= h($event->venue) ?></td>
							<td><a href="#demo<?= h($event->id) ?>" class="toggle plus" data-toggle="collapse" title="<?= h($event->title) ?>"><?php echo $this->Text->truncate(h($event->title), 30, ['ellipsis' => '...', 'exact' => false]); ?></a></td>
							<td class="f9 PT12"><a href="<?php echo $this->Url->build(["controller" => "Events","action" => "confirm", $event->id]); ?>" onclick="return confirm('Are you confirm?');" title="Going">Going?</a></td>
						</tr>
						<tr id="demo<?= h($event->id) ?>" class="collapse demo">
							<td colspan="4">
								<div class="collapse_cont col-md-12">
									<div class="row">
										<div class="col-md-5 left_cont">
										<p>	
											COMPANY NAME: <?= $event->company_name;?><br/>
											YEAR: <?= $event->year;?><br/>
											REPORT TYPE: <?= $event->report_type;?><br/>
											DATE: <?php echo date('m-d-Y', strtotime($event->date)) ?><br/>
											TIME: <?= $event->time;?><br/>
											VENUE: <?= $event->venue;?><br/>
										</p>
										</div>
									<div class="col-md-7 right_cont">
										DESCRIPTION : <?= $event->descripiton;?>
									</div>
									</div>
								</div>
						  </td>
						</tr>
						<?php endif; ?>
						<?php endforeach; ?>
					</tbody>
					</table>
				</div>
				<div class="highlights">
				<h3>EVENTS TO ATTEND (CONFIRMED)<a href="#" class="info" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna" data-placement="right"><?php echo $this->Html->image('../front_end/images/info.png');?></a></h3>
				
				<table class="table custom_table">
					<thead>
					  <tr>
						<th>Date</th>
						<th>venue</th>
						<th>Details</th>
						<th>Status</th>
					  </tr>
					</thead>
					<tbody>
						<?php foreach ($confirmed_events as $confirmed_event): ?>
						<tr>
							<td><?php echo date('m/d/Y', strtotime($confirmed_event->event['date'])) ?></td>
							<td class="f9 PT12"><?= h($confirmed_event->event['venue']) ?></td>
							<td><a href="#eventconf<?= h($confirmed_event->event['id']) ?>" class="toggle plus" data-toggle="collapse" title="<?= h($confirmed_event->event['title']) ?>"><?= h($confirmed_event->event['title']) ?></a></td>
							<td class="f9 PT12"><a href="#Confirmed" title="Confirmed">Confirmed.</a></td>
						</tr>
						<tr id="eventconf<?= h($confirmed_event->event['id']) ?>" class="collapse demo">
							<td colspan="4">
								<div class="collapse_cont col-md-12">
									<div class="row">
										<div class="col-md-5 left_cont">
										<p>	
											COMPANY NAME: <?= $event->company_name;?><br/>
											YEAR: <?= $event->year;?><br/>
											REPORT TYPE: <?= $event->report_type;?><br/>
											DATE: <?php echo date('m-d-Y', strtotime($event->date)) ?><br/>
											TIME: <?= $event->time;?><br/>
											VENUE: <?= $event->venue;?><br/>
										</p>
										</div>
									<div class="col-md-7 right_cont">
										DESCRIPTION : <?= $event->descripiton;?>
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
						foreach($news_snippets as $key => $news_snippet): ?>
							<div class="news_sec">
								<?php if($key%2==false):?>
									<?php if(!empty($news_snippet->image)):?>
										<div class="news_img col-md-5 col-sm-2"><?php echo $this->Html->image("../files/NewsSnippets/image/$news_snippet->image",['width'=>'120px']);?></div>
									<?php else: ?>
										<div class="news_img col-md-5 col-sm-2"><?php echo $this->Html->image('../front_end/images/news3.jpg');?></div>
									<?php endif; ?>
									<div class="news_info col-md-7 col-sm-10">
										<p><b><?= $news_snippet->title; ?></b> 
										<br />
										<?= $this->Text->truncate($news_snippet->content, 70, ['ellipsis' => '']); ?></p>
										<?= $this->Html->link('>> Read More',  ['controller' => 'NewsSnippets', 'action' => 'ReadMore', $news_snippet->id, '_full' => true], ['class' => 'rmore']);?>
									</div>
								<?php else:?>
									<div class="news_info col-md-7 col-sm-10">
										<p><b><?= $news_snippet->title; ?></b> 
										<br />
										<?= $this->Text->truncate($news_snippet->content, 70, ['ellipsis' => '']); ?></p>
										<?= $this->Html->link('>> Read More',  ['controller' => 'NewsSnippets', 'action' => 'ReadMore', $news_snippet->id, '_full' => true], ['class' => 'rmore']);?>
									</div>
									<?php if(!empty($news_snippet->image)):?>
										<div class="news_img col-md-5 col-sm-2"><?php echo $this->Html->image("../files/NewsSnippets/image/$news_snippet->image",['width'=>'120px']);?></div>
									<?php else: ?>
										<div class="news_img col-md-5 col-sm-2"><?php echo $this->Html->image('../front_end/images/news3.jpg');?></div>
									<?php endif; ?>
								<?php endif;?>
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
 