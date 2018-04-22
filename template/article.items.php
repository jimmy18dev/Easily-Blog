<article class="article-items">
	<?php if(!empty($var['cover_id'])){?>
	<figure class="thumbnail">
		<a href="article/<?php echo $var['id'];?>">
			<img src="image/upload/<?php echo $var['id'];?>/square/<?php echo $var['cover_img'];?>" alt="">
		</a>
	</figure>
	<?php }else{?>
	<div class="icon"><i class="fal fa-file-alt"></i></div>
	<?php }?>
	<div class="content">
		<header>
			<p><?php echo $var['category_title'];?></p>
			<h2><a href="article/<?php echo $var['id'];?>/editor"><?php echo (!empty($var['title'])?$var['title']:'ไม่มีชื่อบทความ');?></a></h2>
		</header>
		<p class="info">
			<?php if($var['status'] == 'published'){?>
			<span class="btn-publish" data-id="<?php echo $var['id'];?>">เผยแพร่เมื่อ <?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?><i class="fal fa-check"></i></span>

			<?php if($var['sticky'] == 1){?>
			<span class="btn-sticky" data-id="<?php echo $var['id'];?>">ปักหมุดแล้ว<i class="fal fa-check"></i></span>
			<?php }else{?>
			<span class="btn-sticky active" data-id="<?php echo $var['id'];?>">ปักหมุด<i class="fal fa-star"></i></span>
			<?php }?>

			<?php }else{?>
			<span class="btn-publish" data-id="<?php echo $var['id'];?>">เผยแพร่<i class="fal fa-cloud-upload"></i></span>
			<?php }?>
		</p>
	</div>
</article>