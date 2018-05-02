<?php
include_once'autoload.php';
$article = new Article();

$page = (!empty($_GET['page'])?$_GET['page']:1);
$perpage = 30;

$articles 	= $article->listAll(NULL,NULL,'author',$user->id,0,true,$page,$perpage);
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
</header>

<div class="pagehead">
	<div class="profile">
		<figure class="avatar">
			<img src="<?php echo (empty($user->fb_id)?'image/avatar.png':'https://graph.facebook.com/'.$user->fb_id.'/picture?type=large');?>" alt="Profile avatar">
		</figure>

        <div class="control">
            <a href="signout" title="ออกจากระบบ"><i class="fal fa-sign-out"></i></a>
            <a href="profile/edit">แก้ไขโปรไฟล์</a>
        </div>
		<div class="info">
			<h1><?php echo ((!empty($user->display))?$user->display:$user->fullname);?></h1>
			<p><?php echo $user->bio;?></p>
		</div>
	</div>
</div>

<div class="navi">
    <a href="profile" class="active">บทความ</a>
    <a href="profile/category">หมวดหมู่</a>
</div>

<div class="filter">
    <a class="btn-create" href="article/create">เขียนบทความ</a>
</div>

<div class="article-list" id="content">
	<?php if(count($articles['items']) > 0){?>
	<?php foreach ($articles['items'] as $var) { include 'template/article.items.php'; } ?>
	<?php }else{?>
	<div class="empty">ไม่พบบทความ</div>
	<?php }?>
</div>

<?php $total_page = ceil($articles['total_items'] / $perpage); ?>
<?php if($total_page > 1){?>
<div class="pagination">
    <?php for($i=1;$i<=$total_page;$i++){ ?>
    <a href="profile/article/page/<?php echo $i;?>#content" class="<?php echo ($page == $i?'active':'');?>"><?php echo $i;?></a>
    <?php }?>
</div>
<?php }?>

<div id="progressbar"></div>
<div id="overlay" class="overlay"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/lib/tippy.all.min.js"></script>
<script type="text/javascript" src="js/lib/progressbar.js"></script>
<script type="text/javascript">
$(function(){
    var progressbar = $('#progressbar');
    tippy('[title]',{arrow: true});

	// Article Sticky
    $('.btn-sticky').click(function(){
        progressbar.Progressbar('60%');
        $this = $(this);
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
            $this.toggleClass('active');
            progressbar.Progressbar('100%');
        });
    });

    $('.btn-publish').click(function(){
    	$this = $(this);
        var article_id = $(this).attr('data-id');
        progressbar.Progressbar('70%');

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
            $this.toggleClass('active');
            progressbar.Progressbar('100%');
         //    setTimeout(function(){
	        //     location.reload();
	        // },1000);
        });
    });
});
</script>
</body>
</html>