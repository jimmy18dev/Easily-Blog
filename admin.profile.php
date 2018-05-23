<?php
include_once'autoload.php';

if(!$user_online){
    header('Location: '.DOMAIN.'/signin');
    die();
}
if($user->type != 'admin' && $user->type != 'writer'){
    header('Location: '.DOMAIN.'/permission.php');
    die();
}

$article = new Article();
$page = (!empty($_GET['page'])?$_GET['page']:1);
$perpage = 5;

$articles = $article->listAll(NULL,NULL,'author',$user->id,0,false,$page,$perpage);

if($page == 1){
    $article_sticky = $article->listSticky();
}

$c_article 	= $article->counter($user->id);
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
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<?php include'favicon.php';?>

<title>บทความ | <?php echo $config['settings']['sitename_th'];?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>
<?php include_once 'template/admin.navigation.php'; ?>

<div class="pagehead">
    <div class="head">
        <h1>บทความ</h1>
        <p>จัดการบทความของคุณทั้งหมด ได้จากหน้านี้</p>
    </div>
    <div class="action">
        <a class="btn-create active" title="เขียนบทความใหม่" href="article/create">เขียน</a>
    </div>
</div>

<?php if($page == 1 && count($article_sticky) > 0){?>
<div class="lists">
    <?php if(count($article_sticky) > 0){?>
    <?php foreach ($article_sticky as $var) { include 'template/article.items.php'; } ?>
    <?php }?>
</div>
<?php }?>

<div class="lists">
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
    <a href="profile/article/page/<?php echo $i;?>" class="<?php echo ($page == $i?'active':'');?>"><?php echo $i;?></a>
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
            progressbar.Progressbar('100%');

            setTimeout(function(){
                location.reload();
            },1000);
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
            $this.html('<i class="fas fa-spinner fa-pulse"></i>');
            progressbar.Progressbar('100%');

            setTimeout(function(){ location.reload(); },1000);
        });
    });
});
</script>
</body>
</html>