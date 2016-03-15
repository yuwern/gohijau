
	</header>
	<div class="container">
		<div class="row breadcrumb_sec">
			<div class="col-md-12">
				<ol class="breadcrumb">
				  <li><a href="#" title="My Account">My Account</a></li>
				  <li class="active"><?php echo($this->request->params['action']); ?></li>
				</ol>
				<h6>WELCOME : <?php echo $this->request->session()->read('Auth.User.username');?> </h6>
			</div>
		</div>
	</div>
    <div class="container ">
	<div class="">
        <div class="col-md-8">
			 <div class="highlights MB30">
							 <hr>
			 <h5>CIRCULAR</h5>
				<h1>TO RAISE GROSS PROCEEDS</h1>
				<h4 class="text-danger">OF UP TO RM5.00 BILLION</h4>
				
				
				<table class="table custom_table">
					
					<tbody>
						
					<tr id="demo" class="eve_bg" aria-expanded="true">
							<td colspan="4">
								<div class="collapse_cont col-md-12">
									<div class="row">
										<div class="col-md-3 left_cont">
										<p><?php echo $this->Html->image('../front_end/images/sime_darby.png', ['height' => 100, 'width' => 100]);?></p>
										
										</div>
										<div class="col-md-7 right_cont">
												<p class="f10">NAME:<a> SIME DARBY BERHAD</a></p>
												<p class="f10">STOCK CODE: SIME (4197)</p>
												<p class="f10">MARKET: MAIN MARKET</p>
												<p class="f10">SECTOR: PROPERTY</p>
												<p class="f10">WEBSITE: <a href="#" title="VISIT OFFICIAL WEBSITE" target="_blank">VISIT OFFICIAL WEBSITE</a></p>
										</div>
									</div>
								</div>
						  </td>
					  </tr>
					  
						
					</tbody>
					</table>
					<p><?php echo $this->Html->image('../front_end/images/abt_banner.jpg');?></p>
					<div class="col-md-12">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								</div>
								
								<div class="col-md-12 eve_bg">
								<p><?php echo $this->Html->image('../front_end/images/pdf.png');?></p>
								<div class="col-md-6 right_cont">
								<p class="f9">CIRCULAR PROPOSED RIGHTS PDF</p>
								</div>
								</div>
				</div>
				
		</div>		
		
        <div class="col-md-4">
			<div class="note_tab">
				<h4>
					<a class="active" href="#news" aria-controls="news" role="tab" data-toggle="tab" class="info" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna" data-placement="right">News</a><a href="#" class="info" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna" data-placement="right"><?php echo $this->Html->image('../front_end/images/info.png');?></a> | 
					<a href="#notifications" aria-controls="notifications" role="tab" data-toggle="tab" class="info" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna" data-placement="right">Notifications</a><a href="#" class="info" data-toggle="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna" data-placement="right"><?php echo $this->Html->image('../front_end/images/info.png');?></a> 
				</h4>
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active news" id="news">
						<div class="news_sec">
							<div class="news_img col-md-4 col-sm-2"><?php echo $this->Html->image('../front_end/images/news3.jpg');?></div>
							<div class="news_info col-md-8 col-sm-10">
								<p>Lorem ipsum dolor sit amet, sectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </p>
								<a href="#" class="rmore" title="Read More">>> Read More</a>
							</div>
						</div>
						
						<div class="news_sec">
							<div class="news_info col-md-8 col-sm-10">
								<p>Lorem ipsum dolor sit amet, sectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </p>
								<a href="#" class="rmore" title="Read More">>> Read More</a>
							</div>
							<div class="news_img col-md-4 col-sm-2"><?php echo $this->Html->image('../front_end/images/news3.jpg');?></div>
						</div>
						
						<div class="news_sec">
							<div class="news_img col-md-4 col-sm-2"><?php echo $this->Html->image('../front_end/images/news3.jpg');?></div>
							<div class="news_info col-md-8 col-sm-10">
								<p>Lorem ipsum dolor sit amet, sectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </p>
								<a href="#" class="rmore" title="Read More">>> Read More</a>
							</div>
						</div>
					</div>		
					<div role="tabpanel" class="tab-pane notifications news" id="notifications">
						<div class="news_sec">
							<div class="news_img col-md-4 col-sm-2"><?php echo $this->Html->image('../front_end/images/news3.jpg');?></div>
							<div class="news_info col-md-8 col-sm-10">
								<a href="#" class="rmore" title="Read More">>> Read More</a>
							</div>
						</div>
						
						<div class="news_sec">
							<div class="news_info col-md-8 col-sm-10">
								<p>Lorem ipsum dolor sit amet, sectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </p>
								<a href="#" class="rmore" title="Read More">>> Read More</a>
							</div>
							<div class="news_img col-md-4 col-sm-2"><?php echo $this->Html->image('../front_end/images/news3.jpg');?></div>
						</div>
						
						<div class="news_sec">
							<div class="news_img col-md-4 col-sm-2"><?php echo $this->Html->image('../front_end/images/news3.jpg');?></div>
							<div class="news_info col-md-8 col-sm-10">
								<p>Lorem ipsum dolor sit amet, sectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </p>
								<a href="#" class="rmore" title="Read More">>> Read More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
      </div>
		
      <!-- /END THE FEATURETTES -->

	</div><!-- /.container -->
 