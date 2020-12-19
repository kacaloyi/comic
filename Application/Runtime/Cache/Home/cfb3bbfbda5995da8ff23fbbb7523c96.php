<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}
</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<meta name="format-detection" content="telephone=no, address=no">
<title><?php echo ($_site['name']); ?></title>
<link rel="stylesheet" type="text/css" href="/Public/ever/css/common.css">
<link rel="stylesheet" type="text/css" href="/Public/ever/css/app.css">
<link rel="stylesheet" type="text/css" href="/Public/ever/css/font.css">
<link rel="stylesheet" type="text/css" href="/Public/ever/css/designer.css">
<link rel="stylesheet" type="text/css" href="/Public/ever/css/index.css">
<body bgcolor="#f2f2f2">

<body bgcolor="#f2f2f2">
<link rel="stylesheet" type="text/css" href="/Public/ever/css/common(1).css">
<link rel="stylesheet" type="text/css" href="/Public/ever/css/app(1).css">
	<div class="red-page-header">
	<i class="iconfont icon-back" style="float: left;" onclick="javascript:history.go( - 1)"></i>
	<h3>我的收米</h3>
</div>
<style>
.active{
	background: #1071ae;
}
</style>
	<div class="zl_select">
		<div class="zl_select_span">
			<span class="active" status='parent1'>一级 &nbsp;&nbsp;(<?php echo ($sp1); ?>人)</span></a>
			<span status="parent2">二级 &nbsp;&nbsp;(<?php echo ($sp2); ?>人)</span></a>
			<span status="parent3">三级 &nbsp;&nbsp;(<?php echo ($sp3); ?>人)</span></a>
		</div>
	</div>
	<div class="level_content">
		<ul id="list">
			
		</ul>
	</div>


<div id="backtop">
	<i class="iconfont icon-fold"></i>
</div>
<link rel="stylesheet" href="/Public/layer/skin/layer.css">
<script src="/Public/home/js/jquery-1.10.1.min.js"></script>
<script src="/Public/layer_mobile/layer.js"></script>
<script src="/Public/home/js/common.js"></script>
<script type="text/javascript">
	var page = 1;
		html = false;
		status='parent1';
	loadSeparate();
	$('.zl_select_span span').click(function(){
		$(this).addClass('active');
		$(this).siblings().removeClass("active");
		status = $(this).attr('status');
		p=1;
		$('#list').html('');
		loadSeparate();
	});
		
	//加载评论
	function loadSeparate(){
		AjaxLoad("<?php echo U('Ucenter/getSeparate');?>",{page:page,status:status},$('#list'),html,loadSeparate);
	}
</script>
<div id="backtop"><i class="iconfont icon-fold"></i></div>
</body>
</html>



<!--51LA统计-->
<script type="text/javascript" src="https://js.users.51.la/19935271.js"></script>
<!--51LA统计-->
<!--百度统计-->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?3d1dfafa9e0d026d0806c2e8e8b36311";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<!--百度统计-->

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
var links = window.location.href+'&parent='+"<?php echo ($user["id"]); ?>";
var img = "<?php echo ($share["pic"]); ?>";
var title = "<?php echo ($share["title"]); ?>";
var desc = "<?php echo ($share["desc"]); ?>";
wx.config({
	debug: false,
	appId: "<?php echo ($jssdk['appId']); ?>",
	timestamp:"<?php echo ($jssdk['timestamp']); ?>",
	nonceStr: "<?php echo ($jssdk['nonceStr']); ?>",
	signature: "<?php echo ($jssdk['signature']); ?>",
	jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage']
});
wx.ready(function () {
	wx.checkJsApi({
		jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
		success: function(res) {
			//alert(JSON.stringify(res));
		}
	});
	wx.error(function(res){
		console.log('err:'+JSON.stringify(res));
	});
	//分享给朋友
	wx.onMenuShareAppMessage({
		title:title, // 分享标题
		desc:desc, // 分享描述
		link:links, // 分享链接
		imgUrl:img, // 分享图标
		type: 'link', // 分享类型,music、video或link，不填默认为link
		dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		success: function () { 
		},
		cancel: function () { 
			
		}
	});
	//分享到朋友圈
	wx.onMenuShareTimeline({
		title:title, // 分享标题
		link: links, // 分享链接
		imgUrl:img, // 分享图标
		success: function () { 
			// 用户确认分享后执行的回调函数
		},
		cancel: function () { 
			// 用户取消分享后执行的回调函数
		}
	});
});
</script>
<?php echo ($_CFG["site"]["thirdcode"]); ?>