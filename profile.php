<?php
include_once'autoload.php';
$article = new Article();

if(!empty($_GET['status'])){
	$status = $_GET['status'];
}else{
	$status = 'draft';
}

$articles 	= $article->listAll(NULL,NULL,NULL,$status,$user->id);
$c_article 	= $article->counter($user->id);
?>

<!doctype html>
<html lang="en-US" itemscope itemtype="http://schema.org/Blog" prefix="og: http://ogp.me/ns#">
<head>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<title><?php echo $user->fullname;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/slideshow.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<header class="header fixed editor-bar">
	<a class="btn left" href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i><span>กลับหน้าแรก</span></a>
	
	<?php if($user_online){?>
	<?php include 'template/header.profile.php';?>
	<?php }else{?>
	<a href="signin" class="btn"><span>ลงชื่อเข้าใช้</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
	<?php }?>

	<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
	<a href="article/<?php echo $article->id;?>/editor" class="btn iconleft"><span>แก้ไขบทความ</span><i class="fa fa-cog" aria-hidden="true"></i></a>
	<?php }?>
</header>

<div class="pagehead">
	<h2><?php echo $user->fullname;?></h2>
	<a href="profile/article/draft" class="<?php echo ($status=='draft'?'active':'');?>">ฉบับร่าง<?php echo ($c_article['draft']>0?' ('.$c_article['draft'].')':'');?></a>
	<a href="profile/article/published" class="<?php echo ($status=='published'?'active':'');?>">แผยแพร่แล้ว<?php echo ($c_article['published']>0?' ('.$c_article['published'].')':'');?></a>
</div>

<div class="article-list">
	<?php if(count($articles) > 0){?>
	<?php foreach ($articles as $var) { include 'template/article.card.php'; } ?>
	<?php }else{?>
	<div class="empty">ไม่พบบทความ</div>
	<?php }?>
</div>

<?php if(count($articles)>0){
	include_once 'footer.php';
}?>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>