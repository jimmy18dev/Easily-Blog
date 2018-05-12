<header class="header <?php echo (!empty($article->head_cover_img)?'transparent':'');?>">
	<div class="logo">
		<a href="index.php">
			<img src="image/logo.png" alt="">
			<span><?php echo $config['settings']['sitename_th'];?></span>
		</a>
	</div>

	<?php if($current_page == 'home' || $current_page == 'articles'){?>
	<div class="btn-icon right" id="btn-category"><i class="fal fa-bars"></i></div>
	<?php }?>

	<?php if($current_page != 'search' && false){?>
	<a href="search" class="btn-icon right" title="ค้นหาบทความ"><i class="fal fa-search"></i></a>
	<?php }?>

	<form class="search" action="search" method="GET">
		<span><i class="fal fa-search"></i></span>
		<input type="text" name="q" placeholder="ค้นหาบทความ" value="<?php echo $keyword;?>">
	</form>
</header>