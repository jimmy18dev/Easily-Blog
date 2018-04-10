<article class="article-items">
	<?php if(!empty($var['cover_id'])){?>
	<figure class="thumbnail">
		<a href="article/<?php echo $var['id'];?>">
			<img src="image/upload/<?php echo $var['id'];?>/square/<?php echo $var['cover_img'];?>" alt="">
		</a>
	</figure>
	<?php }?>
	<div class="content">
		<header>
			<h2><a href="article/<?php echo $var['id'];?>/editor"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
		</header>
		<p class="info">
			<span><?php echo(!empty($var['category_icon'])?'<i class="fal fa-'.$var['icon'].'"></i>':'<i class="fal fa-folder"></i>')?><?php echo $var['category_title'];?></span>
			<span><i class="fal fa-clock"></i><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></span>
		</p>
	</div>
</article>