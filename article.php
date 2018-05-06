<?php
include_once 'autoload.php';
$article = new Article();

$article_id = $_GET['article_id'];
$article->get($article_id);
$related_content = $article->related($article->id);

if(!empty($article->url) && isset($article->url) && empty($_GET['title'])){
	header('Location: '.DOMAIN.'/article/'.$article->id.'/'.$article->url);
	die();
}

$current_page = '';
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
<meta name="viewport" content="user-scalable=yes">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<title><?php echo $article->title;?> - <?php echo $config['settings']['title'];?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>
<?php include_once 'header.php';?>

<!-- Article Content -->
<article class="article">
	<?php if(!empty($article->head_cover_img)){?>
	<!-- Article Header With Cover image -->
	<div class="article-cover">
		<picture>
			<source srcset="image/upload/<?php echo $article->id;?>/square/<?php echo $article->head_cover_img;?>" media="(min-width:0px) and (max-width :519px)">
			<source srcset="image/upload/<?php echo $article->id;?>/large/<?php echo $article->head_cover_img;?>">
			<img srcset="image/upload/<?php echo $article->id;?>/large/<?php echo $article->head_cover_img;?>" alt="My default image">
		</picture>
		<header class="article-header">
			<div class="author">
				<div class="avatar">
					<img src="<?php echo (empty($user->fb_id)?'image/avatar.png':'https://graph.facebook.com/'.$user->fb_id.'/picture?type=square');?>" alt="Profile avatar">
				</div>
				<div class="detail">
					<div class="name"><?php echo $article->owner_displayname;?></div>
					<div class="desc">Web Developer and Web Designer</div>
					<div class="desc"><?php echo $article->category_title;?> · <time datetime="2008-02-14 20:00"><?php echo $article->edit_time;?></time></span>
					</div>
				</div>
				<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
				<a class="btn-edit" href="article/<?php echo $article->id;?>/editor" title="แก้ไขบทความ">แก้ไข</a>
				<?php }?>
			</div>
			<h1><?php echo $article->title;?></h1>
		</header>
	</div>
	<?php }else{?>
	
	<!-- Article Header -->
	<header class="article-header">
		<div class="author">
			<div class="avatar">
				<img src="<?php echo (empty($user->fb_id)?'image/avatar.png':'https://graph.facebook.com/'.$user->fb_id.'/picture?type=square');?>" alt="Profile avatar">
			</div>
			<div class="detail">
				<div class="name"><?php echo $article->owner_displayname;?></div>
				<div class="desc">Web Developer and Web Designer</div>
				<div class="desc"><?php echo $article->category_title;?> · <time datetime="2008-02-14 20:00"><?php echo $article->edit_time;?></time></span>
				</div>
			</div>

			<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
			<a class="btn-edit" href="article/<?php echo $article->id;?>/editor" title="แก้ไขบทความ">แก้ไข</a>
			<?php }?>
		</div>

		<h1><?php echo $article->title;?></h1>
		<?php if(!empty($article->description)){?>
		<p class="desc"><?php echo $article->description;?></p>
		<?php }?>
	</header>
	<?php }?>

	<!-- Contents rendering -->
	<?php foreach ($article->contents as $var) {?>
		<?php if($var['type'] == 'textbox'){
			if(!empty($var['topic'])){
				echo '<section>';
				echo '<h2>'.$var['topic'].'</h2>';
				echo (!empty($var['bodytext'])?'<p>'.$var['bodytext'].'</p>':'');
				echo '</section>';
			}else{
				echo (!empty($var['bodytext'])?'<p class="content">'.$var['bodytext'].'</p>':'');
			}
		}else if($var['type'] == 'image'){?>

		<!-- Image or Photo -->
		<figure class="content image">
			<?php if(!empty($var['img_location']) && file_exists('image/upload/'.$article->id.'/normal/'.$var['img_location'])){?>
			<img src="image/upload/<?php echo $article->id;?>/normal/<?php echo $var['img_location'];?>" alt="<?php echo (!$var['alt']?$var['alt']:$article->title);?>">
			<?php }else{?>
			<div class="image-not-found">ไม่พบรูปภาพ</div>
			<?php }?>

			<?php if(!empty($var['alt'])){?>
			<figcaption><?php echo $var['alt'];?></figcaption>
			<?php }?>
		</figure>

		<?php }else if($var['type'] == 'youtube'){?>
		<!-- YouTube Embed -->
		<figure class="content youtube">
			<div class="videoWrapper <?php echo (empty($var['video_id'])?'hidden':'');?>">
				<iframe src="https://www.youtube.com/embed/<?php echo $var['video_id'];?>" allowfullscreen></iframe>
			</div>
			<?php if(!empty($var['alt'])){?>
			<figcaption><?php echo $var['alt'];?></figcaption>
			<?php }?>
		</figure>

		<?php }else if($var['type'] == 'quote'){?>
		<!-- Quote Block -->
		<blockquote class="content">
			<i class="fal fa-quote-left" aria-hidden="true"></i>
			<p><?php echo $var['body'];?></p>
			<footer>–<cite><?php echo $var['topic'];?></cite></footer>
			<i class="fal fa-quote-right" aria-hidden="true"></i>
		</blockquote>

		<?php }else if($var['type'] == 'map'){?>
		<!-- Google Map Embed -->
		<figure class="content image">
			<img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $var['lat'];?>,<?php echo $var['lng'];?>&zoom=16&size=800x500&scale=2&maptype=roadmap&markers=size:mid%7Ccolor:0xF44336%7C<?php echo $var['lat'];?>,<?php echo $var['lng'];?>&key=<?php echo GOOGLE_MAP_KEY;?>&style=element:geometry%7Ccolor:0xf5f5f5&style=element:labels.text.fill%7Ccolor:0x616161&style=element:labels.text.stroke%7Ccolor:0xf5f5f5&style=feature:administrative.land_parcel%7Celement:labels.text.fill%7Ccolor:0xbdbdbd&style=feature:poi%7Celement:geometry%7Ccolor:0xeeeeee&style=feature:poi%7Celement:labels.text.fill%7Ccolor:0x757575&style=feature:poi.park%7Celement:geometry%7Ccolor:0xe5e5e5&style=feature:poi.park%7Celement:labels.text.fill%7Ccolor:0x9e9e9e&style=feature:road%7Celement:geometry%7Ccolor:0xffffff&style=feature:road.arterial%7Celement:labels.text.fill%7Ccolor:0x757575&style=feature:road.highway%7Celement:geometry%7Ccolor:0xdadada&style=feature:road.highway%7Celement:labels.text.fill%7Ccolor:0x616161&style=feature:road.local%7Celement:labels.text.fill%7Ccolor:0x9e9e9e&style=feature:transit.line%7Celement:geometry%7Ccolor:0xe5e5e5&style=feature:transit.station%7Celement:geometry%7Ccolor:0xeeeeee&style=feature:water%7Celement:geometry%7Ccolor:0xc9c9c9&style=feature:water%7Celement:labels.text.fill%7Ccolor:0x9e9e9e" alt="Google Map">
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

<?php if(count($related_content) > 0){?>
<div class="section">
	<h3>บทความแนะนำ</h3>
	<div class="lists">
		<?php foreach ($related_content as $var) { include 'template/article.card.php'; } ?>
	</div>
</div>
<?php }?>

<?php include_once 'footer.php';?>

<input type="hidden" id="article_id" value="<?php echo $article->id;?>">
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/tippy.all.min.js"></script>
<script type="text/javascript" src="js/lib/progressbar.js"></script>
<script type="text/javascript" src="js/article.lib.js"></script>
<script type="text/javascript" src="js/article.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script>
$(function(){
	tippy('[title]',{arrow: true});
});
</script>
</body>
</html>