<?php
include_once'autoload.php';
$homesection = new HomeSection;
$sections = $homesection->lists();

$category = new Category();
$categories = $category->listAll();
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

<title>Section</title>

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
    <a href="profile">หมวดหมู่</a>
</div>

<div class="filter">
    <select id="category_id">
        <?php foreach ($categories as $var) {?>
        <?php if(!in_array($var['id'],$sections)){?>
        <option value="<?php echo $var['id'];?>"><?php echo $var['title'];?></option>
        <?php }?>
        <?php }?>
    </select>

    <input type="text" value="4" id="total_items" placeholder="Total items">
    <button class="btn-create" id="btn-add">เพิ่ม</button>
</div>

<div class="article-list">
	<?php if(count($sections) > 0){?>
	<?php foreach ($sections as $var) { include 'template/section.items.php'; } ?>
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

	// Article Sticky
    $('#btn-add').click(function(){
        $this = $(this);

        var category_id = $('#category_id').val();
        var total_items = $('#total_items').val();

        $.ajax({
            url         :'api/homesection',
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'create',
                category_id :category_id,
                total_items :total_items
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
            location.reload();
        });
    });

    // Delete
    $('.btn-delete').click(function(){
        var section_id = $(this).attr('data-id');

        $.ajax({
            url         :'api/homesection',
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'delete',
                section_id :section_id,
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
            location.reload();
        });
    });

    var current;
    var target;

    // Article Sticky
    $('.btn-swap').click(function(){
        // progressbar.Progressbar('60%');
        $this = $(this);

        if(!current)
            current = $(this).attr('data-id');
        else{
            target = $(this).attr('data-id');

            if(current == target){
                current = null;
                target = null;

                return false;
            }
        }

        console.log(current,target);

        if(current && target){
            console.log('Swap betweet: '+current+','+target);

            $.ajax({
                url         :'api/homesection',
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

                location.reload();
            });
        }
    });
});
</script>
</body>
</html>