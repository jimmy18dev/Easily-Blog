<div class="category-items">
	<div class="icon"><i class="fal fa-<?php echo (!empty($var['icon'])?$var['icon']:'archive');?>"></i></div>
	<div class="detail">
		<div class="title"><?php echo $var['category_title'];?></div>
		<div class="desc">แสดง <?php echo $var['total_items']?> บทความ</div>
	</div>
	<div class="btns btn-swap" data-id="<?php echo $var['id'];?>" title="สลับตำแหน่ง"><i class="fa fa-sort"></i></div>
	<div class="btns btn-delete" data-id="<?php echo $var['id'];?>" title="ลบออก"><i class="fal fa-times"></i></div>
</div>