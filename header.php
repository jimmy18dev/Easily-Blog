<header class="header fixed">
	<a href="search.php" class="btn left"><i class="fa fa-search" aria-hidden="true"></i><span>ค้นหา</span></a>
	
	<div class="logo">
		<a href="index.php">Peopleawesome</a>
	</div>

	<?php if($user_online){?>
	<div class="btn-profile" id="btnProfile">
		<img src="https://graph.facebook.com/1818320188/picture?type=square" alt="">

		<div class="toggle-panel" id="profilePanel">
			<div class="popover-arrow"></div>
			<ul>
				<li><a href="article/create" class="create">เขียนบทความ</a></li>
				<li><a href="profile">บทความของฉัน</a></li>
				<li class="separator"></li>
				<li><a href="#">ตั้งค่า</a></li>
				<li><a href="#">วิธีใช้</a></li>
				<li><a href="signout" class="logout">ออกจากระบบ</a></li>
			</ul>
		</div>
	</div>
	<?php }else{?>
	<a href="signin" class="btn"><span>ลงชื่อเข้าใช้</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
	<?php }?>

	<?php if(!empty($article->id)){?>
	<a href="article/<?php echo $article->id;?>/editor" class="btn"><span>แก้ไขบทความ</span><i class="fa fa-cog" aria-hidden="true"></i></a>
	<?php }?>
</header>