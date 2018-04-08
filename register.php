<?php
require_once 'autoload.php';
if($user_online){
	header('Location: index.php');
	die();
}

$signature 	= new Signature;
$currentPage = 'register';
?>

<!DOCTYPE html>
<html lang="en">

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<?php
$p_title 	= 'ลงทะเบียนใหม่ '.TITLE;
$p_desc 	= DESCRIPTION;
$p_url 		= DOMAIN.'/signup';
?>

<!-- Meta Tag Main -->
<meta name="description" content="<?php echo $p_desc;?>"/>
<meta property="og:title" content="<?php echo $p_title;?>"/>
<meta property="og:description" content="<?php echo $p_desc;?>"/>
<meta property="og:url" content="<?php echo $p_url;?>"/>
<meta property="og:image" content="<?php echo OGIMAGE;?>"/>
<meta property="og:type" content="website"/>
<meta property="og:site_name" content="<?php echo SITENAME;?>"/>
<meta property="fb:app_id" content="<?php echo APP_ID;?>"/>
<meta property="fb:admins" content="<?php echo ADMIN_ID;?>"/>

<meta itemprop="name" content="<?php echo $p_title;?>">
<meta itemprop="description" content="<?php echo $p_desc;?>">
<meta itemprop="image" content="<?php echo OGIMAGE;?>">

<title><?php echo $p_title;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<div class="loginhead">
	<h1>อาชีวเวชกรรมและเวชกรรมสิ่งแวดล้อม</h1>
	<p>Occupational and Environmental medicine</p>
</div>
<div class="login">
	<div class="content">
		<form action="javascript:register();">
			<input type="text" class="inputtext" id="fullname" placeholder="ชื่อ-นามสกุล" autofocus>
			<input type="phone" class="inputtext" id="phone" placeholder="เบอร์โทรศัพท์">
			<input type="email" class="inputtext" id="email" placeholder="ที่อยู่อีเมล">
			<input type="password" class="inputtext" id="password" placeholder="ตั้งรหัสผ่าน">
			<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('register',SECRET_KEY);?>">
			<input type="hidden" id="redirect" value="<?php echo $_GET['redirect'];?>">
			<button type="btn" class="btn btn-register" id="btnSubmit">ลงทะเบียน</button>

			<div class="message">
				เคยลงทะเบียนแล้ว <a class="<?php echo ($currentPage=='login'?'active':'');?>" href="signin?<?php echo (!empty($_GET['redirect'])?'redirect='.$_GET['redirect']:'');?>">ลงชื่อเข้าใช้</a>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>