<article class="article-items">
	<header>
		<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
	</header>
	<p class="info">
		<?php if($var['status'] == 'published'){?>
		<span><?php echo $var['category_title'];?></span> · <span><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></span>
		<?php }else{?>
		<span>ฉบับร่าง</span>
		<?php }?>
	</p>
</article>