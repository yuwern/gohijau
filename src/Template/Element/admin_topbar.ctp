<!--BEGIN TOPBAR-->
    <div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" data-intro="&lt;b&gt;Topbar&lt;/b&gt; has other styles with live demo. Go to &lt;b&gt;Layouts-&gt;Header&amp;Topbar&lt;/b&gt; and check it out." class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				<?php echo $this->Html->link(
									$this->Html->tag('span', 'Gohijau', array('class' => 'logo-text')),
									array('controller' => 'Users', 'action' => 'index'),
									array('id' => 'logo','class'=>'navbar-brand', 'escape' => false)
								);?>
                <!--<a id="logo" href="index.html" class="navbar-brand">
				<span class="fa fa-rocket"></span>
				<span class="logo-text">Gohijau</span>
				<span style="display: none" class="logo-text-icon">Gymnadz</span></a>-->
				
			</div>
			<div class="topbar-main"><a id="menu-toggle" href="#" ><i class="fa fa-bars"></i></a>
				 <ul class="nav navbar navbar-top-links navbar-right mbn" style="margin-right: 5px;">
					<li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><?= $this->Html->image('../files/Users/avatar/'. $this->request->session()->read('Auth.User.avatar'), ['class'=>"img-responsive img-circle"])?>&nbsp;<span class="hidden-xs"><?= $this->request->session()->read('Auth.User.username'); ?></span>&nbsp;<span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-user pull-right">
							<li>
								<?= $this->Html->link('<i class="fa fa-user"></i>My Profile', ['controller'=>'users', 'action' => 'profile', 'plugin'=>false], ['escape'=>false, 'title'=>'My Profile']) ?>
							</li>
							<li class="divider"></li>
							<li>
								<?= $this->Html->link('<i class="fa fa-key"></i>Logout', ['controller'=>'users', 'action' => 'logout', 'plugin'=>false], ['escape'=>false, 'title'=>'Logout']) ?>
							</li>
						</ul>
					</li>
				</ul>
			</div>
        </nav>
	</div>
     <!--END TOPBAR-->