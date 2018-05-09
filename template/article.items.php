<article class="article-items" id="<?php echo $var['id'];?>">
	<?php if(!empty($var['cover_id'])){?>
	<figure class="thumbnail">
		<a href="article/<?php echo $var['id'];?>">
			<img src="image/upload/<?php echo $var['id'];?>/square/<?php echo $var['cover_img'];?>" alt="">
		</a>
	</figure>
	<?php }else{?>
	<div class="icon"><i class="fal fa-file-alt"></i></div>
	<?php }?>
	<div class="content <?php echo ($var['status'] == 'published'?'fullsize':'');?>">
		<p><?php echo $var['category_title'];?></p>
		<h2><a href="article/<?php echo $var['id'];?>/editor"><?php echo (!empty($var['title'])?$var['title']:'ไม่มีชื่อบทความ');?></a></h2>
		<p><?php echo ($var['status'] == 'published'?'<i class="fas fa-check-circle" title="เผยแพร่แล้ว"></i>':'');?><?php echo (!empty($var['edit_time'])?$var['edit_time']:$var['create_time']);?><?php echo ($var['status'] != 'published'?' (ฉบับร่าง)':'');?></p>
	</div>

	<?php if($var['status'] != 'published'){?>
	<div class="btn-publish" data-id="<?php echo $var['id'];?>" title="เผยแพร่บทความ"><i class="fal fa-check"></i></div>
	<?php }else{?>
	<span class="sticky btn-sticky <?php echo ($var['sticky'] == 1?'active':'');?>" data-id="<?php echo $var['id'];?>" title="<?php echo ($var['sticky'] == 1?'ยกเลิกปักหมุด':'ปักหมุด');?>"></span>
	<?php }?>
</article>