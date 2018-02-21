<?php if($var['cover_type'] == 'horizontal'){?>
<article class="article-items highlight">
	<div class="wrapper">
		<?php if(!empty($var['cover_id'])){?>
		<figure class="thumbnail">
			<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
				<img src="image/upload/<?php echo $var['id'];?>/normal/<?php echo $var['cover_img'];?>" alt="">
			</a>
		</figure>
		<?php }?>
		<header>
			<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
		</header>
	</div>
	<div class="info">
		<span><?php echo $var['category_title'];?></span>
		<span><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></span>
	</div>
</article>
<?php }else{?>
<article class="article-items <?php echo (empty($var['cover_id'])?'gradient gradient-'.substr(strlen($var['title']),-1,1):'');?>">
	<div class="wrapper">
		<?php if(!empty($var['cover_id'])){?>
		<figure class="thumbnail">
			<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
				<img src="image/upload/<?php echo $var['id'];?>/square/<?php echo $var['cover_img'];?>" alt="">
			</a>
		</figure>
		<?php }?>
		<header>
			<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
			<p><?php echo $var['description'];?></p>
		</header>
	</div>
	<div class="info">
		<span><?php echo $var['category_title'];?></span>
		<span><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></span>

		<?php if($var['owner_id'] == $user->id){?>
		<a href="article/<?php echo $var['id'];?>/editor" class="btn-edit">แก้ไข</a>
		<?php }?>
	</div>
</article>
<?php }?>