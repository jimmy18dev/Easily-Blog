<a class="btn-profile" href="profile">
	<span><?php echo $user->fullname;?></span>
	<img src="<?php echo (empty($user->fb_id)?'image/avatar.png':'https://graph.facebook.com/'.$user->fb_id.'/picture?type=square');?>" alt="Profile avatar">
</a>