<?php
include_once'autoload.php';
$category = new Category();
$category_id = $_GET['category_id'];
$categories = $category->listAll();

if(!empty($category_id)){
    $category->get($category_id);
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

<title>หมวดหมู่</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>

<div class="navigation">
    <div class="title"><?php echo (!empty($category->id)?'แก้ไขหมวดหมู่':'สร้างหมวดหมู่ใหม่');?></div>
	<a class="btn right" href="profile/category"><i class="fal fa-times"></i></a>
</div>

<div class="page-form">
	<div class="items">
		<div class="caption">ชื่อหมวดหมู่</div>
		<div class="content">
			<input type="text" id="title" autocomplete="off" value="<?php echo $category->title;?>">
            <div class="message">ไม่เกิน 20 ตัวอักษร</div>
		</div>
	</div>

    <div class="items">
        <div class="caption">ลิ้งค์</div>
        <div class="content">
            <input type="text" id="link" autocomplete="off" value="<?php echo $category->link;?>">
            <div class="message">ตัวอย่าง: Technology , Food-Review</div>
        </div>
    </div>

    <div class="items">
        <div class="caption">ไอคอน <a href="https://fontawesome.com/icons?d=gallery&s=light" target="_blank" title="เปิดตารางไอคอน"><i class="fal fa-info-circle"></i></a></div>
        <div class="content">
            <input type="text" id="icon" autocomplete="off" value="<?php echo $category->icon;?>">
            <div class="message">ตัวอย่าง: archive , bus , calendar</div>
        </div>
    </div>

	<div class="items">
		<div class="caption">เกี่ยวกับ</div>
		<div class="content">
			<textarea id="desc" autocomplete="off" placeholder="ไม่เกิน 140 ตัวอักษร"><?php echo $category->description;?></textarea>
		</div>
	</div>

    <input type="hidden" id="category_id" value="<?php echo $category->id;?>">

	<div class="items">
		<button id="btnSave">บันทึก</button>
	</div>

    <?php if(!empty($category->id)){?>
    <div class="delete">
        <h2>ลบหมวดหมู่นี้</h2>
        <p>บทความที่อยู่ในหมวดนี้จะถูกย้ายไปที่:</p>

        <select id="new_target">
            <?php foreach ($categories as $var) { if($category_id != $var['id']){?>
            <option value="<?php echo $var['id'];?>"><?php echo $var['title'];?></option>
            <?php }}?>
        </select>

        <button id="btn-delete">Delete</button>
    </div>
    <?php }?>
</div>

<input type="hidden" id="category_id" value="<?php echo $category->id;?>">

<div id="progressbar"></div>
<div id="overlay" class="overlay"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/tippy.all.min.js"></script>
<script type="text/javascript" src="js/lib/progressbar.js"></script>
<script type="text/javascript">
$(function(){
	$btnSave = $('#btnSave');
	var progressbar = $('#progressbar');

    $btnSave.click(function(){
    	progressbar.Progressbar('70%');

        var category_id = $('#category_id').val();
        var title = $('#title').val();
        var desc = $('#desc').val();
        var link = $('#link').val();
        var icon = $('#icon').val();

        $.ajax({
            url         :'api/category',
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'submit',
                category_id:category_id,
                title 		:title,
                desc: desc,
                icon:icon,
                link:link,
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
            $btnSave.removeClass('active');
        });
    });

    $('#btn-delete').click(function(){
        var category_id = $('#category_id').val();
        var new_target = $('#new_target').val();
        if(!confirm('คุณต้องการลบหมวดหมู่นี้ ใช่หรือไม่ ?')) return false
        $.ajax({
            url         :'api/category',
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'delete',
                category_id:category_id,
                new_target  :new_target
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
            window.location = 'profile/category';
        });
    });

    // $('input,textarea').on('input',function(event) {
    // 	$btnSave.addClass('active');
    // })
});
</script>
</body>
</html>