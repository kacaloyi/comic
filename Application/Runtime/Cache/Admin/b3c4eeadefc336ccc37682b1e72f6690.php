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
            <h1 class="pagetitle">编辑漫画</h1>
            <span class="pagedesc">请认真编辑漫画的各项信息</span>
            
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper lineheight21">
			
        
            <form class="stdform stdform2" method="post" enctype="multipart/form-data">
				<style>
				.form-table{ width:100%; background:#ddd;}
				.form-table th,.form-table td{ padding:15px;}
				.form-table th.title{ width:190px; background:#fcfcfc; color:#666; text-align:left;}
				.form-table th small{ font-weight:normal; color:#999; display:block;}
				.form-table td{ background:#fff; vertical-align:middle;}
				</style>
				<table class="form-table" cellspacing="1" border="0">
					<tr>
						<th class="title">漫画标题<small>漫画名称</small></th>
						<td>
							<input type="text" name="title" id="title" value="<?php echo ($info["title"]); ?>" class="smallinput" />
						</td>
					</tr>
					<tr>
						<th class="title">漫画作者<small></small></th>
						<td>
							<input type="text" name="author" id="author" value="<?php echo ($info["author"]); ?>" class="smallinput" />
						</td>
					</tr>
					<tr>
						<th class="title">排序权值<small></small></th>
						<td>
							<input type="text" name="sort" id="sort" value="<?php echo ($info["sort"]); ?>" class="smallinput" />
						</td>
					</tr>
					<tr>
						<th class="title">漫画首页分类</th>
						<td>
							<?php if(is_array($_mhcate)): foreach($_mhcate as $k=>$v): if($v['show'] == 2): ?><input type="checkbox" name="mhcate[]" id="mhcate" value="<?php echo ($k); ?>"  <?php if(in_array($k, $mhcate)): ?>checked<?php endif; ?> /><?php echo ($v['name']); ?>&nbsp;&nbsp;&nbsp;<?php endif; endforeach; endif; ?>
						</td>
					</tr>
					<tr>
					<th class="title">所属分类</th>
					<td>
					<input type="checkbox" name="arrcateids[]" id="arrcateids9" value="9"  <?php if(in_array(9, $arrcateids)): ?>checked<?php endif; ?> />霸总&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids2" value="2"  <?php if(in_array(2, $arrcateids)): ?>checked<?php endif; ?> />仙侠&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids10" value="10"  <?php if(in_array(10, $arrcateids)): ?>checked<?php endif; ?> />恋爱&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids11" value="11"  <?php if(in_array(11, $arrcateids)): ?>checked<?php endif; ?> />校园&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids12" value="12"  <?php if(in_array(12, $arrcateids)): ?>checked<?php endif; ?> />冒险&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids13" value="13"  <?php if(in_array(13, $arrcateids)): ?>checked<?php endif; ?> />搞笑&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids14" value="14"  <?php if(in_array(14, $arrcateids)): ?>checked<?php endif; ?> />生活&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids15" value="15"  <?php if(in_array(15, $arrcateids)): ?>checked<?php endif; ?> />热血&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids16" value="16"  <?php if(in_array(16, $arrcateids)): ?>checked<?php endif; ?> />架空&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids17" value="17"  <?php if(in_array(17, $arrcateids)): ?>checked<?php endif; ?> />后宫&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids18" value="18"  <?php if(in_array(18, $arrcateids)): ?>checked<?php endif; ?> />耽美&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids1" value="1"  <?php if(in_array(1, $arrcateids)): ?>checked<?php endif; ?> />玄幻&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids19" value="19"  <?php if(in_array(19, $arrcateids)): ?>checked<?php endif; ?> />悬疑&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids20" value="20"  <?php if(in_array(20, $arrcateids)): ?>checked<?php endif; ?> />恐怖&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids7" value="7"  <?php if(in_array(7, $arrcateids)): ?>checked<?php endif; ?> />灵异&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids21" value="21"  <?php if(in_array(21, $arrcateids)): ?>checked<?php endif; ?> />动作&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids6" value="6"  <?php if(in_array(6, $arrcateids)): ?>checked<?php endif; ?> />科幻&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids22" value="22"  <?php if(in_array(22, $arrcateids)): ?>checked<?php endif; ?> />战争&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids23" value="23"  <?php if(in_array(23, $arrcateids)): ?>checked<?php endif; ?> />古风&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids24" value="24"  <?php if(in_array(24, $arrcateids)): ?>checked<?php endif; ?> />穿越&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids25" value="25"  <?php if(in_array(25, $arrcateids)): ?>checked<?php endif; ?> />竞技&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids26" value="26"  <?php if(in_array(26, $arrcateids)): ?>checked<?php endif; ?> />百合&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids27" value="27"  <?php if(in_array(27, $arrcateids)): ?>checked<?php endif; ?> />励志&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids28" value="28"  <?php if(in_array(28, $arrcateids)): ?>checked<?php endif; ?> />同人&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="arrcateids[]" id="arrcateids29" value="29"  <?php if(in_array(29, $arrcateids)): ?>checked<?php endif; ?> />真人&nbsp;&nbsp;&nbsp;
					</td>
					</tr>
					<tr>
						<th class="title">属性</th>
						<td>
							<input name="free_type" type="radio" value="1" <?php if($info['free_type'] == 1): ?>checked<?php endif; ?> />免费&nbsp;&nbsp;&nbsp;
							<input name="free_type" type="radio" value="2" <?php if($info['free_type'] == 2): ?>checked<?php endif; ?> />付费&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
					<tr>
						<th class="title">VIP专属</th>
						<td>
							<input name="isvip" type="radio" value="1" <?php if($info['isvip普通'] == 1): ?>checked<?php endif; ?> />普通&nbsp;&nbsp;&nbsp;
							<input name="isvip" type="radio" value="2" <?php if($info['isvip'] == 2): ?>checked<?php endif; ?> />VIP专属&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
					<tr>
						<th class="title">开始需要付费话数<small>第m话开始需要付费，免费填0</small></th>
						<td>
							<input type="text" name="pay_num" id="pay_num" value="<?php echo ($info["pay_num"]); ?>" class="smallinput" placeholder="默认免费0" />（当前共<?php echo ($info["episodes"]); ?>话）
						</td>
					</tr>
					<tr>
						<th class="title">初始化人气值<small></small></th>
						<td>
							<input type="text" name="reader" id="reader" value="<?php echo ($info["reader"]); ?>" class="smallinput" placeholder="" />
						</td>
					</tr>
					<tr>
						<th class="title">初始化点赞数<small></small></th>
						<td>
							<input type="text" name="likes" id="likes" value="<?php echo ($info["likes"]); ?>" class="smallinput" placeholder="" />
						</td>
					</tr>
					<tr>
						<th class="title">初始化收藏数<small></small></th>
						<td>
							<input type="text" name="collect" id="collect" value="<?php echo ($info["collect"]); ?>" class="smallinput" placeholder="" />
						</td>
					</tr>
					<tr>
						<th class="title">是否最近更新</th>
						<td>
							<input name="is_new" type="radio" value="1" <?php if($info['is_new'] == 1): ?>checked<?php endif; ?> />是&nbsp;&nbsp;&nbsp;
							<input name="is_new" type="radio" value="0" <?php if($info['is_new'] == 0): ?>checked<?php endif; ?> />否&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
					<tr>
						<th class="title">是否精选推荐</th>
						<td>
							<input name="is_recomm" type="radio" value="1" <?php if($info['is_recomm'] == 1): ?>checked<?php endif; ?> />是&nbsp;&nbsp;&nbsp;
							<input name="is_recomm" type="radio" value="0" <?php if($info['is_recomm'] == 0): ?>checked<?php endif; ?> />否&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
					<tr>
						<th class="title">是否已完结</th>
						<td>
							<input name="status" type="radio" value="2" <?php if($info['status'] == 2): ?>checked<?php endif; ?> />已完结&nbsp;&nbsp;&nbsp;
							<input name="status" type="radio" value="1" <?php if($info['status'] == 1): ?>checked<?php endif; ?> />连载中&nbsp;&nbsp;&nbsp;
						</td>
					</tr>
					<tr>
						<th class="title">
							漫画封面图（用于列表）
						</th>
						<td>
							<input type="text" name="cover_pic" id="cover_pic" value="<?php echo ($info["cover_pic"]); ?>" class="smallinput" />
						</td>
					</tr>
					<tr>
						<th class="title">
							漫画详情图（用于详情介绍页）
						</th>
						<td>
							<input type="text" name="detail_pic" id="detail_pic" value="<?php echo ($info["detail_pic"]); ?>" class="smallinput" />
						</td>
					</tr>
					<?php if(empty($_GET['id'])): ?><tr>
						<th class="title">
							漫画分集上传
							<small>若上传，则自动添加漫画分集,上传zip文件，压缩包内直接为txt格式文件内容</small>
						</th>
						<td>
							<input type="file" name="cert" />
						</td>
					</tr><?php endif; ?>
					
					
					<tr>
						<th class="title">
							漫画分享标题
						</th>
						<td>
							<input type="text" name="share_title" id="share_title" value="<?php echo ($info["share_title"]); ?>" class="smallinput" />
						</td>
					</tr>
					
					<tr>
						<th class="title">
							漫画分享简介
						</th>
						<td>
							<input type="text" name="share_desc" id="share_desc" value="<?php echo ($info["share_desc"]); ?>" class="smallinput" />
						</td>
					</tr>
					
					<tr>
						<th class="title">
							分享logo图片
						</th>
						<td>
							<iframe src="<?php echo U('upload', 'event=setPics&url='.$info['share_pic']);?>" scrolling="no" width="100" height="100"></iframe>
							<input type="hidden" name="share_pic" id="share_pic" value="<?php echo ($info['share_pic']); ?>" class="smallinput" />
							<script>
							function setPics(url){
								document.getElementById('share_pic').value = url;
							}
							</script>
						</td>
					</tr>
					
					
					<tr>
						<th class="title">漫画简介</th>
						<td>
							<textarea name="summary" id="summary" class="longinput" style="margin: 0px; height: 120px; max-width:1640px;"><?php echo ($info["summary"]); ?></textarea>
						</td>
					</tr>
				</table>
				
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