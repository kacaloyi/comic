<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>管理后台</title>
<link rel="stylesheet" href="/Public/admin/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="/Public/plugins/bootstrap/css/bootstrap.font.css" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript" src="/Public/admin/js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="/Public/admin/js/custom/general.js"></script>

<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="js/plugins/css3-mediaqueries.js"></script>
<![endif]-->
</head>

<body class="withvernav">
<div class="bodywrapper">
    <div class="topheader" style="border-bottom: #009688 solid 2px;">
        <div class="left">
            <h1 class="logo"><?php echo ($_site['name']); ?><span></span></h1>
            <span class="slogan" style=" border-left-color:#396F08; color:#fff">后台管理系统</span>
         <h1 class="logo"><a href="http://wpa.qq.com/msgrd?v=3&uin=694242711&site=qq&menu=yes" style=" color:#fff;" target="_blank" ></a><span></span></h1>
            <br clear="all" />
            
        </div><!--left-->
		<div class="right">
        	 <span style=" color:#fff;"><a href="/index.php?m=&c=Mh&a=index" target="_blank" style=" color:#fff;">站点首页</a>&nbsp;&nbsp;&nbsp;
               <a href="<?php echo U('Config/user');?>" style=" color:#fff;"><?php echo session('admin.nickname');?> </a>&nbsp;&nbsp;&nbsp;
               <a href="<?php echo U('Index/logout');?>" style=" color:#ccc;">[退出]</a></span>
        </div><!--right-->

    </div><!--topheader-->
    
    <style>
	.vernav2 span.text{ padding-left:10px;}
	.menucoll2 span.text{ display:none;}
	.menucoll2>ul>li>a{ width:12px; padding:9px 10px; !important;}
	.dataTables_paginate a{ padding:0 10px;}
	</style>
    <div class="vernav2 iconmenu">
    	<ul>
		
        	<li>
				<a href="#formsub">
					<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
					<span class="text">系统设置</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="formsub">
               		<li><a href="<?php echo U('Admin/welcome');?>">后台首页</a></li>
               		<li><a href="<?php echo U('Config/site');?>">站点设置</a></li>
					<li><a href="<?php echo U('Config/chinaxingpay');?>">易支付设置</a></li>
                    <li><a href="<?php echo U('Config/dist');?>">用户分销设置</a></li>
                    <li><a href="<?php echo U('Config/charge');?>">充值赠送设置</a></li>
					<li><a href="<?php echo U('Config/send');?>">打赏赠送设置</a></li>				
					<li><a href="<?php echo U('Config/user');?>">修改管理密码</a></li>
                </ul>
            </li>
 <!-------------------------------->
			<li >
                    <a href="#tongji">
						<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						<span class="text">数据统计</span>
                        
                    </a>
                    <span class="arrow"></span>
                    <ul id="tongji">
						<li><a href="<?php echo U('Center/orders');?>">订单统计</a></li>
                        <li><a href="<?php echo U('Center/users');?>">用户统计</a></li>
						<li><a href="<?php echo U('Center/charge');?>">充值统计</a></li>
						<li><a href="<?php echo U('Center/separate');?>">分成统计</a></li>
						<li><a href="<?php echo U('Center/chapter');?>">外推统计</a></li>
						<li><a href="<?php echo U('Center/lodge');?>">举报统计</a></li>
                    </ul>
			</li>
