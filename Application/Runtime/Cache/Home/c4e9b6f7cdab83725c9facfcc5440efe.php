<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="font-size: 23.4375px;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<title>登录</title>
<link href="/Public/home/mhpublic/css/app.css" rel="stylesheet">
<link href="/Public/home/mhpublic/css/login.css" rel="stylesheet">
<script src="/Public/home/mhpublic/js/jquery.min.js" type="text/javascript"></script>
<script src="/Public/home/mhpublic/js/app.js" type="text/javascript"></script>
</head>
<body>
<div id="app">
	<div class="login login_bj">
		<div class="login-nav">
			<span class="login-close"></span>
		</div>
		<span class="login-icon"><img src="/Public/home/mhimages/user.png"></span>
		<div class="login-form" >
			<ul>
				<li><a class="mint-cell mint-field is-nolabel">
				<div class="mint-cell-left">
				</div>
				<div class="mint-cell-wrapper">
					<div class="mint-cell-title">
						<span class="mint-cell-text"></span>
					</div>
					<div class="mint-cell-value">
						<input placeholder="请输入账号" type="" id="mobile" class="mint-field-core">
						<div class="mint-field-clear" id="clear" style="display: none;">
							<i class="mintui mintui-field-error"></i>
						</div>
						<span class="mint-field-state is-default"><i class="mintui mintui-field-default"></i></span>
						<div class="mint-field-other">
						</div>
					</div>
					
				</div>
				<div class="mint-cell-right">
				</div>
				</a></li>
				<li class="login-password"><a class="mint-cell mint-field is-nolabel">
				<div class="mint-cell-left">
				</div>
				<div class="mint-cell-wrapper">
					<div class="mint-cell-title">
						<span class="mint-cell-text"></span>
					</div>
					<div class="mint-cell-value">
						<input placeholder="请输入密码" type="password" id="pass" class="mint-field-core">
					</div>
					
				</div>
				<div class="mint-cell-right">
				</div>
				</a></li>
				<li class="login-submit">
				<div class="btn btnAbled" onclick="login();">
					登录
				</div>
				</li>
			</ul>
		</div>
		<div class="login-extra">
			<button class="forget-password">忘记密码？</button>
		</div>  
		<div class="login-reg-button">
			<a href="<?php echo U('Member/register');?>" class="">没有账号？去注册</a>
		</div>
	</div>
</div>


<script>
	var fr = "<?php echo U('Member/my');?>";
	$("#mobile").keypress(function(){
		$(this).next().css('display','block');
	});
	$('#clear').click(function(){
		$(this).prev().val('');
		$(this).css('display','none');
	})
	
	function login() {
		var mobile = $('#mobile').val();
		var pass = $('#pass').val();
		
		var url1 = '<?php echo U("Member/login");?>';
	    var data1 = {username:mobile,password:pass,url:fr};
	    var fun1 = function(data2){
	        if(data2.status == 1) {
	        	location.href = data2.url;
	        } else {
	        	salert(data2.msg);
	        }
	    }
	    $.post(url1,data1,fun1,'json');
	}
	
	var open =true;
	$('#eyes').click(function(){
		if(open){
			$(this).find('img').attr('src','/Public/images/openeye.png');
			open =false;
			$('#psw').attr('type','text');
		}else{
			$(this).find('img').attr('src','/Public/images/closeeye.png');
			open =true;
			$('#psw').attr('type','password');
		}
	});
</script>
</body>
</html>