<div class="list-items">
	<div class="avatar">
		<?php if(!empty($var['avatar'])){?>
		<img src="image/upload/avatar/<?php echo $var['avatar'];?>">
		<?php }else{?>
		<img src="image/avatar.png">
		<?php }?>
	</div>
	<div class="detail">
		<div class="title"><?php echo $var['display'];?></div>
		<div class="desc"><?php echo $var['bio']?></div>
	</div>

	<?php if($var['id'] != $user->id){?>
	<div class="btn btn-type <?php echo ($var['type']=='admin'?'active':'');?>" data-id="<?php echo $var['id'];?>" data-type="admin" title="สลับตำแหน่ง">
		<i class="fal fa-user-cog"></i>
	</div>
	<div class="btn btn-type <?php echo ($var['type']=='writer'?'active':'');?>" data-id="<?php echo $var['id'];?>" data-type="writer" title="สลับตำแหน่ง">
		<i class="fal fa-user-edit"></i>
	</div>
	<div class="btn btn-type <?php echo ($var['type']=='member'?'active':'');?>" data-id="<?php echo $var['id'];?>" data-type="member" title="ลบออก">
		<i class="fal fa-user"></i>
	</div>
	<?php }?>
</div>