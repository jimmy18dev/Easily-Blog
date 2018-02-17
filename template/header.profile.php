<div class="btn-profile" id="btnProfile">
		<img src="<?php echo (empty($user->fb_id)?'image/avatar.png':'https://graph.facebook.com/'.$user->fb_id.'/picture?type=square');?>">

		<div class="toggle-panel" id="profilePanel">
			<div class="popover-arrow"></div>
			<ul>
				<li><a href="article/create" class="create"><i class="fa fa-pencil" aria-hidden="true"></i>เขียนบทความ</a></li>
				<li><a href="profile"><i class="fa fa-file-text-o" aria-hidden="true"></i>บทความของฉัน</a></li>
				<li class="separator"></li>
				<li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i>ตั้งค่า</a></li>
				<li><a href="#"><i class="fa fa-question" aria-hidden="true"></i>วิธีใช้</a></li>
				<li><a href="signout" class="logout"><i class="fa fa-sign-out" aria-hidden="true"></i>ออกจากระบบ</a></li>
			</ul>
		</div>
	</div>