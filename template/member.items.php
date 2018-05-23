<div class="list-items">
	<div class="avatar">
		<?php if(!empty($var['avatar'])){?>
		<img src="image/upload/avatar/<?php echo $var['avatar'];?>">
		<?php }else{?>
		<img src="image/avatar.png">
		<?php }?>
	</div>
	<div class="detail <?php echo ($var['id'] != $user->id?'btn-3':'');?>">
		<div class="title">
			<?php
			if(!empty($var['display'])){
				echo $var['display'];
			}else if(!empty($var['fb_fname'])){
				echo $var['fb_fname'].' '.$var['fb_lname'];
			}else if(!empty($var['fname'])){
				echo $var['fname'].' '.$var['lname'];
			}?>
		</div>
		<div class="desc"><?php echo (!empty($var['bio'])?$var['bio']:$var['register_time']);?></div>
	</div>

	<?php if($var['id'] != $user->id){?>
	<div class="btn btn-type <?php echo ($var['type']=='admin'?'active':'');?>" data-id="<?php echo $var['id'];?>" data-type="admin" title="ผู้ดูแลระบบ">
		<i class="fal fa-user-cog"></i>
	</div>
	<div class="btn btn-type <?php echo ($var['type']=='writer'?'active':'');?>" data-id="<?php echo $var['id'];?>" data-type="writer" title="นักเขียน">
		<i class="fal fa-user-edit"></i>
	</div>
	<div class="btn btn-type <?php echo ($var['type']=='member'?'active':'');?>" data-id="<?php echo $var['id'];?>" data-type="member" title="สมาชิก">
		<i class="fal fa-user"></i>
	</div>
	<?php }?>
</div>