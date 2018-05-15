<nav class="header">
	<a href="profile" class="menu <?php echo ($current_page == 'article'?'active':'');?>"><i class="<?php echo ($current_page == 'article'?'fa':'fal');?> fa-archive"></i><span>บทความ</span></a>
    <a href="profile/category" class="menu <?php echo ($current_page == 'category'?'active':'');?>"><i class="<?php echo ($current_page == 'category'?'fa':'fal');?> fa-folder"></i><span>หมวดหมู่</span></a>
    <a href="profile/edit" class="menu <?php echo ($current_page == 'edit'?'active':'');?>"><i class="<?php echo ($current_page == 'edit'?'fa':'fal');?> fa-user"></i><span>นักเขียน</span></a>
    <a href="profile/section" class="menu <?php echo ($current_page == 'section'?'active':'');?>"><i class="<?php echo ($current_page == 'section'?'fa':'fal');?> fa-cog"></i><span>ตั้งค่า</span></a>
    <a href="index.php" class="menu right"><i class="fal fa-sign-out"></i><span>ออก</span></a>
</nav>