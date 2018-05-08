<nav class="navigation">
	<div class="logo"><i class="fa fa-dove"></i></div>
	<a href="profile" class="btn <?php echo ($current_page == 'article'?'active':'');?>"><i class="fal fa-archive"></i><span>บทความ</span></a>
    <a href="profile/category" class="btn <?php echo ($current_page == 'category'?'active':'');?>"><i class="fal fa-folder"></i><span>หมวดหมู่</span></a>
    <a href="profile/section" class="btn <?php echo ($current_page == 'section'?'active':'');?>"><i class="fal fa-list-alt"></i><span>แก้ไขหน้าแรก</span></a>
    <a href="profile/edit" class="btn <?php echo ($current_page == 'edit'?'active':'');?>"><i class="fal fa-user"></i><span>โปรไฟล์</span></a>

    <a href="index.php" class="btn-icon" title="ออกจากระบบจัดการ"><i class="fal fa-times"></i></a>
</nav>