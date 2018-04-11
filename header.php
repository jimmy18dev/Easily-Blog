<header class="header fixed">
	<div class="logo"><a href="index.php"><i class="fal fa-user-md"></i><span>Occmed Prachinburi</span></a></div>

	<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
	<a href="article/<?php echo $article->id;?>/editor" class="btn iconleft"><span>แก้ไขบทความ</span><i class="fa fa-cog" aria-hidden="true"></i></a>
	<?php }?>

	<?php if($user_online){?>
	<?php include 'template/header.profile.php';?>
	<?php }else{?>
	<a href="signin" class="btn btn-login"><span>สำหรับเจ้าหน้าที่</span><i class="fal fa-angle-right"></i></a>
	<?php }?>
</header>