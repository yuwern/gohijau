<div class="sub_nav">
	<div class="container">
		<ul>
			<li class="<?php echo ($this->request->params['controller'] == 'Users' && ($this->request->params['action']=='dashboard'))?'active':''; ?>">
				<?= $this->Html->link('<i class="fa fa-columns"></i><span class="submenu-title">ELECTRONIC REPORTS</span>', ['controller'=>'users', 'action' => 'dashboard'], ['escape'=>false, 'title'=>'Electronic Reports']) ?>
			</li>
			<li class="<?php echo ($this->request->params['controller'] == 'Users' && ($this->request->params['action']=='announcement'))?'active':''; ?>">
				<?= $this->Html->link('<i class="fa fa-columns"></i><span class="submenu-title">ANNOUNCEMENT</span>', ['controller'=>'users', 'action' => 'announcement'], ['escape'=>false, 'title'=>'Announcements']) ?>
			</li>
			<li class="<?php echo ($this->request->params['controller'] == 'Events' && ($this->request->params['action']=='user'))?'active':''; ?>">
				<?= $this->Html->link('<i class="fa fa-columns"></i><span class="submenu-title">EVENTS</span>', ['controller'=>'events', 'action' => 'user'], ['escape'=>false, 'title'=>'Events']) ?>
			</li>
			<li class="<?php echo ($this->request->params['controller'] == 'Users' && ($this->request->params['action']=='accountSetting'))?'active':''; ?>">
				<?= $this->Html->link('<i class="fa fa-columns"></i><span class="submenu-title">ACCOUNT &amp; SETTINGS</span>', ['controller'=>'users', 'action' => 'account_setting'], ['escape'=>false, 'title'=>'Account Setting']) ?>
			</li>
		</ul>
	</div>
</div>