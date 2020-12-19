<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=no">
<title><?php echo ($_site['name']); ?> -- 个人中心</title>
<link href="/Public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/css/store.css?bc" rel="stylesheet" type="text/css" />
<link href="/Public/css/user.css" rel="stylesheet" type="text/css" />
<script src="/Public/js/jquery.min.js" type="text/javascript"></script>
<script src="/Public/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<style>
body{font-size:12px;}
.profile-item input[type=text] {
    width: 100%;
    height: 35px;
    line-height: 35px;
    border: 1px solid #ccc;
    padding-left: 10px;
}
</style>
<body>
	<div class="header-blank"></div>
    <div class="header">
		<?php echo getUsername($user['id']);?> -- 个人中心
		<span class="left">
			<a href="javascript:;" onclick="window.history.go(-1)"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
		</span>
	</div>
	
	<div class="profile-main">
		<form method="post" name="form" id="form">
			<div class="head">
				<img src="<?php echo ($user["headimg"]); ?>" class="headimg" /><br/>
				<!--<span class="red">区域网络科技</span>-->
				<?php echo ($user["nickname"]); ?>
			</div>
			<div class="profile-item">
				真实姓名<br/>
				<input type="text" name="true_name" <?php if(!empty($user['true_name'])): ?>value='<?php echo ($user["true_name"]); ?>'<?php endif; ?> /><br/>
				<span class="gray">此信息很重要</span>
			</div>
			<div class="profile-item">
				身份证号码<br/>
				<input type="text" name="cardno" <?php if(!empty($user['cardno'])): ?>value='<?php echo ($user["cardno"]); ?>'<?php endif; ?> /><br/>
				<span class="gray">此信息很重要</span>
			</div>
			<div class="profile-item">
				手机号码<br/>
				<input type="text" name="mobile"  <?php if(!empty($user['mobile'])): ?>value='<?php echo ($user["mobile"]); ?>'<?php endif; ?> /><br/>
				<span class="gray">此信息很重要</span>
			</div>
			<div class="profile-item">
				性别<br/>
				<input type="radio" name="sex" value="1" <?php if($user['sex'] == 1): ?>checked<?php endif; ?> />男&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="sex" value="2" <?php if($user['sex'] == 2): ?>checked<?php endif; ?> />女
			</div>
			<div class="profile-item">
				生日<br/>
				<link href="/Public/date/css/mobiscroll_002.css" rel="stylesheet" type="text/css">
<link href="/Public/date/css/mobiscroll.css" rel="stylesheet" type="text/css">
<link href="/Public/date/css/mobiscroll_003.css" rel="stylesheet" type="text/css">
<script src="/Public/date/js/jquery.1.7.2.min.js"></script>
<script src="/Public/date/js/mobiscroll_002.js" type="text/javascript"></script>
<script src="/Public/date/js/mobiscroll_004.js" type="text/javascript"></script>
<script src="/Public/date/js/mobiscroll.js" type="text/javascript"></script>
<script src="/Public/date/js/mobiscroll_003.js" type="text/javascript"></script>
<script src="/Public/date/js/mobiscroll_005.js" type="text/javascript"></script>
<input value="" class="" readonly="readonly" name="date" id="appDate" type="text">
<script type="text/javascript">
	$(function () {
		var currYear = (new Date()).getFullYear();	
		var opt={};
		opt.date = {preset : 'date'};
		opt.datetime = {preset : 'datetime'};
		opt.time = {preset : 'time'};
		opt.default = {
			theme: 'android-ics light', //皮肤样式
			display: 'modal', //显示方式 
			mode: 'scroller', //日期选择模式
			dateFormat: 'yyyy-mm-dd',
			lang: 'zh',
			showNow: true,
			nowText: "今天",
			startYear: currYear - 100, //开始年份
			endYear: currYear + 100 //结束年份
		};

		$("#appDate").mobiscroll($.extend(opt['date'], opt['default']));
	});
</script>
				<?php if($user['birth']): ?><script>
					var birth = "<?php echo ($user['birth']); ?>";
					$('input[name="date"]').val(birth);
				</script><?php endif; ?>
			</div>
			
			<div class="profile-item">
				<input type="button" class="btn" onclick="submitF();" value="保存地址" />
				<a href="javascript:history.go(-1);" class="cancle">取消</a>
			</div>
		</form>
	</div>

<link rel="stylesheet" href="/Public/layer/skin/layer.css">
<script src="/Public/layer_mobile/layer.js"></script>
<script src="/Public/home/js/common.js"></script>	
<script>
	function submitF(){
		Ajax("<?php echo U('Ucenter/profile');?>",$('#form').serialize());
	}
</script>	
</body>
</html>