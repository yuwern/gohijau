<!--BEGIN SIDEBAR MENU-->
<nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
	<div class="sidebar-collapse menu-scroll">
		<ul id="side-menu" class="nav">
			<li class="user-panel">
				<div class="thumb"><?= $this->Html->image('../files/Users/avatar/'. $this->request->session()->read('Auth.User.avatar'), ['class'=>"img-responsive img-circle"])?></div>
				<div class="info"><p><?= ucfirst($this->request->session()->read('User.first_name')); ?></p>
					<ul class="list-inline list-unstyled">
						<li>
							<?= $this->Html->link('<i class="fa fa-user"></i>', ['controller'=>'users', 'action' => 'profile'], ['escape'=>false, 'title'=>'Profile']) ?>
						</li>
						<li>
							<?= $this->Html->link('<i class="fa fa-sign-out"></i></a>', ['controller'=>'users', 'action' => 'logout'], ['escape'=>false, 'title'=>'Profile']) ?>
						</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</li>
			<!--li><a href="index.html"><i class="fa fa-tachometer fa-fw">
				<div class="icon-bg bg-orange"></div>
			</i><span class="menu-title">Dashboard</span></a></li-->
			<?php 
			$class= '';	
			if(
				($this->request->params['controller'] == 'Users' && ($this->request->params['action'] == 'index' || $this->request->params['action'] == 'add'|| $this->request->params['action'] == 'edit'|| $this->request->params['action'] == 'view')) 
				|| ($this->request->params['controller'] == 'Groups')|| ($this->request->params['controller'] == 'Permission')|| ($this->request->params['controller'] == 'UserGroupPermission')
			){
				$class= 'active';	
			}
			?>				
			<?php //print_r($this->request->params); ?>
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-edit fa-fw">
				<div class="icon-bg bg-violet"></div>
			</i><span class="menu-title">Admin Users</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'Users' && ($this->request->params['action']=='index' || $this->request->params['action']=='view'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-columns"></i><span class="submenu-title">Users</span>', ['controller'=>'users', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'Users']) ?>
					</li>
					<li class="<?php echo ($this->request->params['controller'] == 'Users' && ($this->request->params['action']=='add' || $this->request->params['action']=='edit'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-file-text-o"></i><span class="submenu-title">Create Admin User</span>', ['controller'=>'users', 'action' => 'add', 'plugin'=>false], ['escape'=>false, 'title'=>'Users']) ?>
					</li>	

					<li class="<?php echo ($this->request->params['controller'] == 'Groups' && ($this->request->params['action']=='index'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-file-text-o"></i><span class="submenu-title">Groups</span>', ['controller'=>'groups', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'Groups']) ?>
					</li>
					
					<li class="<?php echo ($this->request->params['controller'] == 'Permission' && ($this->request->params['action']=='index'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-file-text-o"></i><span class="submenu-title">User Permissions</span>', ['controller'=>'permission', 'action' => 'index', 'plugin'=>'acl'], ['escape'=>false, 'title'=>'Permissions']) ?>
					</li>
					
					<li class="<?php echo ($this->request->params['controller'] == 'UserGroupPermission' && ($this->request->params['action']=='index'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-file-text-o"></i><span class="submenu-title">User Group Permissions</span>', ['controller'=>'user_group_permission', 'action' => 'index', 'plugin'=>'acl'], ['escape'=>false, 'title'=>'User Group Permission']) ?>
					</li>
				</ul>
			</li>    
			<?php 
			$class= '';	
			if(
				($this->request->params['controller'] == 'Users' && ($this->request->params['action'] == 'userIndex' ||  $this->request->params['action'] == 'userView' ||  $this->request->params['action'] == 'userAdd'||  $this->request->params['action'] == 'userEdit' )) 
			){
				$class= 'active';	
			}
			?>				
			<?php //print_r($this->request->params); ?>
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-edit fa-fw">
				<div class="icon-bg bg-violet"></div>
			</i><span class="menu-title">Users</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'Users' && ($this->request->params['action']=='userIndex' || $this->request->params['action']=='userView'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-columns"></i><span class="submenu-title">Users</span>', ['controller'=>'users', 'action' => 'userIndex', 'plugin'=>false], ['escape'=>false, 'title'=>'Users']) ?>
					</li>
					<li class="<?php echo ($this->request->params['controller'] == 'Users' && ($this->request->params['action']=='userAdd'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-file-text-o"></i><span class="submenu-title">Create Super User</span>', ['controller'=>'users', 'action' => 'userAdd', 'plugin'=>false], ['escape'=>false, 'title'=>'Users']) ?>
					</li>	
				</ul>
			</li>    
			<?php 
			$class= '';	
			if($this->request->params['controller'] == 'AnnualReports' || $this->request->params['controller'] == 'AnnualReportUsers'){
				$class= 'active';	
			}
			?>
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-desktop fa-fw">
				<div class="icon-bg bg-pink"></div>
				</i><span class="menu-title">Annual Reports List</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'AnnualReports' && ($this->request->params['action']=='index' || $this->request->params['action']=='view'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-briefcase"></i><span class="submenu-title">View All Annual Reports</span>', ['controller'=>'annual_reports', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'Annual Reports List']) ?>
					</li>
					<li class="<?php echo ($this->request->params['controller'] == 'AnnualReports' && ($this->request->params['action']=='add' || $this->request->params['action']=='edit'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-th-large"></i><span class="submenu-title">Create a Annual Report</span>', ['controller'=>'annual_reports', 'action' => 'add', 'plugin'=>false], ['escape'=>false, 'title'=>'AnnualReport Create']) ?>
					</li>
				</ul>
			</li>
			<?php 
			$class= '';	
			if($this->request->params['controller'] == 'Circulars' || $this->request->params['controller'] == 'CircularReportUsers'){
				$class= 'active';	
			}
			?>					
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-th-list fa-fw">
				<div class="icon-bg bg-blue"></div>
			</i><span class="menu-title">Electronic Circulars</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'Circulars' && ($this->request->params['action']=='index' || $this->request->params['action']=='view'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-th-large"></i><span class="submenu-title">Electronic Circular List</span>', ['controller'=>'circulars', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'Circular List']) ?>
					</li>
					<li class="<?php echo ($this->request->params['controller'] == 'Circulars' && ($this->request->params['action']=='add' || $this->request->params['action']=='edit'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-tablet"></i><span class="submenu-title">Create Electronic Circular</span>', ['controller'=>'circulars', 'action' => 'add', 'plugin'=>false], ['escape'=>false, 'title'=>'Create Circular']) ?>
					</li>
				</ul>
			</li>			
			
			<?php 
			$class= '';	
			if($this->request->params['controller'] == 'Contacts'){
				$class= 'active';	
			}
			?>					
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-th-list fa-fw">
				<div class="icon-bg bg-blue"></div>
			</i><span class="menu-title">Contacts</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'Contacts' && ($this->request->params['action']=='index' || $this->request->params['action']=='view'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-th-large"></i><span class="submenu-title">Contacts List</span>', ['controller'=>'contacts', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'Contacts List']) ?>
					</li>
				</ul>
			</li>			
			<?php 
			$class= '';	
			if($this->request->params['controller'] == 'Companies'){
				$class= 'active';	
			}
			?>					
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-th-list fa-fw">
				<div class="icon-bg bg-blue"></div>
			</i><span class="menu-title">Companies</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'Companies' && ($this->request->params['action']=='index' || $this->request->params['action']=='view'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-th-large"></i><span class="submenu-title">Companies List</span>', ['controller'=>'companies', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'Companies List']) ?>
					</li>
				</ul>
			</li>
			<?php 
			$class= '';	
			if($this->request->params['controller'] == 'Events'){
				$class= 'active';	
			}
			?>		
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-database fa-fw">
				<div class="icon-bg bg-red"></div>
			</i><span class="menu-title">AGM / EGM</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'Events' && ($this->request->params['action']=='index' || $this->request->params['action']=='view'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-user"></i><span class="submenu-title">AGM / EGM List</span>', ['controller'=>'events', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'Events List']) ?>
					</li>
					<li class="<?php echo ($this->request->params['controller'] == 'Events' && ($this->request->params['action']=='edit' || $this->request->params['action']=='add'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-sign-in"></i><span class="submenu-title">Create AGM / EGM</span>', ['controller'=>'events', 'action' => 'add', 'plugin'=>false], ['escape'=>false, 'title'=>'Events Add']) ?>
					</li>
				</ul>
			</li>	
			
			<?php 
			$class= '';	
			if($this->request->params['controller'] == 'Announcements'){
				$class= 'active';	
			}
			?>				
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-envelope-o">
				<div class="icon-bg bg-red"></div>
			</i><span class="menu-title">Announcements</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'Announcements' && ($this->request->params['action']=='index' || $this->request->params['action']=='view'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-inbox"></i><span class="submenu-title">Announcements</span>', ['controller'=>'Announcements', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'Announcements List']) ?>
					</li>
					<li class="<?php echo ($this->request->params['controller'] == 'Announcements' && ($this->request->params['action']=='edit' || $this->request->params['action']=='add'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-edit"></i><span class="submenu-title">Create a Announcements</span>', ['controller'=>'Announcements', 'action' => 'add', 'plugin'=>false], ['escape'=>false, 'title'=>'Announcements Add']) ?>
					</li>
				</ul>
			</li>			
			<?php 
			$class= '';	
			if($this->request->params['controller'] == 'NewsSnippets'){
				$class= 'active';	
			}
			?>				
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-gift fa-fw">
				<div class="icon-bg bg-red"></div>
			</i><span class="menu-title">News Snippets</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'NewsSnippets' && ($this->request->params['action']=='index' || $this->request->params['action']=='view'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-print"></i><span class="submenu-title">News/Notification Snippets</span>', ['controller'=>'NewsSnippets', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'News Snippets List']) ?>
					</li>
					<li class="<?php echo ($this->request->params['controller'] == 'NewsSnippets' && ($this->request->params['action']=='edit' || $this->request->params['action']=='add'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-calendar"></i><span class="submenu-title">Create a Snippet</span>', ['controller'=>'NewsSnippets', 'action' => 'add', 'plugin'=>false], ['escape'=>false, 'title'=>'News Snippets Add']) ?>
					</li>
				</ul>
			</li>				
			<?php 
			$class= '';	
			if($this->request->params['controller'] == 'EmailTemplates'){
				$class= 'active';	
			}
			?>				
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-gift fa-fw">
				<div class="icon-bg bg-red"></div>
			</i><span class="menu-title">Email Templates</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'EmailTemplates')?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-print"></i><span class="submenu-title">Email Templates</span>', ['controller'=>'EmailTemplates', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'Email Templates List']) ?>
					</li>
				</ul>
			</li>				
		
			<?php 
			$class= '';	
			if($this->request->params['controller'] == 'Pages'){
				$class= 'active';	
			}
			?>		
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-file-o fa-fw">
				<div class="icon-bg bg-red"></div>
			</i><span class="menu-title">Pages</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'Pages' && ($this->request->params['action']=='index' || $this->request->params['action']=='view'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-user"></i><span class="submenu-title">Pages List</span>', ['controller'=>'pages', 'action' => 'index', 'plugin'=>false], ['escape'=>false, 'title'=>'List Page']) ?>
					</li>
					<li class="<?php echo ($this->request->params['controller'] == 'Pages' && ($this->request->params['action']=='edit' || $this->request->params['action']=='add'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-sign-in"></i><span class="submenu-title">Create Page</span>', ['controller'=>'pages', 'action' => 'add', 'plugin'=>false], ['escape'=>false, 'title'=>'Create Page']) ?>
					</li>
				</ul>
			</li>
			
			<?php 
			$class= '';	
			if($this->request->params['action'] == 'report'){
				$class= 'active';	
			}
			?>
			<li class="<?= $class; ?>"><a href="#"><i class="fa fa-th-list fa-fw">
				<div class="icon-bg bg-red"></div>
			</i><span class="menu-title">Reports</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($this->request->params['controller'] == 'Users' && ($this->request->params['action']=='report'))?'active':'inactive'; ?>">
						<?= $this->Html->link('<i class="fa fa-user"></i><span class="submenu-title">Select Report</span>', ['controller'=>'users', 'action' => 'report', 'plugin'=>false], ['escape'=>false, 'title'=>'List Page']) ?>
					</li>
				</ul>
			</li>
										
		</ul>
	</div>
</nav>
<!--END SIDEBAR MENU-->