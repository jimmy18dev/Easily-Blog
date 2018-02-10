<?php
require_once 'autoload.php';
if($user_online){
	header('Location: index.php');
	die();
}

$signature 	= new Signature;
$currentPage = 'login';
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
$p_title 	= 'ลงชื่อเข้าใช้ '.TITLE;
$p_desc 	= DESCRIPTION;
$p_url 		= DOMAIN.'/signin';
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
<header class="header fixed">
	<div class="logo">
		<a href="index.php">Peopleawesome</a>
	</div>
</header>

<div class="login">
	<div class="content">
		<button class="btn btn-facebook" onclick="javascript:facebookLogin();"><i class="fa fa-facebook" aria-hidden="true"></i>ลงชื่อเข้าใช้ด้วย Facebook</button>
		<div class="separator"><span>หรือ</span></div>
		<form action="javascript:login();">
			<input type="phone" class="inputtext" id="username" placeholder="ที่อยู่อีเมลหรือเบอร์โทรศัพท์" required autofocus>
			<input type="password" class="inputtext" id="password" placeholder="รหัสผ่าน" required>
			<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('login',SECRET_KEY);?>">
			<input type="hidden" id="redirect" value="<?php echo $_GET['redirect'];?>">
			<button type="btn" class="btn btn-submit" id="btnSubmit">ลงชื่อเข้าใช้งาน</button>
		</form>
		<div class="message">
			ใช้งานเป็นครั้งแรก <a href="signup?<?php echo (!empty($_GET['redirect'])?'redirect='.$_GET['redirect']:'');?>">ลงทะเบียนใหม่<i class="fa fa-angle-right" aria-hidden="true"></i></a>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>