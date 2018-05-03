<div class="article-sticky">
	<figure class="image">
		<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
			<img src="image/upload/<?php echo $var['id'];?>/normal/<?php echo $var['cover_img'];?>" alt="">
		</a>
	</figure>
	<header>
		<span class="category"><?php echo $var['category_title'];?></span>
		<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>

		<?php if(!empty($var['description'])){?>
		<p><?php echo $var['description'];?></p>
		<?php }?>

		<p class="info">
			<span><i class="fal fa-user"></i><?php echo $var['author_name'];?></span>
			<span><i class="fal fa-clock"></i><?php echo $var['create_time'];?></span>
		</p>
	</header>
</div>