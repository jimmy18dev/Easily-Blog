<?php
include_once'autoload.php';
$category = new Category();
$current_page = 'about';
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

<title>About US</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/slideshow.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>
<?php include_once 'header.php';?>
<?php include_once 'template/navigation.php'; ?>

<div class="page-nav">
	<a href="about#about" class="active">เกี่ยวกับเรา</a>
	<a href="about#officer">บุคลากร</a>
	<a href="about#about">บริการทางการแพทย์</a>
	<a href="about#officer">วิสัยทัศน์</a>
	<a href="about#about">แผนการดำเนินงาน</a>
	<a href="about#officer">ติดต่อเรา</a>
</div>
<div class="about">
	<div class="content" id="about">
		<h1>UltraLinx is an independent UK-based</h1>
		<p>UltraLinx is an independent UK-based web magazine dedicated to curating high quality content from around the web – covering topics from technology to design. Additionally, we provide hardware and software reviews, and strive to be very concise and to the point in our writing. We place heavy emphasis on using, reviewing, and promoting products that exemplify good design in hardware and in software. Our passion for good design is rooted in the belief that even the most practical devices can be visually appealing and enjoyable.</p>
		<p>Launched as a web magazine in August 2011 in the UK by Oliur Rahman, UltraLinx has become a place where he and others can reach out to like-minded enthusiasts and share inspiration.</p>

		<figure>
			<img src="https://theultralinx.com/.image/c_limit%2Ccs_srgb%2Cq_80%2Cw_960/MTU0ODI0MjA3NzIzNjY4ODU4/2c40bd4237433759ef2bb9c77ea.jpg" alt="">
		</figure>

		<p>Have you ever wondered what it would be like if GTA was set in Hong Kong? Well, now you can get a glimpse of what it might actually look like. Photographer Zaki Abdelmounim took a series of photos based in Hong Kong that make it look like it's from a utopian video game or movie. Head here for the full collection and check out a selection of the photos below.</p>
	</div>

	<div class="content" id="officer">
		<h1>Officer</h1>
		<p>All of our banner advertising is handled by SAYMedia. If you are interested in other forms of advertising please email tips@theultralinx.com.</p>

		<?php for($i=0;$i<5;$i++){ ?>
		<div class="person">
			<div class="thumbnail">
				<img src="https://scontent.fbkk8-2.fna.fbcdn.net/v/t1.0-9/21765071_10207981921745391_1604082323197881074_n.jpg?_nc_cat=0&oh=49460ff9c7f9e4264b150f7932340b25&oe=5B5B4ED8" alt="">
			</div>
			<div class="info">
				<h2>Puwadon Sricharoen</h2>
				<div class="position">Web Design and Developer</div>
				<div class="bio">Life isn't about finding yourself. Life is about creating yourself.</div>
			</div>
		</div>
		<?php }?>
	</div>

	<div class="content">
		<h1>ติดต่อเรา</h1>
		<div class="contact">
			<div class="c">ที่อยู่</div>
			<div class="v">138 ถ.สุขุมวิท ต.ท่าประดู่  อ.เมือง จ.ระยอง 21000</div>
		</div>
		<div class="contact">
			<div class="c">โทรศัพท์</div>
			<div class="v"><a href="#" class="phone">0-3861-1104</a> ต่อ 2134,2128</div>
		</div>
		<div class="contact">
			<div class="c">โทรสาร</div>
			<div class="v"><a href="#" class="phone">0-3861-1104</a> ต่อ 2127</div>
		</div>
		<div class="contact">
			<div class="c">E-Mail</div>
			<div class="v"><a href="#" class="email">occhealth_ryh@gmail.com</a></div>
		</div>

		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d30962.434048802155!2d101.3957069!3d14.059202299999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe83b55b50e8608b4!2z4LmC4Lij4LiH4Lie4Lii4Liy4Lia4Liy4Lil4LmA4LiI4LmJ4Liy4Lie4Lij4Liw4Lii4Liy4Lit4Lig4Lix4Lii4Lig4Li54LmA4Lia4Lio4Lij!5e0!3m2!1sth!2sth!4v1523533692951" frameborder="0" allowfullscreen></iframe>
	</div>
</div>
<?php include_once 'footer.php'; ?>
<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>