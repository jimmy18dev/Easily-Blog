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

$homesection = new HomeSection;
$sections = $homesection->lists();

$category = new Category();
$categories = $category->listAll();
$current_page = 'section';
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

<title>ตั้งค่า | <?php echo $config['settings']['sitename_th'];?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>
<?php include_once 'template/admin.navigation.php'; ?>

<div class="pagehead">
    <div class="head fullsize">
        <h1>ตั้งค่าเว็บไซต์</h1>
    </div>
</div>

<?php if(count($categories) != count($sections)){?>
<div class="filter">
    <p>คุณสามารถเลือกหมวดหมู่ทที่ให้แสดงบนหน้าแรกของเว็บไซต์ โดยเลือกหมวดหมู่และระบุจำนวนบทความที่ต้องการให้แสดง</p>

    <div class="select">
        <select id="category_id">
            <option value="0" selected disabled hidden>เลือกหมวด</option>
            <?php foreach ($categories as $var) {?>
            <?php if(!in_array($var['id'],array_column($sections,'category_id'))){?>
            <option value="<?php echo $var['id'];?>"><?php echo $var['title'];?></option>
            <?php }?>
            <?php }?>
        </select>
    </div>
    <div class="select number" title="จำนวนบทความที่แสดง">
        <select id="total_items">
            <?php for($i=2;$i<=12;$i+=2){?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
            <?php }?>
        </select>
    </div>

    <button class="btn-create" id="btn-add">เพิ่ม</button>
</div>
<?php }?>

<div class="lists no-margin">
	<?php if(count($sections) > 0){?>
	<?php foreach ($sections as $var) { include 'template/section.items.php'; } ?>
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

    $('#category_id').change(function(){
        $('#btn-add').addClass('active');
    });

	// Article Sticky
    $('#btn-add').click(function(){
        $this = $(this);
        $this.removeClass('active');

        var category_id = $('#category_id').val();
        var total_items = $('#total_items').val();

        if(!category_id) return false;

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
        $items = $(this).parent();

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
            // $items.fadeOut(300);
            location.reload();
        });
    });

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

                setTimeout(function(){ location.reload(); },1000);
            });
        }
    });
});
</script>
</body>
</html>