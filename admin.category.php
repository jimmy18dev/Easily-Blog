<?php
include_once'autoload.php';

if(!$user_online){
    header('Location: signin');
    die();
}
if($user->type != 'admin' && $user->type != 'writer'){
    header('Location: permission.php');
    die();
}

$category = new Category();
$categories = $category->listAll();
$current_page = 'category';
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

<title>หมวดหมู่ | <?php echo $config['settings']['sitename_th'];?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>
<?php include_once 'template/admin.navigation.php'; ?>

<div class="pagehead">
    <div class="head">
        <h1>หมวดหมู่</h1>
        <p>คุณมี <?php echo count($categories);?> หมวดหมู่</p>
    </div>
    <div class="action">
        <a class="btn-create active" href="profile/category/create">สร้างหมวดหมู่</a>
    </div>
</div>

<div class="lists">
	<?php if(count($categories) > 0){?>
	<?php foreach ($categories as $var) { include 'template/category.items.php'; } ?>
	<?php }else{?>
	<div class="empty">ไม่พบหมวดหมู่</div>
	<?php }?>
</div>

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

    var current;
    var target;

	// Article Sticky
    $('.btn-swap').click(function(){
        $this = $(this);
        $items = $(this).parent();

        if(!current){
            current = $(this).attr('data-id');
            $items.addClass('selected');
        }else{
            target = $(this).attr('data-id');

            if(current == target){
                current = null;
                target = null;
                $items.removeClass('selected');
                $(this).html('<i class="fal fa-sort"></i>');

                return false;
            }

            $items.addClass('selected');
        }

        $(this).html('<i class="fal fa-check"></i>');

        if(current && target){
            console.log('Swap betweet: '+current+','+target);

            $.ajax({
                url         :'api/category',
                cache       :false,
                dataType    :"json",
                type        :"POST",
                data:{
                    request     :'swap',
                    current  :current,
                    target:target
                },
                error: function (request, status, error){
                    console.log(request.responseText);
                }
            }).done(function(data){
                console.log(data);
                progressbar.Progressbar('100%');

                current = null;
                target = null;

                setTimeout(function(){ location.reload(); },1000);
            });
        }
    });
});
</script>
</body>
</html>