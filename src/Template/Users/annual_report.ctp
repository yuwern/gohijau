</header>
<div class="container">
	<div class="row breadcrumb_sec">
		<div class="col-md-8 col-xs-8">
			<ol class="breadcrumb">
			  <li><a href="#" title="My Account">My Account</a></li>
			  <li class="active">Circular</li>
			</ol>
			<h6>WELCOME <?php echo $this->request->session()->read('Auth.User.username');?>:</h6>
		</div>
		<div class="col-md-4 col-xs-4 cmy_logo"><?php echo $this->Html->image('../front_end/images/kanger_bamboo.png');?></div>
		
	</div>
	</div>

    <div class="banner theme-showcase text-center MT10">
	<?php echo $this->Html->image('../front_end/images/annual_report_banner.jpg');?>
	  
	   <div class="caption">
		<h2>ANNUAL REPORT 2014</h2>
		<h1>Strong<br /><span>Performance</span></h1>
		<p class="crimsonitalic text-center">achieved strong performance with revenue of RM66.72 million and <br />
profit after tax (“PAT”) of RM7.02 million for FY2014</p>
		<p><a class="btn btn-default" href="#" role="button" title="DOWNLOAD REPORT">DOWNLOAD REPORT</a></p>
	   </div>
    </div>
	
	<!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container company_profile">
			<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="goal">
				<div class="goal_img col-md-4 col-xs-4"><?php echo $this->Html->image('../front_end/images/man.png');?></div>
				<div class="content col-md-8 col-xs-8">
				<h3>Financial goal achieved</h3>
				<p class="para">Excepteur sint occaecat cupidatat <br/>non proident, sunt in culpa qui offici</p>
				<p class="info">Ryan Terry, CEO of Kanger Bamboo Berhad</p>
				</div>
				</div>
			</div>
			
			<div class="col-md-6 col-sm-6">
			<div class="perform">
			<h4>Year to year performance</h4>
			<div class="col-md-6 col-xs-6">
				<h2>8.4<sup>%</sup></h2>
				<p>Lorem ipsum dolor sit </p>
			</div>
			<div class="col-md-6 col-xs-6">
				<h2>22<sup>%</sup></h2>
				<p>Lorem ipsum dolor sit </p>
			</div>
			</div>
			</div>
			</div>
		<div class="row section">
			<div class="col-md-3 col-sm-3">
				<div class="sec_content">
				<h3>Download report</h3>
				<p>40 pages comprehensive reportincluding Lorem ipsum dolor sit amet, consectetur</p>
				<a class="info" href="#" title="Download digital annual report">Download digital annual report</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="sec_content">
				<h3>Duis aute irure </h3>
				<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt </p>
				<a class="info" href="#" title="Visit Excepteur">Visit Excepteur</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="sec_content">
				<h3>Nisi ut aliquip </h3>
				<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt </p>
				<a class="info" href="#" title="Visit Excepteur">Visit Excepteur</a>
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="sec_content">
				<h3>Quicklinks</h3>
				<a href="#" title="Kanger Bamboo profile (PDF)">Kanger Bamboo profile (PDF)</a>
				<a href="#" title="Annual report FY 2013">Annual report FY 2013</a>
				<a href="#" title="Special notification Sep 2014">Special notification Sep 2014</a>
				<a href="#" title="Aliquip ex ea commodo con">Aliquip ex ea commodo con</a>
				</div>
			</div>
		</div>
		
			 <hr class="featurette-divider">

			 <div class="row highlight_sec">
			 <h2>HIGHLIGHT</h2>
		<p class="text-center MB0"><span class="bor">&nbsp;</span></p>
		<p class="crimsonitalic text-center">We have summarise for you!</p>
		<div class="three_col">
			<div class="col-lg-4 col-sm-4">
			<?php echo $this->Html->image('../front_end/images/hl_1.jpg');?>
			  
			  <h3>Overview: Strong performance</h3>
			  <p>RM66.72 million revenue and RM7.02 million profit</p>
			   <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex </p>
			   <a class="read" href="#" title="READ MORE">READ MORE</a>
			   <hr class="featurette-divider">
			</div><!-- /.col-lg-4 -->
			<div class="col-lg-4 col-sm-4">
			<?php echo $this->Html->image('../front_end/images/hl_2.jpg');?>
			   
			  <h3>China market expected to grow</h3>
			  <p>Grow to RMB5.04 billion (RM2.98 billion) in 2017</p>
			   <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex </p>
			   <a class="read" href="#" title="READ MORE">READ MORE</a>
			   <hr class="featurette-divider">
			</div><!-- /.col-lg-4 -->
			<div class="col-lg-4 col-sm-4">
			<?php echo $this->Html->image('../front_end/images/hl_3.jpg');?>
			  
			  <h3>New series launch soon</h3>
			  <p>Strategies to continue to grow our businesses</p>
			   <p class="detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex </p>
			   <a class="read" href="#" title="READ MORE">READ MORE</a>
			   <hr class="featurette-divider">
			</div>
        </div>
      </div><!-- /.row -->

      <!-- /END THE FEATURETTES -->

 </div><!-- /.container -->