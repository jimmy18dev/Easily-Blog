<div class="list-items">
	<div class="icon"><i class="fal fa-<?php echo (!empty($var['icon'])?$var['icon']:'archive');?>"></i></div>
	<div class="detail btn-2">
		<div class="title"><?php echo $var['title'];?></div>
		<div class="desc"><?php echo (!empty($var['description'])?$var['description']:'<a href="profile/category/edit/'.$var['id'].'">เพิ่มรายละเอียด</a>');?></div>
	</div>
	<div class="btn btn-swap" data-id="<?php echo $var['id'];?>" title="สลับตำแหน่ง"><i class="fa fa-sort"></i></div>
	<a class="btn" href="profile/category/edit/<?php echo $var['id'];?>" title="แก้ไข"><i class="fal fa-cog"></i></a>
</div>