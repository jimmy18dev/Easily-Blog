<?php
include_once 'autoload.php';

$article 			= new Article();
$article_id 		= $_GET['article_id'];
$article->get($article_id);

if(empty($article->id)){
    header('Location:'.DOMAIN.'/404.php');
    die();
}

$related_content 	= $article->related($article->id);

// Redirect to URL Friendly Page.
if(!empty($article->url) && isset($article->url) && empty($_GET['title'])){
	header('Location: '.DOMAIN.'/article/'.$article->id.'/'.$article->url);
	die();
}

$current_page = 'article';
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

<?php include'favicon.php';?>
<?php
$page_title 	= $article->title.' - '.$config['settings']['title'];
$page_desc 		= strip_tags($article->description);
$page_url 		= DOMAIN.'/article/'.$article->id.'/'.$article->url;
$page_image 	= DOMAIN.'/image/upload/'.$article->id.'/normal/'.$article->cover_img;
?>

<!-- Meta Tag Main -->
<meta name="description" 			content="<?php echo $page_desc;?>"/>
<meta property="og:title" 			content="<?php echo $page_title;?>"/>
<meta property="og:description" 	content="<?php echo $page_desc;?>"/>
<meta property="og:url" 			content="<?php echo $page_url;?>"/>
<meta property="og:image" 			content="<?php echo $page_image;?>"/>
<meta property="og:type" 			content="article"/>
<meta property="og:site_name" 		content="<?php echo $config['settings']['sitename_en'];?>"/>
<meta property="fb:app_id" 			content="<?php echo $config['facebook']['api_id'];?>"/>
<meta property="fb:admins" 			content="<?php echo $config['facebook']['admin_id'];?>"/>
<meta property="article:author" 	content="<?php echo $article->owner_fb_id;?>"/>
<meta property="article:publisher"	content="<?php echo $config['facebook']['publisher'];?>"/>

<meta itemprop="name" 				content="<?php echo $page_title;?>">
<meta itemprop="description" 		content="<?php echo $page_desc;?>">
<meta itemprop="image" 				content="<?php echo $page_image;?>">

<title><?php echo $page_title;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body class="paper">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=<?php echo $config['facebook']['api_id'];?>&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
					<img src="<?php echo (empty($article->owner_avatar)?'image/avatar.png':'image/upload/avatar/'.$article->owner_avatar);?>" alt="<?php echo $article->owner_displayname?>">
				</div>
				<div class="detail">
					<div class="name"><?php echo $article->owner_displayname;?></div>
					<div class="desc position">Web Developer and Web Designer</div>
					<div class="desc"><?php echo $article->category_title;?> · <time datetime="2008-02-14 20:00"><?php echo $article->edit_time;?></time></span>
					</div>
				</div>
				<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
				<a class="btn-edit" href="article/<?php echo $article->id;?>/editor?ref=onsite" title="แก้ไขบทความ">แก้ไข</a>
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
				<img src="<?php echo (empty($article->owner_avatar)?'image/avatar.png':'image/upload/avatar/'.$article->owner_avatar);?>" alt="<?php echo $article->owner_displayname?>">
			</div>
			<div class="detail">
				<div class="name"><?php echo $article->owner_displayname;?></div>
				<div class="desc position">Web Developer and Web Designer</div>
				<div class="desc"><?php echo $article->category_title;?> · <time datetime="2008-02-14 20:00"><?php echo $article->edit_time;?></time></span>
				</div>
			</div>

			<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
			<a class="btn-edit" href="article/<?php echo $article->id;?>/editor?ref=onsite" title="แก้ไขบทความ">แก้ไข</a>
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
			<i class="fa fa-quote-left" aria-hidden="true"></i>
			<p><?php echo $var['body'];?></p>
			<footer>— <cite><?php echo $var['topic'];?></cite></footer>
			<i class="fa fa-quote-right" aria-hidden="true"></i>
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

	<?php if(count($article->documents) > 0){?>
	<div class="documents">
		<h2>ไฟล์เอกสาร</h2>
		<?php foreach ($article->documents as $var) {?>
		<a href="files/<?php echo $var['file_name'];?>" class="document-items" target="_blank">
			<span class="icon"><i class="fa fa-file"></i></span>
			<span class="detail">
				<span class="name"><?php echo $var['title'];?></span>
				<span class="desc">ขนาด <?php echo $var['file_size'];?> (<?php echo $var['file_type'];?>)</span>
			</span>
		</a>
		<?php }?>
	</div>
	<?php }?>

	<?php if(count($article->tags)>0){?>
	<div class="tag">
		<?php foreach ($article->tags as $var){ ?>
		<a href="tag/<?php echo $var['name'];?>">#<?php echo $var['name'];?></a>
		<?php } ?>
	</div>
	<?php }?>
</article>

<div class="sharing">
	<h3>ส่งต่อบทความนี้</h3>
	<span>
		<div class="fb-share-button" data-href="<?php echo $page_url;?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Figensite.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
	</span>
	<span>
		<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="small" data-text="<?php echo $page_title;?>" data-url="<?php echo $page_url;?>" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	</span>
	<span>
		<div class="line-it-button" data-lang="en" data-type="share-a" data-url="<?php echo $page_url;?>" style="display: none;"></div><script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
	</span>
</div>

<?php if($article->qrcode){?>
<div class="qrcode">
	<h3>อ่านต่อในมือถือ</h3>
	<div class="qrcode-img">
		<img src="image/qrcode/article_<?php echo $article->id;?>.png" alt="">
	</div>
	<div class="guild">
		<p><strong>iPhone,iPad</strong> - เปิดแอปกล้องและส่องไปที่ QR code จากนั้นจะมี Notification ขึ้นมาด้านบน แสดงเป็น URL คุรสามารถกดที่ Notification และจะลิงก์ไปที่ Safari อัตโนมัติ</p>
		<p><strong>Android</strong> - เปิดแอป LINE แล้วไปที่ More แตะไปที่ไอค่อน QR Code จากนั้นก็เริ่มทำการสแกนได้เลย แตะ Open หากเป็น  QR Code ของลิงค์ต่างๆ ซึ่งจะแสดง URL หรือชื่อลิงค์ให้เห็นด้วย</p>
	</div>
</div>
<?php }?>

<?php if($article->fb_comment){?>
<div class="facebook-comment">
	<h3>ร่วมแสดงความคิดเห็น</h3>
	<div class="fb-comments" data-href="<?php echo $page_url;?>" data-width="100%" data-numposts="5"></div>
</div>
<?php }?>

<?php if($article->related_content && count($related_content) > 0){?>
<div class="section related">
	<h3>บทความแนะนำ</h3>
	<div class="lists">
		<?php foreach ($related_content as $var) { include 'template/article.card.php'; } ?>
	</div>
</div>
<?php }?>

<?php include_once 'footer.php';?>

<input type="hidden" id="article_id" value="<?php echo $article->id;?>">

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