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

<title><?php echo (!empty($category->id)?$category->title.' (แก้ไข)':'สร้างหมวดหมู่');?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>

<div class="header">
	<a class="btn-icon right" href="profile/category"><i class="fal fa-times"></i></a>
</div>

<div class="page-form">
	<div class="section">
        <h2><?php echo (!empty($category->id)?'แก้ไขหมวดหมู่':'สร้างหมวดหมู่');?></h2>
        <p>การตั้งชื่อหมวดหมู่ที่เข้าใจง่ายและไม่ยาวจนเกินไป จะช่วยให้บทความบนเว็บไซต์น่าสนใจมากยิ่งขึ้น</p>
        <input type="text" id="title" autocomplete="off" value="<?php echo $category->title;?>" placeholder="ชื่อหมวดหมู่">
        <textarea id="desc" autocomplete="off" placeholder="คำอธิบาย"><?php echo $category->description;?></textarea>
	</div>

    <div class="section">
        <h3>URL Friendly</h3>
        <p>เพิ่มความหมายให้กับลิงก์ของหมวดหมู่นี้ ตัวอย่างเช่น travels , Interview , รีวิวร้านอาหาร </p>
        <input type="text" id="link" autocomplete="off" value="<?php echo $category->link;?>">
        <p class="note">ตัวอย่าง: Technology , Food-Review</p>
    </div>

    <div class="section">
        <h3>ไอคอน</h3>
        <p>เพิ่มความน่าสนใจและช่วยให้ผู้อ่านจดจำหมวดหมู่นี้ได้ง่ายขึ้น เพียงคุณเปิด<a href="https://fontawesome.com/icons?d=gallery&s=light" target="_blank" title="เปิดตารางไอคอน">ตารางไอคอน</a> และนำชื่อมาใส่ในช่องด้านล่าง</p>
        <input type="text" id="icon" autocomplete="off" value="<?php echo $category->icon;?>">
        <p class="note">ตัวอย่าง: archive , bus , calendar</p>
    </div>

    <input type="hidden" id="category_id" value="<?php echo $category->id;?>">

	<div class="section">
		<button id="btnSave"><?php echo (!empty($category->id)?'บันทึกการเปลี่ยนแปลง':'สร้างหมวดหมู่ใหม่');?></button>
	</div>

    <?php if(!empty($category->id)){?>
    <div class="section">
        <h3>ลบหมวดหมู่</h3>
        <p>เมื่อหมวดหมู่ถูกลบแล้ว <strong>ไม่สามารถกู้คืนได้</strong> ขอให้คุณแน่ใจว่าต้องการลบจริง ซึ่งบทความที่อยู่ในหมวดนี้จะถูกย้ายไปที่:</p>
        <div class="select">
            <select id="new_target">
                <?php foreach ($categories as $var) { if($category_id != $var['id']){?>
                <option value="<?php echo $var['id'];?>"><?php echo $var['title'];?></option>
                <?php }}?>
            </select>
        </div>

        <button class="btn-delete" id="btn-delete">ลบหมวดหมู่นี้</button>
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