<?php $categories = $category->listAll();?>
<nav class="navigation" id="navigation">
	<div class="mini-logo">
		<span><img src="image/logo.png" alt=""></span>
		<span><?php echo $config['settings']['sitename_th'];?></span>
	</div>
	<!-- <a class="nav <?php echo ($current_page == 'home'?'active':'');?>" href="index.php"><i class="<?php echo ($current_page == 'home'?'fa':'fal');?> fa-home"></i>หน้าแรก</a> -->
	<?php foreach ($categories as $var) {?>
	<a class="nav <?php echo ($var['id'] == $category_id?'active':''); ?>" href="topic/<?php echo $var['id'];?><?php echo (!empty($var['link'])?'/'.$var['link']:'');?>"><i class="<?php echo ($var['id'] == $category_id?'fa':'fal'); ?> fa-<?php echo (!empty($var['icon'])?$var['icon']:'folder');?>"></i><?php echo $var['title'];?></a>
	<?php } ?>
	<a class="nav <?php echo ($current_page == 'about'?'active':'');?>" href="about"><i class="<?php echo ($current_page == 'about'?'fa':'fal');?> fa-info-circle"></i>เกี่ยวกับเรา</a>
	<!-- <span>Occmed Prachinburi</span> -->
</nav>