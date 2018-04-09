<article class="article-items">
	<figure class="thumbnail">
		<?php if(!empty($var['cover_id'])){?>
		<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
			<img src="image/upload/<?php echo $var['id'];?>/square/<?php echo $var['cover_img'];?>" alt="">
		</a>
		<?php }else{?>
		<i class="fal fa-file-alt"></i>
		<?php }?>
	</figure>
	<div class="content">
		<header>
			<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
		</header>
		<p class="info">
			<?php if($var['status'] == 'published'){?>
			<span><i class="fal fa-check-circle"></i> · <?php echo $var['category_title'];?></span> · <span><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></span>
			<?php }else{?>
			<span><i class="fal fa-lock-alt"></i> · ฉบับร่าง</span>
			<?php }?>
		</p>
	</div>
	<div class="stat">
		<div class="v">0</div>
		<div class="c">Read</div>
	</div>
</article>