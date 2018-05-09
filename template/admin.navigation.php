<nav class="navigation">
	<div class="logo"><i class="fa fa-dove"></i><span class="version">Ver 0.0.1</span></div>

	<a href="profile" class="btn <?php echo ($current_page == 'article'?'active':'');?>"><i class="<?php echo ($current_page == 'article'?'fa':'fal');?> fa-archive"></i><span>บทความ</span></a>
    <a href="profile/category" class="btn <?php echo ($current_page == 'category'?'active':'');?>"><i class="<?php echo ($current_page == 'category'?'fa':'fal');?> fa-folder"></i><span>หมวดหมู่</span></a>
    <a href="profile/edit" class="btn <?php echo ($current_page == 'edit'?'active':'');?>"><i class="<?php echo ($current_page == 'edit'?'fa':'fal');?> fa-user"></i><span>ผู้เขียน</span></a>
    <a href="profile/section" class="btn <?php echo ($current_page == 'section'?'active':'');?>"><i class="<?php echo ($current_page == 'section'?'fa':'fal');?> fa-cog"></i><span>ตั้งค่า</span></a>

    <a href="index.php" class="btn-icon" title="ออกจากระบบจัดการ"><i class="fal fa-times"></i></a>
</nav>