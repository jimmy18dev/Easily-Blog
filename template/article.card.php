<?php if($var['cover_type'] == 'horizontal'){?>
<article class="article-card highlight">
	<div class="wrapper">
		<?php if(!empty($var['cover_id'])){?>
		<figure class="thumbnail">
			<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
				<img src="image/upload/<?php echo $var['id'];?>/normal/<?php echo $var['cover_img'];?>" alt="">
			</a>
		</figure>
		<?php }?>
		<header>
			<span class="category"><?php echo $var['category_title'];?></span>
			<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
		</header>
	</div>
	<div class="info">
		<span><i class="fal fa-clock"></i><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></span>
	</div>
</article>
<?php }else{?>
<article class="article-card <?php echo (empty($var['cover_id'])?'gradient gradient-'.substr(strlen($var['title']),-1,1):'');?>">
	<div class="wrapper">
		<?php if(!empty($var['cover_id'])){?>
		<figure class="thumbnail">
			<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
				<img src="image/upload/<?php echo $var['id'];?>/square/<?php echo $var['cover_img'];?>" alt="">
			</a>
		</figure>
		<?php }?>
		<header>
			<span class="category"><?php echo $var['category_title'];?></span>
			<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
			<p><?php echo $var['description'];?></p>
		</header>
	</div>
	<div class="info">
		<span><i class="fal fa-clock"></i><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></span>
	</div>
</article>
<?php }?>