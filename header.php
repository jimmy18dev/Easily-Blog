<header class="header <?php echo (!empty($article->head_cover_img)?'transparent':'');?>">
	<div class="logo"><a href="index.php"><i class="fa fa-user-md"></i><span><?php echo $config['settings']['sitename_th'];?></span></a></div>

	<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
	<a class="btn-icon right" href="article/<?php echo $article->id;?>/editor" title="แก้ไขบทความ"><i class="fal fa-cog"></i></a>
	<?php }?>

	<div class="btn-icon right" id="btn-category"><span>หมวดหมู่</span><i class="fal fa-ellipsis-h-alt"></i></div>
</header>