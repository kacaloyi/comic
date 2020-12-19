<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang='zh-cn'>
<head>
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<title>友情提示：收藏本页</title>
<link rel='stylesheet' href='https://cdn.bootcss.com/normalize/5.0.0/normalize.min.css'>
<link rel="stylesheet" href="RjdaoIcon_style.css">
<!--[if lt IE 8]><!-->
<link rel="stylesheet" href="Rjdaoicon_ie7.css">
<style>
html,body {
	height: 100%;
	margin: 0;
	padding: 0;
	background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
	background-size: 400% 400%;
	animation: gradientBG 15s ease infinite;
}
@keyframes gradientBG {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}
.btn i{
	
	text-align:left;
	margin-top:3px;
}

body {font-family: 'lucida grande', 'lucida sans unicode', lucida, helvetica, 'Hiragino Sans GB', 'Microsoft YaHei', 'WenQuanYi Micro Hei', sans-serif;align-items: center;display: flex;}a{text-decoration:none;}#container {max-width: 350px;flex-basis: 100%;margin: 0 auto;background: #FFF;border-radius: 10px;box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);-webkit-box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);overflow: hidden;}#container #hero-img {
	width: 100%;
	height: 200px;
	background-color: #1BA1E2;
}#container #profile-img {width: 160px;height: 160px;margin: -80px auto 0 auto;border: 6px solid #FFF;border-radius: 50%;box-shadow: 0 0 5px rgba(90, 90, 90, 0.3);}#container #profile-img img {width: 100%;background: #FFF;border-radius: 50%;}#container #content {text-align: center;width: 320px;margin: 0 auto;padding: 0 0 10px 0;}#container #content h1 {font-size: 29px;font-weight: 500;margin: 20px 0 0 0;}#container #content p {font-size: 16px;font-weight: 400;line-height: 1.4;color: #666;margin: 15px 0 20px 0;}#container #content a {color: #CCC;font-size: 14px;margin: 0 10px;transition: color .3s ease-in-out;-webkit-transition: color .3s ease-in-out;}#container #content a:hover {color: #007bff;}.btn{background: none repeat scroll 0 0 #1BA1E2; border: 0 none; border-radius: 6px; color: #FFFFFF !important; cursor: pointer; font-family: "Open Sans","Hiragino Sans GB","Microsoft YaHei","WenQuanYi Micro Hei",Arial,Verdana,Tahoma,sans-serif; font-size: 14px;  padding: 8px 30%;}.btn:hover,.yanshibtn:hover{
	border: 0 none;
	border-radius: 6px;
	color: #FFFFFF!important;
	cursor: pointer;
	font-family: "Open Sans","Hiragino Sans GB","Microsoft YaHei","WenQuanYi Micro Hei",Arial,Verdana,Tahoma,sans-serif;
	font-size: 14px;
	padding: 8px 30%;
	background-attachment: scroll;
	background-color: #FE696D;
	background-image: none;
	background-repeat: repeat;
	background-position: 0 0;
}
#fon_12{ font-size:12px;}
</style>
</head>
<body>
<div id='container'>
	<div id='hero-img'>
	</div>
	<div id='profile-img'>
		<img src='/Public/home/mhimages/apple-touch-icon-256.png'/>
	</div>
	<div id='content'>
		<h1>网址发布页</h1>
		<p>
		 友情提示：收藏本页   
		</p>
		<p>
            找不到家时从收藏夹找到本页回家。 
		</p>
		<p style="font-size:10px">
			手机用户请将本页面添加到浏览器的书签
		</p>
		<a href="<?php echo ($_CFG['site']['newurl']); ?>/?sc=" class="btn btn-default" rel='nofollow'><i class="icon-0438"></i>&nbsp;新网页地址</a>
		<p>
		<p>
		<a href="<?php echo ($_CFG['site']['appdownload']); ?>" class="btn btn-default" rel='nofollow'><i class="icon-0160"></i>&nbsp;安卓APP下载</a>
	</div>
</div>
<div style="display:none"><script type="text/javascript" src="https://s9.cnzz.com/z_stat.php?id=1279325310&web_id=1279325310"></script></div>
</body>
</html>