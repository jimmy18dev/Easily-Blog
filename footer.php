<footer class="footer">
	<div class="link">
		<a href="#">เกี่ยวกับเรา</a>
		<a href="https://www.messenger.com/t/prachindaily">ติดต่อเรา</a>

		<?php if($user_online){?>
		<a class="right" href="profile" title="<?php echo $user->fullname;?>"><i class="fal fa-cog"></i>จัดการเว็บไซต์</a>
		<a class="right" href="/signout">ออกจากระบบ</a>
		<?php }else{?>
		<a class="btn right" href="signin">ผู้ดูแลระบบ</a>
		<?php }?>
	</div>

	<div class="license">© <?php echo date('Y'); ?> <?php echo $config['settings']['sitename_en'];?> ผลงานนี้ ใช้สัญญาอนุญาตของครีเอทีฟคอมมอนส์แบบ แสดงที่มา 4.0 International </div>
</footer>