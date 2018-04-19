<nav class="navigation">
	<?php foreach ($categories as $var) {?>
	<a class="<?php echo ($var['id'] == $category_id?'active':''); ?>" href="topic/<?php echo $var['id'];?><?php echo (!empty($var['link'])?'/'.$var['link']:'');?>"><?php echo $var['title'];?></a>
	<?php } ?>
	<a class="right" href="about">เกี่ยวกับเรา</a>
</nav>