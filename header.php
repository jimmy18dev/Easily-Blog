<header class="header <?php echo (!empty($article->head_cover_img)?'transparent':'');?>"">
	<?php if(!empty($article->id)){?>
	<a href="index.php" class="btn-icon"><i class="fal fa-arrow-left"></i></a>
	<?php }?>
	<div class="logo"><a href="index.php"><i class="fa fa-user-md"></i><span>อาชีวเวชกรรม</span></a></div>

	<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
	<a class="btn-icon right" href="article/<?php echo $article->id;?>/editor" title="แก้ไขบทความ"><i class="fal fa-cog"></i></a>
	<?php }?>
</header>