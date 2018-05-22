<?php
require_once 'autoload.php';
require_once 'plugin/facebook-sdk-v5/autoload.php';

if($user_online){
	header('Location: index.php');
	die();
}

$fb = new Facebook\Facebook([
	'app_id' 				=> $config['facebook']['api_id'],
	'app_secret' 			=> $config['facebook']['app_secret'],
	'default_graph_version' => 'v3.0'
]);

$helper 		= $fb->getRedirectLoginHelper();
$permissions 	= ['email']; // optional
$loginUrl 		= $helper->getLoginUrl(DOMAIN.'/fb-callback.php',$permissions);
$signature 		= new Signature;
$currentPage 	= 'login';
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
$page_title 	= 'เข้าระบบ - '.$config['settings']['title'];
$page_desc 		= $config['settings']['description'];
$page_url 		= DOMAIN.'/signin';
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
		<a class="btn btn-facebook" href="<?php echo $loginUrl;?>"><i class="fa fa-facebook" aria-hidden="true"></i>ลงชื่อเข้าใช้ด้วย Facebook</a>
		<div class="separator"><span>หรือ</span></div>
		<form action="javascript:login();">
			<input type="phone" class="inputtext" id="username" placeholder="อีเมล หรือ เบอร์โทรศัพท์" required autofocus>
			<input type="password" class="inputtext" id="password" placeholder="รหัสผ่าน" required>
			<input type="hidden" id="sign" name="sign" value="<?php echo $signature->generateSignature('login',SECRET_KEY);?>">
			<input type="hidden" id="redirect" value="<?php echo $_GET['redirect'];?>">
			<button type="btn" class="btn btn-submit" id="btnSubmit">ลงชื่อเข้าใช้งาน</button>
		</form>
	</div>
	<div class="message">
		ใช้งานครั้งแรก ? <a href="signup<?php echo (!empty($_GET['redirect'])?'?redirect='.$_GET['redirect']:'');?>">ลงทะเบียนใหม่</a>
	</div>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/user.js"></script>
</body>
</html>