<header class="header">
	<div class="btn left"><i class="fa fa-search" aria-hidden="true"></i></div>
	
	<div class="logo">
		<a href="index.php">Peopleawesome</a>
	</div>

	<div class="btn-profile" id="btnProfile">
		<img src="https://graph.facebook.com/1818320188/picture?type=square" alt="">

		<div class="toggle-panel" id="profilePanel">
			<div class="popover-arrow"></div>
			<ul>
				<li><a href="article/create">เขียนบทความ</a></li>
				<li><a href="profile">บทความของฉัน</a></li>
				<li class="separator"></li>
				<li><a href="#">ตั้งค่า</a></li>
				<li><a href="#">วิธีใช้</a></li>
				<li><a href="signout" class="logout">ออกจากระบบ</a></li>
			</ul>
		</div>
	</div>

	<?php if(!empty($article->id)){?>
	<a href="article/<?php echo $article->id;?>/editor" class="btn">แก้ไขบทความ</a>
	<?php }?>
</header>