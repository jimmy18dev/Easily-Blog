<div class="btn btn-profile" id="btnProfile">
		<img src="<?php echo (empty($user->fb_id)?'image/avatar.png':'https://graph.facebook.com/'.$user->fb_id.'/picture?type=square');?>">

		<div class="toggle-panel" id="profilePanel">
			<div class="popover-arrow"></div>
			<ul>
				<li><a href="article/create" class="create">เขียนบทความ</a></li>
				<li><a href="profile">บทความของฉัน</a></li>
				<li class="separator"></li>
				<li><a href="#">ตั้งค่า</a></li>
				<li><a href="#">วิธีใช้</a></li>
				<li><a href="signout">ออกจากระบบ</a></li>
			</ul>
		</div>
	</div>