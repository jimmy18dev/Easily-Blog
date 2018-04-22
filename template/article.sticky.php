<div class="article-pinned">
	<figure class="image">
		<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
			<img src="image/upload/<?php echo $var['id'];?>/normal/<?php echo $var['cover_img'];?>" alt="">
		</a>
	</figure>
	<header>
		<span class="category"><?php echo $var['category_title'];?></span>
		<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
		<p><?php echo $var['description'];?></p>
		<p><i class="fal fa-clock"></i><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></p>
	</header>
</div>