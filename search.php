<?php
include_once'autoload.php';


isset($_GET['q']) ? $keyword = trim($_GET['q']) : $keyword = '';

$article = new Article();
$articles = [];

if(!empty($keyword)){
	$articles = $article->listAll(NULL,$keyword,'published',NULL,20,true,NULL,NULL);
}
$current_page = 'search';
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

<title>ค้นหา<?php echo (!empty($keyword)?' "'.$keyword.'"':'');?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/slideshow.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>
<header class="header">
	<a href="index.php" class="btn-icon"><i class="fal fa-arrow-left"></i></a>

	<form action="search" method="GET">
		<button type="submit" class="btn-icon right"><i class="fal fa-search"></i></button>
		<input type="text" name="q" placeholder="ค้นหาบทความ..." value="<?php echo $keyword;?>" autofocus>
	</form>
</header>

<div class="section">
	<div class="lists">
		<?php if(isset($articles['items']) && count($articles['items']) > 0){?>
		<?php foreach ($articles['items'] as $var) { include 'template/article.card.php'; } ?>
		<?php }else{?>
		<?php if(!empty($keyword)){?>
		<div class="empty">ไม่พบบทความเกี่ยวกับ "<?php echo $keyword;?>"</div>
		<?php }?>
		<?php }?>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>