<!------------------------------------->
			<li>
				<a href="#gzh">
					<span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
					<span class="text">公众号设置</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="gzh">
					<li><a href="<?php echo U('Config/mp');?>">公众号配置</a></li>
					<li><a href="<?php echo U('Autoreply/index');?>">自动回复管理</a></li>
                    <li><a href="<?php echo U('Selfmenu/index');?>">公众号菜单管理</a></li>
					<li><a href="<?php echo U('Config/share');?>">微信分享设置</a></li>
                </ul>
            </li>
		
			
			<li>
				<a href="#finance" class="elements">
					<span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
					<span class="text">系统财务</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="finance">
				    <li><a href="<?php echo U('Withdraw/index');?>">用户提现管理</a></li>
				    <li><a href="<?php echo U('Charge/index');?>">用户充值记录</a></li>
					<li><a href="<?php echo U('Finance/share');?>">用户分享获币记录</a></li>
					<li><a href="<?php echo U('Finance/finance_log');?>">用户账户变动记录</a></li>
					<li><a href="<?php echo U('Finance/separate_log');?>">代理佣金分成记录</a></li>
					<!--<li><a href="<?php echo U('Finance/pay');?>">一键转账</a></li>-->
					<li><a href="<?php echo U('Finance/mch_pay_log');?>">转账记录</a></li>
					<!--<li><a href="<?php echo U('Center/corder');?>">订单信息</a></li>-->
					<li><a href="<?php echo U('Center/withdraw');?>">代理结算</a></li>
                </ul>
            </li>
			
					
			
			<li>
				<a href="#user" class="typo">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					<span class="text">用户管理</span>
				</a>
				
				<span class="arrow"></span>
				<ul id="user">
					<li><a href="<?php echo U('User/index');?>">用户信息管理</a></li>
					<li><a href="<?php echo U('Report/index');?>">用户新增报表</a></li>
					<li><a href="<?php echo U('Tree/index');?>">用户树形关系</a></li>
                </ul>
				
            </li>
           
			<!--i>
				<a href="#gbal" class="support">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					<span class="text">股东分红</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="gbal">
					<li><a href="<?php echo U('Reward/index');?>">分红记录</a></li>
					<li><a href="<?php echo U('Reward/edit');?>">发放分红</a></li>
                </ul>
            </li-->
			
			
			
			<li>
				<a href="<?php echo U('Member/index');?>">
					<span class="glyphicon glyphicon-eur" aria-hidden="true"></span>
					<span class="text">代理管理</span>
				</a>
            </li>
			<li>
				<a href="<?php echo U('Config/ads');?>">
					<span class="glyphicon glyphicon-eur" aria-hidden="true"></span>
					<span class="text">广告设置</span>
				</a>
            </li>
			
			<li>
				<a href="<?php echo U('Notice/index');?>" class="editor">
					<span class="glyphicon glyphicon-volume-down" aria-hidden="true"></span>
					<span class="text">公告管理</span>
				</a>
            </li>
			
			<li>
				<a href="<?php echo U('Custom/index');?>" class="typo">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
					<span class="text">群发消息</span>
				</a>
            </li>
			
			<li>
				<a href="<?php echo U('Jub/index');?>" class="typo">
					<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
					<span class="text">举报管理</span>
				</a>
            </li>
		
			<li>
				<a href="#mh" class="elements">
					<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
					<span class="text">漫画管理</span>
				</a>
				<span class="arrow"></span>
            	<ul id="mh">
					<li><a href="<?php echo U('Config/banner');?>">轮播图设置</a></li>
					<li><a href="<?php echo U('Config/mhcate');?>">分类设置</a></li>
               		<li><a href="<?php echo U('Product/index');?>">漫画管理</a></li>
                </ul>
            </li>
			
			<li>
				<a href="#book" class="elements">
					<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
					<span class="text">小说管理</span>
				</a>
				<span class="arrow"></span>
            	<ul id="book">
					<li><a href="<?php echo U('Config/xbanner');?>">轮播图设置</a></li>
					<li><a href="<?php echo U('Config/bookcate');?>">分类设置</a></li>
               		<li><a href="<?php echo U('Book/index');?>">小说管理</a></li>
                </ul>
            </li>

			<li>
				<a href="#ysbook" class="elements">
					<span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span>
					<span class="text">听书管理</span>
				</a>
				<span class="arrow"></span>
            	<ul id="ysbook">
					<li><a href="<?php echo U('Config/ybanner');?>">轮播图设置</a></li>
					<li><a href="<?php echo U('Config/yook');?>">分类设置</a></li>
               		<li><a href="<?php echo U('Yook/index');?>">听书管理</a></li>
                </ul>
            </li>
            <li>
				<a href="#video" class="typo">
					<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
					<span class="text">动漫管理</span>
				</a>
              	<span class="arrow"></span>
              	<ul id="video">
					<li><a href="<?php echo U('Config/vbanner');?>">轮播图设置</a></li>
					<li><a href="<?php echo U('Config/video');?>">分类设置</a></li>
               		<li><a href="<?php echo U('Video/index');?>">动漫管理</a></li>
                </ul>
            </li>
			<li>
				<a href="#Chapter" class="elements">
					<span class="glyphicon glyphicon-import" aria-hidden="true"></span>
					<span class="text">文案制作</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="Chapter">
					<li><a href="<?php echo U('Chapter/index');?>">漫画文案</a></li>
               		<li><a href="<?php echo U('Bhapter/index');?>">小说文案</a></li>
                </ul>
            </li> 
			<li>
				<a href="<?php echo U('Chapurl/index');?>" class="addons">
					<span class="glyphicon glyphicon-share" aria-hidden="true"></span>
					<span class="text">文案链接</span>
				</a>
            </li>
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
        
    <div class="centercontent">
		
        <div class="pageheader notab">
            <h1 class="pagetitle">站点设置</h1>
            <span class="pagedesc">设置网站的基本信息</span>
            
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper lineheight21">
        
        
            <form class="stdform stdform2" method="post">
				<p>
					<label>网站名称</label>
					<span class="field"><input type="text" name="name" id="name" value="<?php echo ($_CFG["site"]["name"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>关注时回复关键词<small>关注时自动回复此关键词对应的内容</small></label>
					<span class="field"><input type="text" name="subscribe" id="subscribe" value="<?php echo ($_CFG["site"]["subscribe"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>每日分享赠送书币<small>填0或空则不赠送书币</small></label>
					<span class="field"><input type="text" name="send_money" id="send_money" value="<?php echo ($_CFG["site"]["send_money"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>Payspai个人微信商户ID</label>
					<span class="field"><input type="text" name="uid" id="uid" value="<?php echo ($_CFG["site"]["uid"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>Payspai个人微信商户token</label>
					<span class="field"><input type="text" name="token" id="token" value="<?php echo ($_CFG["site"]["token"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>平台支付方式</label>
					<span class="field">
						<select name="paymodel" default="<?php echo ($_CFG['site']['paymodel']); ?>">
							<option value="4">易支付</option>
							<option value="1">企业微信收款</option>
							<option value="3">Payspai个人二维码收款</option>
						</select>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="radius3"><a href="https://pay.weixin.qq.com" target="_blank">微信商户申请</a></button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="radius3"><a href="https://www.paysapi.com" target="_blank">Payspai申请</a></button>
					</span>
				</p>
				<p>
					<label>客服QQ</label>
					<span class="field"><input type="text" name="kfqq" id="kfqq" value="<?php echo ($_CFG["site"]["kfqq"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>官方微信号</label>
					<span class="field"><input type="text" name="weixin" id="weixin" value="<?php echo ($_CFG["site"]["weixin"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>VIP包年价格<small>填写0或空则不开启vip包年</small></label>
					<span class="field"><input type="text" name="vip" id="vip" value="<?php echo ($_CFG["site"]["vip"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>VIP赠送多少币<small>填写办理vip赠送的书币，为0不赠送</small></label>
					<span class="field"><input type="text" name="vipsb" id="vipsb" value="<?php echo ($_CFG["site"]["vipsb"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>充值书币比例<small>1元相当于X金币</small></label>
					<span class="field"><input type="text" name="rate" id="rate" value="<?php echo ($_CFG["site"]["rate"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>漫画付费集未设置，默认扣除<small>单位：书币</small></label>
					<span class="field"><input type="text" name="mhmoney" id="mhmoney" value="<?php echo ($_CFG["site"]["mhmoney"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>小说付费集未设置，默认扣除<small>单位：书币</small></label>
					<span class="field"><input type="text" name="xsmoney" id="xsmoney" value="<?php echo ($_CFG["site"]["xsmoney"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>今日签到赠送书币<small>单位：书币,若空或0则不开启</small></label>
					<span class="field"><input type="text" name="sign" id="sign" value="<?php echo ($_CFG["site"]["sign"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>客服电话<small></small></label>
					<span class="field"><input type="text" name="mobile" id="mobile" value="<?php echo ($_CFG["site"]["mobile"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>是否开启代理短信验证<small></small></label>
					<span class="field">
						<input style="zoom:150%;" value="1" type="checkbox" name="dailisms" <?php if($_CFG['site']['dailisms'] == 1): ?>checked<?php endif; ?> >开启  
					</span>
				</p>
				<p>
					<label>代理注册后是否默认禁用<small></small></label>
					<span class="field">
						<input style="zoom:150%;" value="1" type="checkbox" name="dailiopen" <?php if($_CFG['site']['dailiopen'] == 1): ?>checked<?php endif; ?> >禁用  
					</span>
				</p>
				<p>
					<label>短信平台账号<small></small></label>
					<span class="field"><input type="text" name="smsuser" id="smsuser" value="<?php echo ($_CFG["site"]["smsuser"]); ?>" class="smallinput" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="radius3"><a href="http://www.smsbao.com/reg?r=11074" target="_blank">短信平台申请</a></button></span>
				</p>
				<p>
					<label>短信平台密码<small></small></label>
					<span class="field"><input type="text" name="smspsw" id="smspsw" value="<?php echo ($_CFG["site"]["smspsw"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>短信平台签名<small></small></label>
					<span class="field"><input type="text" name="smssign" id="smssign" value="<?php echo ($_CFG["site"]["smssign"]); ?>" class="smallinput" /></span>
				</p>

