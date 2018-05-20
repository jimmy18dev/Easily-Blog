<header class="header <?php echo (!empty($article->head_cover_img)?'transparent':'');?>">

	<div class="btn-icon"><i class="fal fa-star"></i></div>

	<a href="index.php" class="logo">
		<img src="image/logo.png" alt="">
		<span><?php echo $config['settings']['sitename_th'];?></span>
	</a>

	<?php if($current_page == 'home' || $current_page == 'articles'){?>
	<div class="btn-icon right" id="btn-category"><i class="fal fa-bars"></i></div>
	<?php }?>

	<?php if($current_page != 'search'){?>
	<a href="search" class="btn-icon right" title="ค้นหาบทความ"><i class="fal fa-search"></i></a>
	<?php }?>
</header>