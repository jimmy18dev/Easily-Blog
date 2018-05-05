<article class="related-items">
	<header class="<?php echo (empty($var['cover_img'])?'fullsize':'');?>">
		<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
		<p><span class="owner"><?php echo $var['author_name'];?></span> · <?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></p>
	</header>
	<?php if(!empty($var['cover_id'])){?>
	<figure class="thumbnail">
		<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
			<img src="image/upload/<?php echo $var['id'];?>/square/<?php echo $var['cover_img'];?>" alt="">
		</a>
	</figure>
	<?php }?>
</article>