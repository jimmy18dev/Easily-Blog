<div class="article-sticky">
	<figure class="image">
		<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
			<img src="image/upload/<?php echo $var['id'];?>/cover/<?php echo $var['cover_img'];?>" alt="">
		</a>
	</figure>
	<header>
		<span class="category"><?php echo $var['category_title'];?></span>
		<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>

		<?php if(!empty($var['description'])){?>
		<p><?php echo $var['description'];?></p>
		<?php }?>

		<p class="info"><span class="owner"><?php if(!empty($var['author_avatar'])){?><img src="image/upload/avatar/<?php echo $var['author_avatar'];?>" alt="<?php echo $var['author_name'];?>"><?php }?><?php echo $var['author_name'];?></span> · <?php echo $var['create_time'];?></p>
	</header>
</div>