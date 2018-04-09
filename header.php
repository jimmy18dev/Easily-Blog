<header class="header fixed">
	<div class="logo"><a href="index.php">Peopleawesome</a></div>
	
	<?php if($user_online){?>
	<?php include 'template/header.profile.php';?>
	<?php }else{?>
	<a href="signin" class="btn"><span>ลงชื่อเข้าใช้</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
	<?php }?>

	<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
	<a href="admin/article/<?php echo $article->id;?>/editor" class="btn iconleft"><span>แก้ไขบทความ</span><i class="fa fa-cog" aria-hidden="true"></i></a>
	<?php }?>
</header>