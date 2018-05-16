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

<?php include'favicon.php';?>
<?php
$page_title 	= 'ลงทะเบียน - '.$config['settings']['title'];
$page_desc 		= $config['settings']['description'];
$page_url 		= DOMAIN.'/signup';
$page_image 	= DOMAIN.'/image/cover.png';
?>

<!-- Meta Tag Main -->
<meta name="description" 			content="<?php echo $page_desc;?>"/>
<meta property="og:title" 			content="<?php echo $page_title;?>"/>
<meta property="og:description" 	content="<?php echo $page_desc;?>"/>
<meta property="og:url" 			content="<?php echo $page_url;?>"/>
<meta property="og:image" 			content="<?php echo $page_image;?>"/>
<meta property="og:type" 			content="website"/>
<meta property="og:site_name" 		content="<?php echo $config['settings']['sitename_en'];?>"/>
<meta property="fb:app_id" 			content="<?php echo $config['facebook']['api_id'];?>"/>
<meta property="fb:admins" 			content="<?php echo $config['facebook']['admin_id'];?>"/>

<meta itemprop="name" 				content="<?php echo $page_title;?>">
<meta itemprop="description" 		content="<?php echo $page_desc;?>">
<meta itemprop="image" 				content="<?php echo $page_image;?>">

<title><?php echo $page_title;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body class="fillcolor">
<div class="login">
	<div class="logo">
		<a href="index.php"><img src="image/logo.png" alt=""></a>
	</div>
	<div class="content">
		<form action="javascript:register();">
			<input type="text" class="inputtext" id="fullname" placeholder="ชื่อ-นามสกุล" autofocus>
			<input type="phone" class="inputtext" id="phone" placeholder="เบอร์โทรศัพท์">
			<input type="email" class="inputtext" id="email" placeholder="ที่อยู่อีเมล">
			<input type="password" class="inputtext" id="password" placeholder="ตั้งรหัสผ่าน">
			<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('register',SECRET_KEY);?>">
			<input type="hidden" id="redirect" value="<?php echo $_GET['redirect'];?>">
			<button type="btn" class="btn btn-register" id="btnSubmit">ลงทะเบียน</button>
		</form>
	</div>
	<div class="message">เคยลงทะเบียนแล้ว <a class="<?php echo ($currentPage=='login'?'active':'');?>" href="signin<?php echo (!empty($_GET['redirect'])?'?redirect='.$_GET['redirect']:'');?>">ลงชื่อเข้าใช้</a></div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>