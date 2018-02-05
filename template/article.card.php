<?php if($var['cover_type'] == 'horizontal'){?>
<article class="items highlight">
	<div class="wrapper">
		<?php if(!empty($var['cover_id'])){?>
		<figure class="thumbnail">
			<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
			<img src="image/upload/normal/<?php echo $var['cover_img'];?>" alt="">
			</a>
		</figure>
		<?php }?>
		<header>
			<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
			<p><?php echo $var['description'];?></p>
		</header>
	</div>
	<div class="info">
		<a href="#"><?php echo $var['category_title'];?></a>
		<span><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></span>
	</div>
</article>
<?php }else{?>
<article class="items <?php echo (empty($var['cover_id'])?'gradient':'');?>">
	<div class="wrapper">
		<?php if(!empty($var['cover_id'])){?>
		<figure class="thumbnail">
			<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
			<img src="image/upload/square/<?php echo $var['cover_img'];?>" alt="">
			</a>
		</figure>
		<?php }?>
		<header>
			<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
			<p><?php echo $var['description'];?></p>
		</header>
	</div>
	<div class="info">
		<a href="#"><?php echo $var['category_title'];?></a>
		<span><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></span>
	</div>
</article>
<?php }?>