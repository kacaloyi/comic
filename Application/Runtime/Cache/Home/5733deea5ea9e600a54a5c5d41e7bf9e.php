<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="font-size: 23.4375px;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
<title>修改密码</title>
<link href="/Public/home/mhpublic/css/app.css" rel="stylesheet">
<script src="/Public/home/mhpublic/js/jquery.min.js" type="text/javascript"></script>
<script src="/Public/home/mhpublic/js/app.js" type="text/javascript"></script>
</head>
<body>
<div id="app">
	<div class="login">
		<div class="login-nav">
		    <a href="javascript:history.go(-1);" class="back icon">

                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40">
        		<path d="M29.56 39.47a2 2 0 0 1-1.38-.56L8.45 20 28.17 1.09A2 2 0 1 1 30.94 4L14.23 20l16.71 16a2 2 0 0 1-1.38 3.44z" fill="#ff730a">
		        </path>
		        </svg>

        </a>

			<span class="login-close"></span><span class="">修改密码</span>
		<a href="<?php echo U('Mh/index');?>" class="home icon">
             <i class="icon-home" ></i>
        </a>	
		</div>
		<div class="avatar">
		<span class="login-icon"><img style="border-radius: 1.733rem;
    border: 2px solid #dcdcdc;" src="<?php echo ($faceurl); ?>"></span>
		</div>
		
		<div class="login-form">

			<ul>
				<li><a class="mint-cell mint-field is-nolabel">
				<div class="mint-cell-left">
				</div>
				<div class="mint-cell-wrapper">
					<div class="mint-cell-title">
						<span class="mint-cell-text"></span>
					</div>
					
					<div class="mint-cell-value">
						<input type="hidden" name="username" id="username" value="<?php echo ($username); ?>" />
						<input placeholder="请输入当前密码，以便核实身份" type="password" id="olduserpwd" class="mint-field-core">
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
						<input placeholder="输入新密码，请牢记" type="password" id="npassword1" class="mint-field-core">
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
						<input placeholder="再次输入密码" type="password" id="npassword2" class="mint-field-core">
					</div>
					
				</div>
				<div class="mint-cell-right">
				</div>
				</a></li>
				<li class="login-submit">
				<div class="btn btnAbled" onclick="login();">
					修改
				</div>
				</li>
			</ul>
		</div>
		<!-- <div class="login-extra">
			<button class="forget-password">忘记密码？</button>
		</div>  -->
				    <div>
		<p STYLE="font-size:12px;color:#646F69; text-align:center;">为了账号安全，请使用高等级密码！</p>
		</div>
		<div class="login-reg-button">
			<a href="<?php echo U('Member/login');?>" class="">不改了？去登录</a>
		</div>
	</div>
</div>


<script>
	var fr = "<?php echo U(Member/my);?>";
	$("#mobile").keypress(function(){
		$(this).next().css('display','block');
	});
	$('#clear').click(function(){
		$(this).prev().val('');
		$(this).css('display','none');
	})
	
	function login() {
		var username = $('#username').val();
		var olduserpwd = $('#olduserpwd').val();
		var npassword1 = $('#npassword1').val();
		var npassword2 = $('#npassword2').val();
	
		
		var url1 = '<?php echo U("Member/password");?>';
	    var data1 = {username:username,oldpassword:olduserpwd,npassword1:npassword1,npassword2:npassword2};
	    var fun1 = function(data2){
	        if(data2.status == 1) {
	        	salert(data2.info);
	        	location.href = data2.url;
	        } else {
	        	salert(data2.info);
	        }
	    }
	    $.post(url1,data1,fun1,'json');
	}
	
	/* var open =true;
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
	}); */
</script>
</body>
</html>