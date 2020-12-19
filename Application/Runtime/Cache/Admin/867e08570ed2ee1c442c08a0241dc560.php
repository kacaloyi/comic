<?php if (!defined('THINK_PATH')) exit();?>	 
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>管理后台</title>
	<link rel="stylesheet" href="/Public/admin/css/style.default.css" type="text/css" />
	<link rel="stylesheet" href="/Public/plugins/bootstrap/css/bootstrap.font.css" type="text/css" />
	<script type="text/javascript" src="/Public/admin/js/plugins/jquery-1.7.min.js"></script>
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
	<style>
		.yp{
			display: block;
			float: right;
			background: #FF5722;
			color: #fff;
			border-radius: 5px;
			width: 70px;
			text-align: center;
			line-height: 20px;
		}
		.r3{
			float: left;
			border: none;
			color: #fff;
			background: #FF5722;
			margin-top: -2.5px;
			margin-left: 10px;
			border-radius: 4px;
			text-align: center;
		}
	</style>
	<body>
        <div id="contentwrapper" class="contentwrapper lineheight21">
			<table cellpadding="0" cellspacing="0" border="0" id="table2" class="stdtable stdtablecb">
				<thead>
					<tr>
						<th class="head1">充值用户</th>
						<th class="head1">充值单号</th>
						<th class="head0">充值金额</th>
						<th class="head0">分成金额</th>
						<th class="head0">分成时间</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($vo["user_id"]); ?></td>
						<td><?php echo ($vo["sn"]); ?></td>
						<td><?php echo ($vo["pay"]); ?></td>
						<td><?php echo ($vo["money"]); ?></td>
						<td><?php echo (date("Y-m-d H:i:s",$vo["pay_time"])); ?></td>						
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div class="dataTables_paginate paging_full_numbers" id="dyntable2_paginate">
				<?php echo ((isset($page) && ($page !== ""))?($page):"<p style='text-align:center'>暂时没有数据</p>"); ?>
			</div>
        
        </div><!--contentwrapper-->
	</body>
	</html>