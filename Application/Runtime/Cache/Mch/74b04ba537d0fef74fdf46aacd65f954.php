<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>代理后台</title>
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
            <span class="slogan" style=" border-left-color:#396F08; color:#fff">代理管理系统</span>
                 
            <br clear="all" />
            
        </div><!--left-->
		<div class="right">
        	 <span style=" color:#fff;"><?php echo session('mch.mobile');?> <a href="<?php echo U('Index/logout');?>" style=" color:#ccc;">[退出]</a></span>
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
				<a href="<?php echo U('Admin/welcome');?>">
					<span class="glyphicon glyphicon-volume-down" aria-hidden="true"></span>
					<span class="text">通知列表</span>
				</a>
            </li>
			<li>
				<a href="#Finance" class="elements">
					<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
					<span class="text">数据统计</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="Finance">
					<li><a href="<?php echo U('Finance/users');?>">用户统计</a></li>
               		<li><a href="<?php echo U('Finance/charge');?>">充值统计</a></li>
					<li><a href="<?php echo U('Finance/separate');?>">分成统计</a></li>
                </ul>
            </li>
			<li>
				<a href="<?php echo U('Mch/index');?>">
					<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
					<span class="text">个人中心</span>
				</a>
            </li>
			<li>
				<a href="#send" class="elements">
					<span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
					<span class="text">推广管理</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="send">
					<li><a href="<?php echo U('Chapter/index');?>">漫画合集</a></li>
               		<li><a href="<?php echo U('Bhapter/index');?>">小说合集</a></li>
                </ul>
            </li>
			<li>
				<a href="<?php echo U('Chapurl/index');?>" class="addons">
					<span class="glyphicon glyphicon-share" aria-hidden="true"></span>
					<span class="text">推广文案管理</span>
				</a>
            </li>
			<li>
				<a href="#withdraw" class="elements">
					<span class="glyphicon glyphicon-gift" aria-hidden="true"></span>
					<span class="text">提现管理</span>
				</a>
            	<span class="arrow"></span>
            	<ul id="withdraw">
					<li><a href="<?php echo U('Mch/edit');?>">申请提现</a></li>
               		<li><a href="<?php echo U('Mch/withdraw');?>">提现记录</a></li>
                </ul>
            </li> 
			<!--li>
				<a href="javascript:alert('啊哦~，还没有视频链接！');" target="_blank" class="addons">
					<span class="glyphicon glyphicon-film" aria-hidden="true"></span>
					<span class="text">推广链接视频</span>
				</a>
            </li>
			<li>
				<a href="javascript:alert('啊哦~，还没有视频链接！');" target="_blank" class="addons">
					<span class="glyphicon glyphicon-film" aria-hidden="true"></span>
					<span class="text">平台教程视频</span>
				</a>
            </li-->
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
        
    <div class="centercontent">
				<link href="/Public/layer/skin/layer.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="/Public/layer/layer.js"></script>
		<script type="text/javascript" src="/Public/js/clipboard.min.js"></script>
        <div class="pageheader notab">
            <h1 class="pagetitle">文案链接管理</h1>
            <span class="pagedesc">对文案链接操作</span>
            
        </div><!--pageheader-->
        <style>
			.contentwrapper p {
				margin: 0px;
			}
		</style>
        <div id="contentwrapper" class="contentwrapper lineheight21" style="background:#fff">
        
			<div class="tableoptions">        
				<form method="post" id="form">
					链接类型:
					<select name="type" default="<?php echo ($_GET['type']); ?>" style="width:90px; min-width:0;">
						<option value="">全部</option>
						<option value="1">漫画链接</option>
						<option value="2">小说链接</option>
					</select>
					漫画或小说名称:
					<input type="text" name="title" value="<?php echo ($_GET['title']); ?>" class="smallinput" style="width:350px;" />
					<input type="submit" value="查找" />				
					</script>
				</form>
			</div><!--tableoptions-->		
			<table cellpadding="0" cellspacing="0" border="0" id="table2" class="stdtable stdtablecb">
				<thead>
					<tr>
					    <th class="head1">名称</th>
					    <th class="head1">创建时间</th>
						<th class="head1" width="300">本章节链接</th>
						<th class="head1" width="300">原文链接</th>
						<th class="head1">二维码</th>
						<th class="head1">入口章节</th>
						<th class="head1">关注</th>
						<th class="head1">点击</th>
						<th class="head1">充值</th>
						<th class="head1">点击/充值</th>
						<th class="head1">操作</th>
					</tr>
				</thead>
				<tbody>

					<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
					    <td>
							<p><h1 style="font-size: 16px;"><?php echo ($vo["name"]); ?></h1></p>
						</tb>
						<td>
							<p><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></p>						</tb>
						<td>
					    	<p><?php echo ($vo["burl"]); ?></p>
							<p style="margin-top:10px;cursor:pointer" data-clipboard-action="copy" data-clipboard-text="<?php echo ($vo["burl"]); ?>" class="copy">
							   <!--<a href="javascript:;" onclick="getshorturl('<?php echo ($vo["burl"]); ?>')" ><span class="glyphicon glyphicon-copy"  style="color:blue">生成短连接 </span></a>-->
							   <a href="https://sina.lt/index.html" target="_blank"><span class="glyphicon glyphicon-copy"  style="color:blue">复制 生成短连接 </span></a>
							</p>
							
						</td>
						<td>
							<p><?php echo ($vo["url"]); ?></p>
							<p style="margin-top:10px;cursor:pointer" data-clipboard-action="copy" data-clipboard-text="<?php echo ($vo["url"]); ?>"  class="copy">
							  <!--<a href="javascript:;" onclick="getshorturl('<?php echo ($vo["url"]); ?>')" > <span class="glyphicon glyphicon-copy"  style="color:blue"> 生成短连接</span> </a>-->
							  <a href="https://sina.lt/index.html" target="_blank"><span class="glyphicon glyphicon-copy"  style="color:blue">复制 生成短连接 </span></a>
							</p>
						  
						</td>
						<td class="center">
							<a href="javascript:;" onclick="showQrcode(<?php echo ($vo['id']); ?>)" style="color:blue">点击查看</a>
						</td>
						<td>
							<p><img src="<?php echo ($vo["pic"]); ?>" style="width:80px;height:50px;"/></p>
							<p><?php echo ($vo["title"]); ?></p>
							<p>第<?php echo ($vo["ji_no"]); ?>话	<?php echo ($vo["etitle"]); ?></p>	
						</td>
						<td><?php echo ($vo["subscribe"]); ?></td>
						<td><?php echo ($vo["read"]); ?></td>
						<td><?php echo ($vo["charge"]); ?></td>
						<td>
							<?php if($vo['charge'] > 0): echo ($vo['read']/$vo['charge']); ?>%
							<?php else: ?>
							0%<?php endif; ?>
						</td>
						<td class="center">
							<a href="<?php echo U('del', 'id='.$vo['id']);?>" onclick="return confirm('你确实要删除？')">删除</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div class="dataTables_paginate paging_full_numbers" id="dyntable2_paginate">
			<?php echo ((isset($page) && ($page !== ""))?($page):"<p style='text-align:center'>暂时没有数据</p>"); ?>
			</div>
        
        </div><!--contentwrapper-->
		<script>
			var $ = jQuery;
			var clipboard = new Clipboard('.copy');
			clipboard.on('success', function(e) {
				e.clearSelection();
				layer.msg('已经复制到粘贴板！', {icon: 1, time: 1500,});
			});
			
			function getshorturl(url){
			    
			    $.post( "<?php echo U('Admin/get_short_url');?>&url="+window.btoa(url), {}, function(str){
                       layer.open({
                        type: 1,
                        title: '生成短连接',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['400px', '360px'],
                        content: str //注意，如果str是object，那么需要字符拼接。
                      });
                    });
                    			    
			//    layer.open({
			//	  type: 0,
			//	  title: '生成短连接',
			//	  shadeClose: true,
			//	  shade: 0.8,
			//	  area: ['400px', '360px'],
			//	  content: "<?php echo U('Admin/get_short_url');?>&v=1.0&url="+window.btoa(url),
			//	}); 
				
			}
			
			function showQrcode(id){
				layer.open({
				  type: 2,
				  title: '查看二维码',
				  shadeClose: true,
				  shade: 0.8,
				  area: ['400px', '360px'],
				  content: "<?php echo U('showQrcode');?>&id="+id,
				});
			}
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