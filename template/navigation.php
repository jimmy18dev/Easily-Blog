<?php $categories = $category->listAll();?>
<nav class="navigation" id="navigation">
	<a class="nav <?php echo ($current_page == 'home'?'active':'');?>" href="index.php#navi">หน้าแรก</a>
	<?php foreach ($categories as $var) {?>
	<a class="nav <?php echo ($var['id'] == $category_id?'active':''); ?>" href="topic/<?php echo $var['id'];?><?php echo (!empty($var['link'])?'/'.$var['link']:'');?>#navi"><?php echo $var['title'];?></a>
	<?php } ?>
	<a class="nav <?php echo ($current_page == 'about'?'active':'');?>" href="about">เกี่ยวกับเรา</a>
	<!-- <span>Occmed Prachinburi</span> -->

	<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
	<a href="article/<?php echo $article->id;?>/editor" class="btn iconleft"><span>แก้ไขบทความ</span><i class="fa fa-cog" aria-hidden="true"></i></a>
	<?php }?>
</nav>