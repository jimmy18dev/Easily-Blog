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
<header class="header fixed">
	<a href="search.php" class="btn left"><i class="fa fa-search" aria-hidden="true"></i><span>ค้นหา</span></a>
	
	<div class="logo">
		<a href="index.php">Peopleawesome</a>
	</div>

	<?php if($user_online){?>
	<?php include 'template/header.profile.php';?>
	<?php }else{?>
	<a href="signin" class="btn"><span>ลงชื่อเข้าใช้</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
	<?php }?>

	<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
	<div class="btn icon-only" id="btnOption">
		<i class="fa fa-ellipsis-h" aria-hidden="true"></i>

		<div class="toggle-panel" id="optionPanel">
			<div class="popover-arrow"></div>
			<ul>
				<?php if($article->status=='published'){?>
				<li id="btn-draft"><span class="">ยกเลิกเผยแพร่</span></li>
				<?php }?>

				<li id="btn-remove"><span class="logout">ลบบทความ</span></li>
			</ul>
		</div>
	</div>
	
	<a href="article/<?php echo $article->id;?>/editor" class="btn iconleft"><span>แก้ไขบทความ</span><i class="fa fa-pencil" aria-hidden="true"></i></a>
	<?php }?>
</header>

<article class="article">
	
	<!-- Article Header -->
	<header class="article-header">
		<h1><?php echo $article->title;?></h1>
		<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo (!empty($article->published_time)?'เผยแพร่เมื่อ '.$article->published_time:'เขียนเมื่อ '.$article->create_time);?></div>
		<?php if(!empty($article->description)){?>
		<p><?php echo $article->description;?></p>
		<?php }?>
	</header>

	<!-- Contents rendering -->
	<?php foreach ($article->contents as $var) {?>
		<?php if($var['type'] == 'textbox'){?>
		<article class="content">
			<?php if(!empty($var['topic'])){?>
			<h2><?php echo $var['topic'];?></h2>
			<?php }?>

			<?php if(!empty($var['body'])){?>
			<div class="body"><?php echo $var['bodytext'];?></div>
			<?php }?>
		</article>
		<?php }else if($var['type'] == 'image'){?>
		<figure class="content image">
			<?php if(!empty($var['img_location']) && file_exists('image/upload/normal/'.$var['img_location'])){?>
			<img src="image/upload/normal/<?php echo $var['img_location'];?>" alt="">
			<?php }else{?>
			<div class="image-not-found">ไม่พบรูปภาพ</div>
			<?php }?>

			<?php if(!empty($var['alt'])){?>
			<figcaption><?php echo $var['alt'];?></figcaption>
			<?php }?>
		</figure>
		<?php }else if($var['type'] == 'youtube'){?>
		<figure class="content youtube">
			<div class="videoWrapper <?php echo (empty($var['video_id'])?'hidden':'');?>">
				<iframe src="https://www.youtube.com/embed/<?php echo $var['video_id'];?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
			<?php if(!empty($var['alt'])){?>
			<figcaption><?php echo $var['alt'];?></figcaption>
			<?php }?>
		</figure>
		<?php }else if($var['type'] == 'quote'){?>
		<blockquote class="content">
			<i class="fa fa-quote-left" aria-hidden="true"></i>
			<p><?php echo $var['body'];?></p>
			<footer>–<cite><?php echo $var['topic'];?></cite></footer>
			<i class="fa fa-quote-right" aria-hidden="true"></i>
		</blockquote>
		<?php }else if($var['type'] == 'map'){?>
		<figure class="content image">
			<img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $var['lat'];?>,<?php echo $var['lng'];?>&zoom=16&size=800x500&scale=2&maptype=roadmap&markers=size:mid%7Ccolor:0xF44336%7C<?php echo $var['lat'];?>,<?php echo $var['lng'];?>&key=<?php echo GOOGLE_MAP_KEY;?>&style=element:geometry%7Ccolor:0xf5f5f5&style=element:labels.text.fill%7Ccolor:0x616161&style=element:labels.text.stroke%7Ccolor:0xf5f5f5&style=feature:administrative.land_parcel%7Celement:labels.text.fill%7Ccolor:0xbdbdbd&style=feature:poi%7Celement:geometry%7Ccolor:0xeeeeee&style=feature:poi%7Celement:labels.text.fill%7Ccolor:0x757575&style=feature:poi.park%7Celement:geometry%7Ccolor:0xe5e5e5&style=feature:poi.park%7Celement:labels.text.fill%7Ccolor:0x9e9e9e&style=feature:road%7Celement:geometry%7Ccolor:0xffffff&style=feature:road.arterial%7Celement:labels.text.fill%7Ccolor:0x757575&style=feature:road.highway%7Celement:geometry%7Ccolor:0xdadada&style=feature:road.highway%7Celement:labels.text.fill%7Ccolor:0x616161&style=feature:road.local%7Celement:labels.text.fill%7Ccolor:0x9e9e9e&style=feature:transit.line%7Celement:geometry%7Ccolor:0xe5e5e5&style=feature:transit.station%7Celement:geometry%7Ccolor:0xeeeeee&style=feature:water%7Celement:geometry%7Ccolor:0xc9c9c9&style=feature:water%7Celement:labels.text.fill%7Ccolor:0x9e9e9e" alt="">
			<?php if(!empty($var['alt'])){?>
			<figcaption><?php echo $var['alt'];?></figcaption>
			<?php }?>

			<a class="btn-open-map" title="แสดงเส้นทาง" href="http://maps.google.com/maps?q=<?php echo $var['lat'];?>,<?php echo $var['lng'];?>" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a>
		</figure>
		<?php }?>
	<?php } ?>

	<?php if(count($article->tags)>0){?>
	<div class="tag">
		<?php foreach ($article->tags as $var){ ?>
		<a href="tag/<?php echo $var['name'];?>">#<?php echo $var['name'];?></a>
		<?php } ?>
	</div>
	<?php }?>
</article>
<?php include_once 'footer.php';?>
<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/tippy.all.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script>
$(function(){
	tippy('[title]',{arrow: true});
});
</script>
</body>
</html>