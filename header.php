<header class="header <?php echo (!empty($article->head_cover_img)?'transparent':'');?>">
	<div class="logo"><a href="index.php"><i class="fa fa-user-md"></i><span><?php echo $config['settings']['sitename_th'];?></span></a></div>

	<?php if($current_page == 'home' || $current_page == 'articles'){?>
	<div class="btn-icon right" id="btn-category"><i class="fal fa-bars"></i></div>
	<?php }?>
</header>