<p>
					<label>登陆方式<small></small></label>
					<span class="field">
						<input style="zoom:150%;" value="1" type="checkbox" name="weixinlogin" <?php if($_CFG['site']['weixinlogin'] == 1): ?>checked<?php endif; ?> >微信自动登陆  <br>
						<input style="zoom:150%;" value="1" type="checkbox" name="zidongzhuce"
						<?php if($_CFG['site']['zidongzhuce'] == 1): ?>checked<?php endif; ?> >自动注册  （谨慎开启）
					</span>
				</p>

				
				<p>
					<label>平台二维码</label>
					<span class="field">
						<iframe src="<?php echo U('upload', array('event'=>'setPic','url'=>$_CFG['site']['qrcode']));?>" scrolling="no" width="100" height="100"></iframe>
						<input type="hidden" name="qrcode" id="qrcode" value="<?php echo ($_CFG['site']['qrcode']); ?>" class="smallinput" />
						<script>
						function setPic(url){
							document.getElementById('qrcode').value = url;
						}
						</script>
					</span>
				</p>
				<p>
					<label>备用网址地址<small></small></label>
					<span class="field"><input type="text" name="newurl" id="newurl" value="<?php echo ($_CFG["site"]["newurl"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>安卓App下载地址<small></small></label>
					<span class="field"><input type="text" name="appdownload" id="appdownload" value="<?php echo ($_CFG["site"]["appdownload"]); ?>" class="smallinput" /></span>
				</p>
				
				
				<p class="stdformbutton">
					<button class="submit radius2">提交</button>
					<input type="reset" class="reset radius2" value="重置" />
				</p>
			</form>
        
        
        </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
</div><!--bodywrapper-->
<script>
	jQuery(document).ready(function(e){
		// 菜单添加提示 
		$ = jQuery;
		
		// 根据cookie打开对应的菜单
		if($.cookie('curIndex')){
			console.log($.cookie('curIndex'));
			$(".vernav2>ul>li").eq($.cookie('curIndex')).find('ul').show();
		}
		
		$(".vernav2 ul li").each(function(index, el){
			$(this).attr('title', $(this).find("a").find('span.text').text());
			
		});
		
		$(".vernav2>ul>li>a").each(function(index,el){
			$(el).on('click',function(e){
				$.cookie('curIndex',$(this).parent('li').index());
			});
		});
		
		// 调整默认选择内容
		$("select").each(function(index, element) {
			$(element).find("option[value='"+$(this).attr('default')+"']").attr('selected','selected');
		});
		// 调整提示内容
	});
</script>
</body>
</html>