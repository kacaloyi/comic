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
		<section class="content-header">
<div>
	<ol class="breadcrumb" style="background: none; margin-bottom: 0px;">
		<li><a href="<?php echo U('Index/index');?>" style="color: #333;"><i class=" fa fa-home"></i> Home</a></li>
		<li class="active">数据信息</li>
		<li class="active">结算信息</li>
	</ol>
</div>
</section>
<section class="content">
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					
				</div>
				<form class="form-inline" method="post" style="margin-bottom: 15px;">
					<div class="input-group input-group-sm">
						<input type="text" name="time1" class="form-control reservationtime" placeholder="开始时间" autocomplete="off" value="<?php echo ($_GET['time1']); ?>">
					</div>
					<span>-</span>
					<div class="input-group input-group-sm">
						<input type="text" name="time2" class="form-control reservationtime" placeholder="结束时间" autocomplete="off" value="<?php echo ($_GET['time2']); ?>">
					</div>
					<div class="input-group input-group-sm">
						<input type="submit" value="查找" class="btn btn-sm btn-success">
					</div>
				</form>
				<ul id="myTab" class="nav nav-tabs">
					<li class="withdraw" _status="1"><a href="<?php echo U('withdraw',array('status'=>1));?>">提现中</a></li>
					<li class="withdraw" _status="2"><a href="<?php echo U('withdraw',array('status'=>2));?>">已提现</a></li>
				</ul>
				<table class="table table-bordered table-hover table-striped text-center">
					<tbody>
						<tr>
							<th>款项日期</th>
							<th>提款金额</th>
							<th>收款人</th>
							<th>银行名称</th>
							<th>银行卡号</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
						<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
							<td><?php echo (date("Y-m-d H:i:s",$v["create_time"])); ?></td>
							<td><?php echo ($v["money"]); ?></td>
							<td><?php echo ($v["bankname"]); ?></td>
							<td><?php echo ($v["bank"]); ?></td>
							<td><?php echo ($v["bankno"]); ?></td>
							<td>
								<?php if($v['status'] == 1): ?>提现中
								<?php else: ?>
									已提现<?php endif; ?>
							</td>
							<td>
								<?php if($v['status'] == 1): ?><a href="javascript:;" onclick="setWithStatus(<?php echo ($v["id"]); ?>,2)" class="btn btn-info">
										<i class="fa fa-edit"></i>提现成功
									</a>
									<a href="javascript:;" onclick="setWithStatus(<?php echo ($v["id"]); ?>,-1)" class="cannel_vip btn bg-maroon margin">
										<i class="fa fa-times"></i>拒绝提现
									</a>
								<?php else: ?>
									<a href="javascript:;" onclick="deleteAmTables('withdraw',<?php echo ($v["id"]); ?>)" class="cannel_vip btn bg-maroon margin">
										<i class="fa fa-times"></i>删除
									</a><?php endif; ?>
							</td>
						</tr><?php endforeach; endif; ?>
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
			<div class="page"><?php echo ((isset($page) && ($page !== ""))?($page):"<p style='text-align:center'>暂时没有数据</p>"); ?></div>
		</div>
	</div>
</div>
</section><!-- /.content -->
<script>
	var status = "<?php echo ($_GET['status']); ?>"?"<?php echo ($_GET['status']); ?>":1;
	$(function(){
		$('.withdraw').each(function(){
			if($(this).attr("_status") == status){
				$(this).addClass("active");
			}
		})
	});
	
	function setWithStatus($id,$status){
		layer.confirm("确定要进行操作？",function(){
			$.post("<?php echo U('setWithStatus');?>",{id:$id,status:$status},function(d){
				if(d){
					if(d.status){
						layer.alert(d.info,function(){
							location.reload();
						})
					}else{
						layer.msg(d.info);
					}
				}else{
					layer.msg('请求失败！');
				}
			})
		})
	}
	
	$.fn.datetimepicker.dates['zh-CN'] = {
		days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
		daysShort: ["日", "一", "二", "三", "四", "五", "六", "日"],
		daysMin: ["日", "一", "二", "三", "四", "五", "六", "日"],
		months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		monthsShort: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"],
		meridiem: ["上午", "下午"],
		today: "今天"
	};

	$('.reservationtime').datetimepicker({
		format: 'yyyy-mm-dd',
		language: 'zh-CN',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		showMeridian: 1
	});
</script>
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