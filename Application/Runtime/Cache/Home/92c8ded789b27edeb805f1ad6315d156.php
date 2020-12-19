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
	<h3>我的客户</h3>
</div>
<style>
.active{
	background: #1071ae;
}
</style>
	<div class="zl_select">
		<div class="zl_select_span">
			<span class="active" status='parent1'>一级 &nbsp;&nbsp;(<?php echo ($user['agent1']); ?>人)</span></a>
			<span status="parent2">二级 &nbsp;&nbsp;(<?php echo ($user['agent2']); ?>人)</span></a>
			<span status="parent3">三级 &nbsp;&nbsp;(<?php echo ($user['agent3']); ?>人)</span></a>
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
	loadTeam();
	$('.zl_select_span span').click(function(){
		$(this).addClass('active');
		$(this).siblings().removeClass("active");
		status = $(this).attr('status');
		p=1;
		$('#list').html('');
		loadTeam();
	});
		
	//加载评论
	function loadTeam(){
		AjaxLoad("<?php echo U('Ucenter/getTeam');?>",{page:page,status:status},$('#list'),html,loadTeam);
	}
</script>
<div id="backtop"><i class="iconfont icon-fold"></i></div>
</body>
</html>