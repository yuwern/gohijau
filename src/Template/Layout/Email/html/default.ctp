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
?>
 
<html>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
		body {
			width:90%;
			margin:15px auto;
			font-family: open_sansregular, Arial;
		}

		@font-face {
			font-family: "open_sanslight";
			src: url("fonts/opensans-light_0-webfont.eot");
			src: url("fonts/opensans-light_0-webfont.eot?#iefix") format("embedded-opentype"),
				 url("fonts/opensans-light_0-webfont.woff") format("woff"),
				 url("fonts/opensans-light_0-webfont.ttf") format("truetype"),
				 url("fonts/opensans-light_0-webfont.svg#open_sanslight") format("svg");
			font-weight: normal;
			font-style: normal;

		}


		@font-face {
			font-family: "open_sansregular";
			src: url("fonts/opensans-regular_0-webfont.eot");
			src: url("fonts/opensans-regular_0-webfont.eot?#iefix") format("embedded-opentype"),
				 url("fonts/opensans-regular_0-webfont.woff") format("woff"),
				 url("fonts/opensans-regular_0-webfont.ttf") format("truetype"),
				 url("fonts/opensans-regular_0-webfont.svg#open_sansregular") format("svg");
			font-weight: normal;
			font-style: normal;

		}

		.wrapper {
			width:100%;
			height:auto;
		}

		.header {
			width:100%;
			height:105px;
			border-bottom: 1px solid #aaa;
		}

		.header-container {
			width:100%;
			height:105px;
		}



		.content-container {
			width:100%;
			height:auto;
		}


		h2 {
			font-family: "open_sanslight", Arial;
			color: #252525;
			font-size: 22px;
			text-align: left;
			width:100%;
		}


		span {
			font-family: "open_sanslight", Arial;
			font-size: 30px;
			color:#252525;
			
		}

		.regards {
			font-family: "open_sanslight", Arial;
			font-size:22px;
			color:#252525;
			display:block;
			margin:35px 0 0 0;
		}


		p {
			font-family: "open_sanslight", Arial;
			color: #252525;
			font-size: 20px;
			margin: 10px 0 0;
		}

		.footer-container {
			width:100%;
			height:auto;
			margin:35px 0 0 0;
		}


		.footer-container p {
			font-family: "open_sanslight", Arial;
			color: #808080;
			font-size:16px;
		}

		.footer-container a {
			font-family: "open_sanslight", Arial;
			color: #808080;
			text-decoration: none;
		}

		.footer-container a:hover {
			font-family: "open_sanslight", Arial;
			color: #e73e1c;
			text-decoration: none;
		}

		</style>
		<body style="width:100%;margin:15px auto;font-family: open_sansregular, Arial;">
			<div class="wrapper" style="width:100%;height:auto;">
			   <div class="header" style="width:100%;height:115px;border-bottom: 1px solid #aaa;">
				  <div class="header-container" style="width:100%;height:105px;">
					 <h1><a class="header-logo" href="#" style="width:112px;height:112px;"></a><img src="<?php echo $this->request->webroot . 'front_end/images/logo.png'; ?>" alt=""  /></h1>
				  </div>
			   </div>
			   
			   <div class="content-container" style="width:100%;height:auto;">
				  <h2 style="font-family: open_sanslight, Arial;color: #252525;font-size: 18px;text-align: left;width:100%;">Name : <?= $name ?></h2>
				  
				  <span style="font-family: open_sanslight, Arial;font-size: 20px;color:#252525;">
				  </span>
				  <h2 style="font-family: open_sanslight, Arial;color: #252525;font-size: 18px;text-align: left;width:100%;">Email : <?= $email ?></h2>
				  
				  <span style="font-family: open_sanslight, Arial;font-size: 20px;color:#252525;">
				  </span>
				   <h2 style="font-family: open_sanslight, Arial;color: #252525;font-size: 18px;text-align: left;width:100%;">Phone : <?= $phone ?></h2>
				  
				  <span style="font-family: open_sanslight, Arial;font-size: 20px;color:#252525;">
				  </span>
				  <h2 style="font-family: open_sanslight, Arial;color: #252525;font-size: 18px;text-align: left;width:100%;">Message : <?= $message ?></h2>
				  
					 <span class="regards" style="font-family: open_sanslight, Arial;font-size: 22px;color:#252525;display:block;margin:35px 0 0 0;">Regards,</span>
					 <p style="font-family: open_sanslight, Arial;color: #252525;font-size: 20px;margin: 10px 0 0;">Gohijau Team</p>

			   </div>
			   
			   <!--<div class="footer-container" style="width:100%;height:auto;margin:35px 0 0 0;">
				  <p style="font-family: open_sanslight, Arial;color: #808080;font-size: 16px;">&copy; 2016 Gohijau. Developed by <a href="http://www.openwavecomp.com/" style="font-family: open_sanslight, Arial;color: #808080;text-decoration: none;">Openwave Computing</a></p>
			   </div>-->
			</div>


		</body>
		</html>