<div class="container"><h1 class="title"><?php echo $page->title; ?></h1></div>
</header>
<div class="container banner text-center">
	<img src="<?php echo $this->request->webroot . 'front_end/images/abt_banner.jpg'; ?>" alt="GoHijau" />
</div>
<div class="container about">
	<?php echo nl2br($page->content); ?>
</div>

