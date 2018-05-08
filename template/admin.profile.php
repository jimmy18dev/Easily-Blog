<div class="pagehead">
	<div class="profile">
		<figure class="avatar">
			<img src="<?php echo (empty($user->fb_id)?'image/avatar.png':'https://graph.facebook.com/'.$user->fb_id.'/picture?type=large');?>" alt="Profile avatar">
		</figure>

        <div class="control">
            <a href="signout" title="ออกจากระบบ"><i class="fal fa-sign-out"></i></a>
            <a href="profile/edit">แก้ไขโปรไฟล์</a>
        </div>
		<div class="info">
			<h1><?php echo ((!empty($user->display))?$user->display:$user->fullname);?></h1>
			<p><?php echo $user->bio;?></p>
		</div>
	</div>
</div>