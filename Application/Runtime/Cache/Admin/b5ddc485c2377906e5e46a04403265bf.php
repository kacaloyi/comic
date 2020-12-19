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
					<!--<li><a href="<?php echo U('Finance/pay');?>">一键转账</a></li>
					<li><a href="<?php echo U('Finance/mch_pay_log');?>">转账记录</a></li>-->
					<li><a href="<?php echo U('Center/corder');?>">订单信息</a></li>
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
		<script src="/Public/plugins/My97DatePicker/WdatePicker.js"></script>

<div class="pageheader notab">
            <h1 class="pagetitle">订单统计</h1>
            <span class="pagedesc">管理平台中的订单统计</span>
            
</div>
<style>        

.row{
    display: table;
    content: " ";
    
    box-sizing: border-box;
    display: block;
}

.col-md-4{
    float: left;
    position: relative;
    min-height: 1px;
    padding-right: 5px;
    padding-left: 6px;
    display: block;
    box-sizing: border-box;
    width: 33.33%;
}

.col-sm-4 {
    float: left;
    padding:auto;
    margin:auto;
    position: relative;
    min-height: 10px;
    display: block;
    width: 33.33333333%;
}

b, strong {
    font-weight: 700;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
}

.text-primary {
    color: #337ab7;
}

.well {
    min-height: 20px;
    padding: 19px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.05);

   display: block;
   box-sizing: border-box;
}

.container-fluid {
    padding-right: 0px;
    padding-left: 0px;
    margin-right: auto;
    margin-left: auto;
    display: table;
    content: " ";
}


</style>

 <div id="contentwrapper" class="contentwrapper lineheight21">
