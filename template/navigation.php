<?php $categories = $category->listAll();?>
<nav>
	<ul>
		<?php foreach ($categories as $var) {?>
		<li><a <?php echo ($var['id'] == $category_id?'class="active"':'');?> href="topic/<?php echo $var['id'];?><?php echo (!empty($var['link'])?'/'.$var['link']:'');?>"><i class="<?php echo ($var['id'] == $category_id?'fa':'fal'); ?> fa-<?php echo (!empty($var['icon'])?$var['icon']:'folder');?>"></i><span><?php echo $var['title'];?></span></a></li>
	<?php } ?>
		<li><a <?php echo ($current_page == 'about'?'class="active"':'');?> href="about"><i class="<?php echo ($current_page == 'about'?'fa':'fal');?> fa-info-circle"></i><span>เกี่ยวกับเรา</span></a></li>
	</ul>
	<!-- <span>Occmed Prachinburi</span> -->
</nav>