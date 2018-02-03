<?php
include_once'autoload.php';
$article 	= new Article();
$article_id = $_GET['article_id'];
$article->get($article_id);
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

<title>SEO Article</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<h1>SEO Article.</h1>


<div class="seo">
	<h2>Cover Image</h2>
	<div class="listImage">
		<?php foreach ($article->contents as $var) {?>
		<?php if($var['type'] == 'image'){?>
		<div class="cover-items" data-cover="<?php echo $var['id'];?>">
			<img src="image/upload/square/<?php echo $var['img_location'];?>" width="200" alt="">
		</div>
		<?php }?>
		<?php }?>
	</div>

	<h2>Article URL</h2>
	<input type="text" id="articleURL" value="<?php echo $article->url;?>" placeholder="Article URL...">
</div>

<input type="hidden" id="article_id" value="<?php echo $article->id;?>">

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/seo.js"></script>
</body>
</html>