<!--<section class="content"> -->
	<div class="row" id="order-summary-stats-panel">
		<div class="col-md-4">
			<div class="well">
				<b>
					今日充值 <i class="fa fa-question-circle" title="不含当日，统计实时数据"></i>
				</b>
				<div class="text-primary" style="font-size:32px;margin:5px 0">
					¥<span><?php echo ((isset($tcharge['total']) && ($tcharge['total'] !== ""))?($tcharge['total']):"0.00"); ?></span>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4" style="padding:0">
							<strong>普通充值</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($tcharge['ptotal']) && ($tcharge['ptotal'] !== ""))?($tcharge['ptotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($tcharge['pnums']); ?></b> 笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($tcharge['pwnums']); ?></b>笔</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $tcharge['pnums']+$tcharge['pwnums']; $lv = sprintf("%.2f",$tcharge['pnums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>年费VIP</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($tcharge['ytotal']) && ($tcharge['ytotal'] !== ""))?($tcharge['ytotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($tcharge['ynums']); ?></b> 笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($tcharge['ywnums']); ?></b>笔</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $tcharge['ynums']+$tcharge['ywnums']; $lv = sprintf("%.2f",$tcharge['ynums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>终生VIP</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($tcharge['ztotal']) && ($tcharge['ztotal'] !== ""))?($tcharge['ztotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($tcharge['znums']); ?></b> 笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($tcharge['zwnums']); ?></b>笔</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $tcharge['znums']+$tcharge['zwnums']; $lv = sprintf("%.2f",$tcharge['znums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="well">
				<b>昨日充值	<i class="fa fa-question-circle" title="不含当日，统计实时数据"></i></b>
				<div class="text-primary" style="font-size:32px;margin:5px 0">
					¥<span><?php echo ((isset($yescharge['total']) && ($yescharge['total'] !== ""))?($yescharge['total']):"0.00"); ?></span>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4" style="padding:0">
							<strong>普通充值</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($yescharge['ptotal']) && ($yescharge['ptotal'] !== ""))?($yescharge['ptotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($yescharge['pnums']); ?></b> 笔
							</div>
							<div>未支付: <b class="text-warning"><?php echo ($yescharge['pwnums']); ?></b>
								笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $yescharge['pnums']+$yescharge['pwnums']; $lv = sprintf("%.2f",$yescharge['pnums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>年费VIP</strong>
							<div>
								<b class="text-warning"><?php echo ($yescharge['ytotal']); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($yescharge['ynums']); ?></b> 笔
							</div>
							<div>未支付: <b class="text-warning"><?php echo ($yescharge['ywnums']); ?></b>
								笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $yescharge['ynums']+$yescharge['ywnums']; $lv = sprintf("%.2f",$yescharge['ynums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>终生VIP</strong>
							<div>
								<b class="text-warning"><?php echo ($yescharge['ztotal']); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($yescharge['znums']); ?></b> 笔
							</div>
							<div>未支付: <b class="text-warning"><?php echo ($yescharge['zwnums']); ?></b>
								笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $yescharge['znums']+$yescharge['zwnums']; $lv = sprintf("%.2f",$yescharge['znums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<b>累计充值 (含当日) <i class="fa fa-question-circle" title="含当日，统计实时数据"></i> </b>
				<div class="text-primary" style="font-size:32px;margin:5px 0">
					¥<span><?php echo ((isset($acharge['total']) && ($acharge['total'] !== ""))?($acharge['total']):"0.00"); ?></span>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4" style="padding:0">
							<strong>普通充值</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($acharge['ptotal']) && ($acharge['ptotal'] !== ""))?($acharge['ptotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($acharge['pnums']); ?></b>笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($acharge['pwnums']); ?></b>笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $acharge['pnums']+$acharge['pwnums']; $lv = sprintf("%.2f",$acharge['pnums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>年费VIP</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($acharge['ytotal']) && ($acharge['ytotal'] !== ""))?($acharge['ytotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($acharge['ynums']); ?></b>笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($acharge['ywnums']); ?></b>笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $acharge['ynums']+$acharge['ywnums']; $lv = sprintf("%.2f",$acharge['ynums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
						<div class="col-sm-4" style="padding:0">
							<strong>终生VIP</strong>
							<div>
								<b class="text-warning"><?php echo ((isset($acharge['ztotal']) && ($acharge['ztotal'] !== ""))?($acharge['ztotal']):"0.00"); ?></b>
							</div>
							<div>已支付: <b class="text-warning"><?php echo ($acharge['znums']); ?></b>笔</div>
							<div>未支付: <b class="text-warning"><?php echo ($acharge['zwnums']); ?></b>笔
							</div>
							<div>
								完成率:
								<b class="text-warning">
									<?php  $all = $acharge['znums']+$acharge['zwnums']; $lv = sprintf("%.2f",$acharge['znums']/$all)*100; ?>
									<span><?php echo ($lv); ?></span>%
								</b>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--------------下面是表格------------------------------------->	
	<div class="tableoptions" id="order-daily-stats-panel">
		    <b class="panel-heading">
			    <h3 class="panel-title" >历史充值统计</h3>
		    </b>

		<div class="tableoptions">

		    <form  method="post">
					
						<input type="text" name="time1" class="smallinput" style="width:100px;" placeholder="开始时间" value="<?php echo ($_GET['time1']); ?>"  onclick="WdatePicker()">
						
						<span>-</span>
						
						<input type="text" name="time2" class="smallinput" style="width:100px;" placeholder="结束时间" value="<?php echo ($_GET['time1']); ?>"  onclick="WdatePicker()">
						
						<input type="submit" value="查询数据" class="btn btn-sm btn-success">
						
		    </form>
        </div><!--tableoptions-->
        
		<table class="table table-bordered table-striped table-hover">	
			<tr >
				<th><b>日期</b></th>
				<th class="text-right"><b>充值金额</b></th>
				<th class="text-right"><b>普通充值</b></th>
				<th class="text-right"><b>普通充值支付订单数</b></th>
				<th class="text-right"><b>年费会员</b></th>
				<th class="text-right"><b>年费会员支付订单数</b></th>
				<th class="text-right"><b>终生会员</b></th>
				<th class="text-right"><b>终生会员支付订单数</b></th>
			</tr>
			</thead>
			<tbody>
				<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
					<td><span><?php echo ($v["date"]); ?></span></td>
					<td class="text-right">
						<b>¥ <span><?php echo ($v["charge_total"]); ?></span></b>
					</td>
					
					<td class="text-right">
						¥ <span><?php echo ($v["pcharge"]); ?></span>
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							充值人数: <span><?php echo ($v["pchargeperson"]); ?></span>,
							人均: ¥ <span>
							<?php echo ($v['pcharge']/$v['pchargeperson']); ?>
							</span>
						</div>
					</td>
					<td class="text-right">
						<span><?php echo ($v["pchargenums"]); ?></span> 笔
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							<span><?php echo ($v["pchargewnums"]); ?></span> 笔未支付,
							完成率: <span>
							<?php  $all = $v['pchargenums'] + $v['pchargewnums']; $lv = sprintf("%.2f",$v['pchargenums']/$all)*100; echo $lv; ?>
							</span> %
						</div>
					</td>
					
					<td class="text-right">
						¥ <span><?php echo ($v["ycharge"]); ?></span>
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							充值人数: <span><?php echo ($v["ychargeperson"]); ?></span>,
							人均: ¥ <span>
							<?php echo ($v['ycharge']/$v['ychargeperson']); ?>
							</span>
						</div>
					</td>
					<td class="text-right">
						<span><?php echo ($v["ychargenums"]); ?></span> 笔
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							<span><?php echo ($v["ychargewnums"]); ?></span> 笔未支付,
							完成率: <span>
							<?php  $all = $v['ychargenums'] + $v['ychargewnums']; $lv = sprintf("%.2f",$v['ychargenums']/$all)*100; echo $lv; ?>
							</span> %
						</div>
					</td>
					
					<td class="text-right">
						¥ <span><?php echo ($v["zcharge"]); ?></span>
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							充值人数: <span><?php echo ($v["zchargeperson"]); ?></span>,
							人均: ¥ <span>
							<?php echo ($v['zcharge']/$v['zchargeperson']); ?>
							</span>
						</div>
					</td>
					<td class="text-right">
						<span><?php echo ($v["zchargenums"]); ?></span> 笔
						<div class="text-muted" style="font-size:13px;margin-top:5px">
							<span><?php echo ($v["zchargewnums"]); ?></span> 笔未支付,
							完成率: <span>
							<?php  $all = $v['zchargenums'] + $v['zchargewnums']; $lv = sprintf("%.2f",$v['zchargenums']/$all)*100; echo $lv; ?>
							</span> %
						</div>
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
<!--</section>-->
</div>

<script>
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