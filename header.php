<header class="header <?php echo (empty($category_id)?'fixed':'');?>">
	<div class="logo"><a href="index.php"><i class="fal fa-user-md"></i><span>อาชีวเวชกรรม</span></a></div>
	<?php foreach ($categories as $var) {?>
	<a class="nav <?php echo ($var['id'] == $category_id?'active':''); ?>" href="topic/<?php echo $var['id'];?><?php echo (!empty($var['link'])?'/'.$var['link']:'');?>"><?php echo $var['title'];?></a>
	<?php } ?>
	<a class="nav" href="about">เกี่ยวกับเรา</a>
	<!-- <span>Occmed Prachinburi</span> -->

	<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
	<a href="article/<?php echo $article->id;?>/editor" class="btn iconleft"><span>แก้ไขบทความ</span><i class="fa fa-cog" aria-hidden="true"></i></a>
	<?php }?>

	<?php if($user_online){?>
	<?php include 'template/header.profile.php';?>
	<?php }else{?>
	<a href="signin" class="btn"><span>สำหรับเจ้าหน้าที่</span><i class="fal fa-angle-right"></i></a>
	<?php }?>
</header>