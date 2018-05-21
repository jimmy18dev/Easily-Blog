<header class="header <?php echo (!empty($article->head_cover_img)?'transparent':'');?>">
	<?php if($current_page == 'home' || $current_page == 'articles'){?>
	<div class="btn-icon" id="btn-category"><i class="fal fa-bars"></i></div>
	<?php }?>

	<?php if($current_page == 'article'){?>
	<a href="index.php" class="btn-icon" id="btn-back"><i class="fal fa-arrow-left"></i></a>
	<?php }?>

	<a href="index.php" class="logo">
		<img src="image/logo.png" alt="">
		<span><?php echo $config['settings']['sitename_th'];?></span>
	</a>

	<?php if($current_page != 'search'){?>
	<a href="search" class="btn-icon right" title="ค้นหาบทความ"><i class="fal fa-search"></i></a>
	<?php }?>
</header>