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
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>
<header class="header">
	<a class="btn left" href="index.php"><i class="fal fa-arrow-left" aria-hidden="true"></i><span>หน้าแรก</span></a>
	<?php if($user_online){?>
	<a class="btn right" href="article/create"><i class="fal fa-plus"></i><span>เขียนบทความ</span></a>
	<?php }else{?>
	<a href="signin" class="btn"><span>ลงชื่อเข้าใช้</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
	<?php }?>

	<?php if(!empty($article->id) && $article->owner_id == $user->id){?>
	<a href="article/<?php echo $article->id;?>/editor" class="btn iconleft"><span>แก้ไขบทความ</span><i class="fa fa-cog" aria-hidden="true"></i></a>
	<?php }?>
</header>

<div class="pagehead">
	<div class="profile">
		<figure class="avatar">
			<img src="<?php echo (empty($user->fb_id)?'image/avatar.png':'https://graph.facebook.com/'.$user->fb_id.'/picture?type=large');?>" alt="Profile avatar">
		</figure>
		<div class="info">
			<h1><?php echo $user->fullname;?></h1>
			<p>Web developer and Web Designer at Abhaibhubejhr Hospital · <a href="#">แก้ไข<i class="fal fa-angle-right"></i></a></p>
		</div>
	</div>
	<div class="navi">
		<a href="profile/article/published" class="<?php echo ($status=='published'?'active':'');?>">แผยแพร่แล้ว<?php echo ($c_article['published']>0?' ('.$c_article['published'].')':'');?></a>
        <a href="profile/article/draft" class="<?php echo ($status=='draft'?'active':'');?>">ฉบับร่าง<?php echo ($c_article['draft']>0?' ('.$c_article['draft'].')':'');?></a>
	</div>
</div>

<div class="article-list">
	<?php if(count($articles) > 0){?>
	<?php foreach ($articles as $var) { include 'template/article.items.php'; } ?>
	<?php }else{?>
	<div class="empty">ไม่พบบทความ</div>
	<?php }?>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript">
$(function(){
	// Article Sticky
    $('.btn-sticky').click(function(){
    	console.log('Article Sticky!');
        var article_id = $(this).attr('data-id');

        $.ajax({
            url         :'api/article',
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'sticky',
                article_id  :article_id,
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            setTimeout(function(){
	            location.reload();
	        },1000);
        });
    });

    $('.btn-publish').click(function(){
    	
        var article_id = $(this).attr('data-id');

        $.ajax({
            url         :'api/article',
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'published',
                article_id  :article_id,
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            setTimeout(function(){
	            location.reload();
	        },1000);
        });
    });
});
</script>
</body>
</html>