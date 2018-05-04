<footer class="footer">
	<a href="#">เกี่ยวกับเรา</a>
	<a href="https://www.messenger.com/t/prachindaily">ติดต่อเรา</a>
	<a href="http://creativecommons.org/licenses/by/4.0/" title="ผลงานนี้ ใช้สัญญาอนุญาตของครีเอทีฟคอมมอนส์แบบ แสดงที่มา 4.0 International">© <?php echo date('Y'); ?> <?php echo $config['settings']['sitename_en'];?></a>

	<?php if($user_online){?>
	<a class="right" href="signout">ออกจาระบบ</a>
	<a class="right" href="profile" title="<?php echo $user->fullname;?>"><img src="<?php echo (empty($user->fb_id)?'image/avatar.png':'https://graph.facebook.com/'.$user->fb_id.'/picture?type=square');?>" alt="Profile avatar">จัดการเว็บไซต์
	</a>
	<?php }else{?>
	<a class="btn right" href="signin">ผู้ดูแลระบบ</a>
	<?php }?>
</footer>