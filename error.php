<?php
require_once 'autoload.php';
$e = $_GET['e'];
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

<title>พบปัญหาในการเข้าถึง!</title>
<base href="<?php echo DOMAIN;?>">
<!-- CSS -->
<link rel="stylesheet" href="css/style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

</head>
<body>
<div class="announce">
	<?php if($e == 'NotOwner'){?>
		<h2>คุณไม่ใช่เจ้าของบทความนี้!</h2>
		<p>บทความนี้อนุญาตให้แก้ไขได้เฉพาะผู้ที่สร้างเท่านั้น หากคุณมั่นใจว่าคุณเป็นเจ้าของบทความนี้จริง กรุณาติดต่อผู้ดูแลระบบ</p>

		<div class="control">
			<a href="<?php echo DOMAIN;?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับหน้าแรก</a>
		</div>
	<?php }else if($e == 'UserNotLogin'){?>
		<h2>สำหรับเจ้าหน้าที่เท่านั้น!</h2>
		<p>เอกสารนี้สามารถเข้าถึงได้เฉพาะเจ้าหน้าที่ของโรงพยาบาลเท่านั้น กรุณาเข้าระบบและทดลองเปิดไฟล์นี้อีกครั้ง หากพบปัญหาการใช้งาน กรุณาติดต่อที่ <strong>admin@cpa.go.th</strong> ขอบคุณค่ะ</p>

		<div class="control">
			<a href="<?php echo DOMAIN;?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับหน้าแรก</a>
			<a href="signin" class="right">ลงชื่อเข้าใช้<i class="fa fa-angle-right" aria-hidden="true"></i></a>
		</div>
	<?php }else if($e == 'NotOwner'){?>
		<h2>คุณไม่ใช่เจ้าของเอกสาร!</h2>
		<p>เราพบว่าคุณ <strong><?php echo (!empty($user->fname)?$user->fullname:$user->fb_fname);?></strong> ไม่ใช่เจ้าของเอกสารดังกล่าว จึงไม่มีสิทธิ์ในแก้ไขหรือลบเอกสารได้ หากคุณแน่ใจว่าเป็นเจ้าของเอกสารจริง กรุณาติดต่อที่ <strong>admin@cpa.go.th</strong> ขอบคุณค่ะ</p>

		<div class="control">
			<a href="<?php echo DOMAIN;?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>กลับหน้าแรก</a>
		</div>
	<?php }?>
</div>
</body>
</html>