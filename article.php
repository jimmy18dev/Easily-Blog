<?php
include_once 'autoload.php';
$article = new Article();

$article_id = $_GET['article_id'];
$article->get($article_id);

if(!empty($article->url) && isset($article->url) && empty($_GET['title'])){
	header('Location: '.DOMAIN.'/article/'.$article->id.'/'.$article->url);
	die();
}
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

<title><?php echo $article->title;?></title>
<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<?php include_once 'header.php';?>

<div class="article">
	<!-- Article Header -->
	<header class="article-header">
		<h1><?php echo $article->title;?></h1>
		<p><?php echo (!empty($article->edit_time)?'Edited '.$article->edit_time:$article->create_time);?></p>
		<p><?php echo $article->description;?></p>
	</header>

	<!-- Contents rendering -->
	<?php foreach ($article->contents as $var) {?>
	<?php if($var['type'] == 'textbox'){?>
	<div class="content">
		<h2><?php echo $var['topic'];?></h2>
		<p><?php echo $var['create_time'];?>, <?php echo $var['type'];?>, <?php echo $var['status'];?></p>
		<div class="body"><?php echo $var['body'];?></div>
	</div>
	<?php }else if($var['type'] == 'image'){?>
	<figure class="content">
		<img src="image/upload/normal/<?php echo $var['img_location'];?>" alt="">
		<figcaption><?php echo $var['img_alt'];?></figcaption>
	</figure>
	<?php }?>
	<?php } ?>
</div>
</body>
</html>