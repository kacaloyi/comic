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
            <h1 class="pagetitle">编辑代理内容</h1>
            <span class="pagedesc">请认真编辑代理的各项信息</span>
            
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper lineheight21">
        
        
            <form class="stdform stdform2" method="post">
				<p>
					<label>代理姓名</label>
					<span class="field"><input type="text" name="name" id="name" value="<?php echo ($info["name"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>会员充值返佣比例<small>会员充值书币时返佣多少金额的百分比</small></label>
					<span class="field"><input type="text" name="separate" id="separate" value="<?php echo ($info["separate"]); ?>" class="smallinput" /></span>
				</p>
			<!-- 	<p>
					<label>会员充值扣除比例<small>会员充值书币扣除代理端比例（包括充值记录和分成）</small></label>
					<span class="field"><input type="text" name="declv" id="declv" value="<?php echo ($info["declv"]); ?>" class="smallinput" /></span>
				</p> -->
				<p>
					<label>会员充值扣除比例<small>会员充值书币扣除代理端比例（包括充值记录和分成）</small></label>
					<span class="field">
							<!--<input type="text" name="declv" id="declv" value="<?php echo ($info["declv"]); ?>" class="smallinput" style="width: 20%" />-->
						<input type="text" name="deductions_s" id="deductions_s" value="1" class="smallinput" style="width: 10%;background:#ddd;" readonly />&nbsp; ：&nbsp;
						<input type="text" name="deductions_e" id="deductions_e" value="<?php echo ($info["deductions_e"]); ?>" class="smallinput" style="width: 10%" />
					</span>
				</p>
				<p>
					<label>代理名称</label>
					<span class="field"><input type="text"  value="<?php echo ($info["username"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>代理支付宝账号</label>
					<span class="field"><input type="text" value="<?php echo ($info["zfb"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>代理手机号</label>
					<span class="field"><input type="text" value="<?php echo ($info["mobile"]); ?>" class="smallinput" /></span>
				</p>
				<p>
					<label>登录密码</label>
					<span class="field"><input type="text" name="tpassword" id="tpassword" value="<?php echo ($info["tpassword"]); ?>" class="smallinput" /></span>
				</p>
				
				<?php if($info): ?><p>
						<label>代理漫画地址</label>
						<span class="field"><input type="text" value="<?php echo ($info["url"]); ?>" class="smallinput" readonly style="background:#ddd;" /></span>
					</p>
					<p>
						<label>代理小说地址</label>
						<span class="field"><input type="text" value="<?php echo ($murl); ?>&c=Book&a=index&imei=<?php echo ($info["imei"]); ?>" class="smallinput" readonly style="background:#ddd;" /></span>
					</p>
					<p>
						<label>代理书架地址</label>
						<span class="field"><input type="text" value="<?php echo ($murl); ?>&c=Mh&a=book_shelf&imei=<?php echo ($info["imei"]); ?>" class="smallinput" readonly style="background:#ddd;" /></span>
					</p>
					<p>
						<label>代理中心地址</label>
						<span class="field"><input type="text" value="<?php echo ($murl); ?>&c=Mh&a=my&imei=<?php echo ($info["imei"]); ?>" class="smallinput" readonly style="background:#ddd;" /></span>
					</p>
					<p>
						<label>代理充值地址</label>
						<span class="field"><input type="text" value="<?php echo ($murl); ?>&c=Mh&a=pay&imei=<?php echo ($info["imei"]); ?>" class="smallinput" readonly style="background:#ddd;" /></span>
					</p>
					<p>
						<label>代理阅读历史地址</label>
						<span class="field"><input type="text" value="<?php echo ($murl); ?>&c=Mh&a=book_recent_read&imei=<?php echo ($info["imei"]); ?>" class="smallinput" readonly style="background:#ddd;" /></span>
					</p><?php endif; ?>
				<p>
					<label>代理公众号二维码</label>
					<span class="field">
						<iframe src="<?php echo U('upload', 'event=setPic&url='.$info['gqrcode']);?>" scrolling="no" width="100" height="100"></iframe>
						<input type="hidden" name="gqrcode" id="gqrcode" value="<?php echo ($_CFG['site']['gqrcode']); ?>" class="smallinput" />
						<script>
						function setPic(url){
							document.getElementById('gqrcode').value = url;
						}
						</script>
					</span>
				</p>
				<p class="stdformbutton">
					<input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>" />
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