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
			<h2><a href="article/<?php echo $var['id'];?>/editor"><?php echo (!empty($var['title'])?$var['title']:'ไม่มีชื่อบทความ');?></a></h2>
		</header>
		<p class="info">
			<?php if($var['status'] == 'published'){?>
			<span title="เผยแพร่แล้ว"><i class="fa fa-circle"></i></span>
			<span><?php echo $var['category_title'];?> · <?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?></span>
			<?php }else{?>
			<span><i class="fal fa-pen-alt"></i></span>
			<span><?php echo $var['category_title'];?> · ฉบับร่าง</span>
			<?php }?>
		</p>
	</div>
</article>