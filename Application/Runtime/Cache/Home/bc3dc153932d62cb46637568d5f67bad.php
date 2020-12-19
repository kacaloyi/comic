<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html data-dpr="1" style="font-size: 43.1px;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($info["title"]); ?>_<?php echo ($binfo['title']); ?>_<?php echo ($_CFG['site']['name']); ?>小说网</title>
<meta name="keywords" content="<?php echo ($info["title"]); ?>,<?php echo ($binfo['title']); ?>">
<meta name="description" content="<?php echo ($_CFG['site']['name']); ?>提供了<?php echo ($binfo['author']); ?>创作的言情小说《<?php echo ($binfo['title']); ?>》干净清爽无错字的文字章节：<?php echo ($info["title"]); ?>在线阅读。">
<!-- 共用引入资源.开始 -->

<script src="/Public/home/mhjs/stats.js" name="MTAH5" sid="500462993"></script>
<meta name="viewport" content="designWidth=750,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- 防止加载lib.flexible加载的时候文字由大变小的闪烁 -->
<style>html,body{font-size:12px;}</style>
<!-- lib.flexible 移动端相对适应比例 必须在浏览器head类 -->
<script type="text/javascript">
	!function (a, b) { function c() { var b = f.getBoundingClientRect().width; b / i > 540 && (b = 540 * i); var c = b / 10; f.style.fontSize = c + "px", k.rem = a.rem = c } var d, e = a.document, f = e.documentElement, g = e.querySelector('meta[name="viewport"]'), h = e.querySelector('meta[name="flexible"]'), i = 0, j = 0, k = b.flexible || (b.flexible = {}); if (g) {  var l = g.getAttribute("content").match(/initial\-scale=([\d\.]+)/); l && (j = parseFloat(l[1]), i = parseInt(1 / j)) } else if (h) { var m = h.getAttribute("content"); if (m) { var n = m.match(/initial\-dpr=([\d\.]+)/), o = m.match(/maximum\-dpr=([\d\.]+)/); n && (i = parseFloat(n[1]), j = parseFloat((1 / i).toFixed(2))), o && (i = parseFloat(o[1]), j = parseFloat((1 / i).toFixed(2))) } } if (!i && !j) { var p = (a.navigator.appVersion.match(/android/gi), a.navigator.appVersion.match(/iphone/gi)), q = a.devicePixelRatio; i = p ? q >= 3 && (!i || i >= 3) ? 3 : q >= 2 && (!i || i >= 2) ? 2 : 1 : 1, j = 1 / i } if (f.setAttribute("data-dpr", i), !g) if (g = e.createElement("meta"), g.setAttribute("name", "viewport"), g.setAttribute("content", "initial-scale=" + 1 + ", maximum-scale=" + 1 + ", minimum-scale=" + 1 + ", user-scalable=no"), f.firstElementChild) f.firstElementChild.appendChild(g); else { var r = e.createElement("div"); r.appendChild(g), e.write(r.innerHTML) } a.addEventListener("resize", function () { clearTimeout(d), d = setTimeout(c, 300) }, !1), a.addEventListener("pageshow", function (a) { a.persisted && (clearTimeout(d), d = setTimeout(c, 300)) }, !1), "complete" === e.readyState ? e.body.style.fontSize = 12 * i + "px" : e.addEventListener("DOMContentLoaded", function () { e.body.style.fontSize = 12 * i + "px" }, !1), c(), k.dpr = a.dpr = i, k.refreshRem = c, k.rem2px = function (a) { var b = parseFloat(a) * this.rem; return "string" == typeof a && a.match(/rem$/) && (b += "px"), b }, k.px2rem = function (a) { var b = parseFloat(a) / this.rem; return "string" == typeof a && a.match(/px$/) && (b += "rem"), b } }(window, window.lib || (window.lib = {}));
</script>
<link rel="stylesheet" type="text/css" href="/Public/home/mhcss/style.min.css">
<link rel="stylesheet" type="text/css" href="/Public/font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/Public/home/css/vendor.css">
<script type="text/javascript" src="/Public/home/mhjs/fundebug.0.1.7.min.js" apikey="ba3a0e0d938e92b44f279067dffb8d071ee87fc35eb75918b7a900e8581a955d"></script>
<script type="text/javascript" src="/Public/home/mhjs/jquery.js"></script>
<!-- 共用引入资源.结束 -->
<script type="text/javascript" src="/Public/home/mhjs/saved_resource"></script>
<script type="text/javascript" src="/Public/home/js/newWindow.js"></script>
</head>
<style>
.night {
    background-image: url(http://oss.ycsd.cn/ycsd_web/images/night-body-bg.png);
}
.night p{background-color:transparent!important;color:#666!important}
.night .rt-bar{background-color:transparent!important;background:#000;}
.night .rt-bar > .row {background: #0C0F0F;color:#666}
.night .read-footer{background-color:transparent!important;}
.night .read-footer a{color:#666}
.night .circle-box > a{background-color:#545f5e;color:#999;}
.night .circle-box > a.portal i{background-color:#666;}





.anfen {
    background-color: #ffe3e7;
}
.anfen p{background-color:transparent!important;color:#e82363!important}
.anfen .rt-bar{background-color:transparent!important;background:#ffe3e7;}
.anfen .rt-bar > .row {background: #ffe3e7;color:#e82363}
.anfen .read-footer{background-color:transparent!important;}
.anfen .read-footer a{color:#666}
.anfen .circle-box > a{background-color:#545f5e;color:#e82363;}
.anfen .circle-box > a.portal i{background-color:#ffe3e7;}
.anfen .read-footer > .control .item a {color: #e82363}


.lianglan {
    background-color: #415062;
}
.lianglan p{background-color:transparent!important;color:#fff6e6!important}
.lianglan .rt-bar{background-color:transparent!important;background:#415062;}
.lianglan .rt-bar > .row {background: #415062;color:#fff6e6}
.lianglan .read-footer{background-color:transparent!important;}
.lianglan .read-footer a{color:#666}
.lianglan .circle-box > a{background-color:#545f5e;color:#fff6e6;}
.lianglan .circle-box > a.portal i{background-color:#415062;}
.lianglan .read-footer > .control .item a {color: #fff6e6}

.huihui {
    background-color: #414441;
}
.huihui p{background-color:transparent!important;color:#d5cecd!important}
.huihui .rt-bar{background-color:transparent!important;background:#414441;}
.huihui .rt-bar > .row {background: #414441;color:#d5cecd}
.huihui .read-footer{background-color:transparent!important;}
.huihui .read-footer a{color:#666}
.huihui .circle-box > a{background-color:#545f5e;color:#d5cecd;}
.huihui .circle-box > a.portal i{background-color:#414441;}
.huihui .read-footer > .control .item a {color: #d5cecd}




.moshi {
    background-color: #d5c6ac;
}
.moshi p{background-color:transparent!important;color:#494c49!important}
.moshi .rt-bar{background-color:transparent!important;background:#d5c6ac;}
.moshi .rt-bar > .row {background: #d5c6ac;color:#494c49}
.moshi .read-footer{background-color:transparent!important;}
.moshi .read-footer a{color:#666}
.moshi .circle-box > a{background-color:#545f5e;color:#494c49;}
.moshi .circle-box > a.portal i{background-color:#d5c6ac;}
.moshi .read-footer > .control .item a {color: #494c49}

.mozhu {
    background-color: #b5eecd;
}
.mozhu p{background-color:transparent!important;color:#414c41!important}
.mozhu .rt-bar{background-color:transparent!important;background:#b5eecd;}
.mozhu .rt-bar > .row {background: #b5eecd;color:#414c41}
.mozhu .read-footer{background-color:transparent!important;}
.mozhu .read-footer a{color:#666}
.mozhu .circle-box > a{background-color:#545f5e;color:#414c41;}
.mozhu .circle-box > a.portal i{background-color:#b5eecd;}
.mozhu .read-footer > .control .item a {color: #414c41}

.chihei {
    background-color: #081010;
}
.chihei p{background-color:transparent!important;color:#b58931!important}
.chihei .rt-bar{background-color:transparent!important;background:#081010;}
.chihei .rt-bar > .row {background: #081010;color:#b58931}
.chihei .read-footer{background-color:transparent!important;}
.chihei .read-footer a{color:#666}
.chihei .circle-box > a{background-color:#545f5e;color:#b58931;}
.chihei .circle-box > a.portal i{background-color:#081010;}
.chihei .read-footer > .control .item a {color: #b58931}









.rt-bar > .row {
    /*position: fixed;*/
    background: #fff;
}
.rt-bar > .row .link {
    width: 1.3rem;
    height: .7rem;
    border: 1px solid #666;
    border-radius: 5px;
    margin: .35rem .2rem;
}
.rt-bar > .row .link a {
    font-size: .3733rem;
    color: #666;
	width: 1.3rem;
    height: .7rem;
	line-height:.75rem;
}
.read-article {
    padding-top: 1.533rem;
}
.tonight{
	display:none;
	height: 5.0rem;
    width: 100%;
    position: fixed;
    bottom: 0;
    left: 0;
	z-index: 99;
	background: rgba(0,0,0,.8);
}
.tonight ul{
	width:100%;
	height:auto;
	display: -webkit-box;
}
.tonight ul li{
	-webkit-box-flex: 1;
}
.tonight ul li:nth-child(1){
	border-right:1px solid #bb9c9c;
}
.tonight div{
	height:1.5rem;
	width:1.5rem;
	margin:0 auto;
}
.tonight i{
	display: block;
    color: #fff;
    font-size: .6rem;
    margin: .2rem 0 .1rem 0;
    text-align: center;
}
.tonight span{
	display: block;
    text-align: center;
    color: #fff;
    font-size: .38rem;
}
.item p{
	line-height:30px;
	margin-bottom:5px;
}
.tonight .color-match
{
	width: 100%;
	height: 80px;
	padding: 20px 20px;
	box-sizing: border-box;
	overflow-x: auto;
	overflow-y: hidden; 
white-space: nowrap;
}
.tonight .color-match .colors
{
	width: 18%;
	height: auto;
	background-color: rgba(255,159,254,1);
position: relative;
display: inline-block;
padding:10px;
	color: #fff;
	font-size: 15px;
	margin: 0px 5px;
	text-align: center;
}
.tonight .color-match .chihei
{
	background-color: #081010;
	color: #b58931;
}
.tonight .color-match .mozhu
{
	background-color: #b5eecd;
	color: #414c41;
}
.tonight .color-match .moshi
{
	background-color: #d5c6ac;
	color: #494c49;
}
.tonight .color-match .huihui
{
	background-color: #414441;
	color: #d5cecd;
}
.tonight .color-match .lianglan
{
	background-color: #415062;
	color: #fff6e6;
}
.tonight .color-match .anfen
{
	background-color: #ffe3e7;
	color: #e82363;
}
.tonight .zihao
{
	width: 100%;
	height: 50px;
	display: flex;
	justify-content: space-around;
	color: #eee;
	margin-top: 5px;
}
.tonight .color-match .act
{
	border: 1px #fff solid;
}
.zihao div
{
	display: inline-block;
	margin: 0px;
	height: auto;
	text-align: center;
	font-size: 25px;

	padding-top: 5px;
	box-sizing: border-box;
}
.zihao .ttf
{
	width: 20%;
	border: 1px solid #eee;
	border-radius: 5px;
}
.zihao .jin
{
	color: #666;
	border: 1px solid #666;
}
</style>
<body style="font-size: 12px;" class="">

<div class="tonight">
	<ul>
		<li class="sun">
			<div>
				<i  class="fa fa-sun-o"></i>
				<span>白天</span>
			</div>
		</li>
		<li class="moon">
			<div>
				<i  class="fa fa-moon-o"></i>
				<span>夜间</span>
			</div>
		</li>
	</ul>
	<div class="zihao"> <div class="ttf ajian">A-</div>  <div class="zh">9</div> <div class="ttf ajia">A+</div>  </div>
	<div class="color-match">
		<div class="colors chihei">赤金/暗黑</div>
      	<div class="colors mozhu">墨绿/若竹</div>
		<div class="colors moshi">墨绿/赭石</div>
		<div class="colors huihui">灰白/深灰</div>
		<div class="colors lianglan">亮白/暗蓝</div>
		<div class="colors anfen">暗红/淡粉</div>



	     </div>
	
</div>

<div class="rt-bar" style="position: fixed">
    <div class="row">
        <div class="col icon">
            <a href="<?php echo U('Book/'.$bid);?>">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40"><path d="M29.56 39.47a2 2 0 0 1-1.38-.56L8.45 20 28.17 1.09A2 2 0 1 1 30.94 4L14.23 20l16.71 16a2 2 0 0 1-1.38 3.44z" fill="#ff730a"></path></svg>
            </a>
        </div>
        <div class="col title"><?php echo ($info["title"]); ?></div>
        <div class="col link">
            <a href="javascript:;"onclick="show();">设置</a>
        </div>
    </div>
</div>
<article class="read-article">

<!--顶部广告代码开始-->

<!--顶部广告代码结束-->
    <?php if(is_array($arr_pics)): $i = 0; $__LIST__ = $arr_pics;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><figure class="item" style="">
        <img class="show-menu" src="<?php echo ($vo); ?>" data-id="2" data-original="<?php echo ($vo); ?>" style="background: rgb(238, 238, 238); display: block;">
    </figure><?php endforeach; endif; else: echo "" ;endif; ?>
</article>

<article class="read-article">
    <figure class="item" style="font-size:18px;padding: 0 15px;">
        <?php echo ($info["info"]); ?>
    </figure>
</article>
<!--底部广告代码开始-->

<!--底部广告代码结束-->
<!--底部漂浮广告代码开始-->

<!--底部漂浮广告代码结束-->
<script>
	
	$('.item').click(function(){
		show();
	});	
	
	function show(){
		if($(".tonight").css("display") == "none"){
			$(".tonight").slideDown("500");
		}else{
			$(".tonight").slideUp("500");
		}
	}
	$('.ajian').click(function () {
		$('.ajia').removeClass('jin');
		if(parseInt($('.zh').text())<=5)
		{
			$('.ajian').addClass('jin');
		}
		else
		{
		$('.zh').text(parseInt($('.zh').text())-1);
		$('.item').css('font-size',parseInt($('.zh').text())+9+'px');
		if(parseInt($('.zh').text())<=5)
		{
			$('.ajian').addClass('jin');
		}
		}
		fsize = parseInt($('.zh').text())+9;

	});
	$('.ajia').click(function () {
		$('.ajian').removeClass('jin');
		if(parseInt($('.zh').text())>=15)
		{
			$('.ajia').addClass('jin');
		}
		else
		{
		$('.zh').text(parseInt($('.zh').text())+1);
		$('.item').css('font-size',parseInt($('.zh').text())+9+'px');
		if(parseInt($('.zh').text())>=15)
		{
			$('.ajia').addClass('jin');
		}
	}

		fsize = parseInt($('.zh').text())+9;

	});
</script>
<style>
.zshu{
	text-align: center;
}
.zshu a{
	display: block;
    padding: .2rem .5rem;
    border: 1px solid #F44336;
    background: #F44336;
    width: 40%;
    color: #fff;
    margin: 1rem auto 0rem auto;
    border-radius: .3rem;
    font-size: .38rem;
    text-align: center;
}
</style>
<div class="read-footer">
	<div class="zshu">
		<a href="javascript:;" onclick="$('.pos').show();">追书</a>
	</div>
    <div class="row">
        <div class="col">
            <a href="javascript:void(0);" onclick="collect(<?php echo ($bid); ?>)" id="collect" <?php if($collect): ?>class="shelf active"<?php else: ?>class="shelf"<?php endif; ?> style="-webkit-tap-highlight-color: rgba(0,0,0,0);">
                <i class="icon-fav"></i>收藏
            </a>
        </div>
        <div class="col">
            <a href="<?php echo U('Book/'.$info[bid]).'?isji=1';?>" style="-webkit-tap-highlight-color: rgba(0,0,0,0);">
                <i class="icon-dir"></i>目录
            </a>
        </div>
        <div class="col">
            <a href="javascript:;" onclick="chapter_dianzan(<?php echo ($bid); ?>, <?php echo ($_GET['ji_no']); ?>);" id="showcoll" <?php if($likes > 0): ?>class="zan active"<?php else: ?>class="zan"<?php endif; ?> style="-webkit-tap-highlight-color: rgba(0,0,0,0);">
                <i class="icon-good"></i>赞
                <span id="showlikesnum"><?php echo ((isset($info["likes"]) && ($info["likes"] !== ""))?($info["likes"]):"0"); ?></span>
            </a>
        </div>
    </div>
<?php if($user['vip']): else: ?>
     <div class="row">
      <a href="<?php echo U('Mh/pay');?>"style="text-align:center;">
        <img width="100%" class="slide_loading" src="/Public/Uploads/banner/vip-img.png" data-original="/Public/Uploads/banner/vip-img.png" alt="升级VIP" />
        </a>
    </div><?php endif; ?>  
    <div class="control clearfix">
        <div class="item prev">
        <?php
 $before = $info['before']; if($before <= 1) { $before = 1; } $next = $info['next']; $money = M('book_episodes')->where(array('ji_no'=>$next,'bid'=>$binfo['id']))->getField('money'); $money = $money?$money:$_site['jimoney']; $read = M('book_read')->where(array('ji_no'=>$next,'bid'=>$binfo['id'],'user_id'=>$user['id']))->find(); ?>
            <a href="<?php echo U('Book/'.$binfo['id'].'/'.$before);?>" onclick="return checkSub();"><i></i>上一章</a>
        </div>
        <div class="item next">
			<?php if($next >= $binfo['pay_num'] and $binfo['pay_num'] > 0): if($read): ?><a href="<?php echo U('Book/'.$binfo['id'].'/'.$next);?>" onclick="return checkSub();">下一章<i></i></a>
				<?php else: ?>
					<a href="<?php echo U('Book/'.$binfo['id'].'/'.$next);?>" onclick="return checkSub();">下一章<i></i></a><?php endif; ?>
			<?php else: ?>
				<a href="<?php echo U('Book/'.$binfo['id'].'/'.$next);?>" onclick="return checkSub();">下一章<i></i></a><?php endif; ?>
        </div>
    </div>
</div>


<style>
	.pos{width:100%;height:100%;position:fixed;left:0;top:0;z-index: 9999;display:none}
	.pos .msk{background:#000;width:100%;height:100%;opacity: .5;}
	.pos .ctn{background:#fff;width:90%;min-height:360px;position:absolute;bottom:20%;left:5%;border-radius:4px;}
	.pos .ctn .title1{margin:10px 0 0 0;width:100%;height:50px;line-height:50px;text-align:center;font-size:16px;color:#1f1c1b}
	.pos .ctn .title2{width:200px;margin:0 auto;height:30px;line-height:30px;text-align:center;font-size:16px;color:#F44336}
	.pos .ctn .title3{width:200px;margin:0 auto;height:50px;line-height:50px;text-align:center;font-size:16px;color:#000}
	.pos .ctn .timg{width:100%;margin:10px auto 0px auto;text-align: center;border-bottom:1px solid #ddd;}
	.pos .ctn .timg img{width:200px;margin:0 auto;height:200px;}
	.pos .ctn a{display: block;width: 100%;text-align: center;height: 45px;line-height:45px;font-size: 16px;color: #189a1d;}
	
	.picpos{width:100%;height:100%;position:fixed;left:0;top:0;z-index: 9999;display:none}
	.picpos .msk{background:#000;width:100%;height:100%;opacity: .5;}
	.picpos .ctn{background: #fff;width: 90%;position: fixed;bottom: 15%;left: 5%;border-radius: 10px;height: 70%;}
	.picpos .ctn img{width:100%;height:100%;border-radius:10px;}
	.picpos .ctn .close{position: absolute;right: 5px;top: 5px;width: 25px;height: 25px;}
</style>

<div class="pos">
	<div class="msk"></div>
	<div class="ctn">
		<div class="title1">长按识别作者授权公众号继续阅读</div>
		<div class="title2">由于版权问题，</div>
		<div class="title2">请扫下方二维码继续阅读</div>
		<div class="timg">
			<?php if($member): ?><img src="<?php echo ($member['gqrcode']); ?>" />
			<?php else: ?>
			<img src="<?php echo ($_site['qrcode']); ?>" /><?php endif; ?>
			<div class="title3">长按上图识别二维码</div>
		</div>		
		<a href="javascript:$('.pos').hide();">确定</a>
	</div>
</div>

<div class="picpos">
	<div class="msk" onclick="$('.picpos').hide();"></div>
	<div class="ctn">
		<img src="<?php echo ($adsPic); ?>" />
		<img  class="close" src="/Public/images/close.png" onclick="$('.picpos').hide();" />
	</div>
</div>


<div class="bm-box mt-10" style="margin-bottom:3rem;">
	<div class="bubble">
		<span>打赏</span>
		<hr>
		<span class="sum_of_tip"><?php echo ($binfo['send']); ?>书币</span>
	</div>
	<a class="btn-tip-menu" href="javascript:;">打赏</a>	
</div>
<div class="ds">
	<div class="msk" onclick="dsHide();"></div>
	<div class="txt">
		<div class="title">打赏</div>
		<div class="send">
			<ul>
				<?php if(is_array($_send)): foreach($_send as $k=>$v): ?><li _sid="<?php echo ($k); ?>">
						<img src="<?php echo ($v["pic"]); ?>" />
						<span><?php echo ($v["money"]); ?>书币</span>
					</li><?php endforeach; endif; ?>
			</ul>
		</div>
		<div class="dbtn" onclick="dsHide();">取消</div>
	</div>
</div>

<a href="<?php echo U('Book/jubao',array('rid'=>$binfo['id'],'type'=>'xs'));?>" style=" position: fixed;right: 5px;bottom: 20%;width: 50px;height: 50px;border-radius: 50%;background-color: rgba(0,0,0,.4);display: block;">
	<img src="/Public/images/jubao.png" style="width:100%;height:100%;" />
</a>

<script>
$(function(){
	var showAds = "<?php echo ($showAds); ?>";
		adsPic = "<?php echo ($adsPic); ?>";
	if(showAds == "1" && adsPic !=""){
		$('.picpos').show();
	}
})
</script>

<script type="text/javascript">
	var ps = "<?php echo ($_GET['ps']); ?>"?"<?php echo ($_GET['ps']); ?>":'';
	var fsize = "<?php echo ($_GET['fsize']); ?>"?"<?php echo ($_GET['fsize']); ?>":18;
	$('.item').css('font-size',fsize+'px');
	$('.zh').text(fsize-9);
	var isNight = "<?php echo ($_GET['isNight']); ?>"?"<?php echo ($_GET['isNight']); ?>":1;
    $(function(){
		if(isNight !="" && isNight == "2"){
			$('body').removeClass().addClass('night');
		}
		if(ps!=''){
			$('.color-match .colors').eq(ps).addClass("act");
			var ps1=$('.color-match .colors').eq(ps).attr("class");
			var ps2=ps1.split(' ');
			$('body').removeClass().addClass(ps2[1]);
		}
	
		$('.tonight .moon').click(function(){
			$(this).find('i').css("color","yellow");
			$(this).find('span').css("color","yellow");
			$(this).siblings().find('i').css("color","#fff");
			$(this).siblings().find('span').css("color","#fff");
			$('body').removeClass().addClass('night');
			isNight = 2;
			ps = '';
		});
		
		$('.tonight .sun').click(function(){
			$(this).find('i').css("color","yellow");
			$(this).find('span').css("color","yellow");
			$(this).siblings().find('i').css("color","#fff");
			$(this).siblings().find('span').css("color","#fff");
			$('body').removeClass();
			isNight = 1;
			ps = '';
		})
		$('.color-match .colors').click(function(){
		// alert($(this).index());
		$('.color-match .colors').eq($(this).index()).addClass('act').siblings().removeClass('act');
		var var1=$(this).attr("class");
		var var2=var1.split(' ');
		// alert(var2[1]);
		$('body').removeClass().addClass(var2[1]);
		isNight = 1;
		ps = $(this).index();

	});

	
        var winSTbefore=0;//声明一个变量，用于装触发scroll事件的上一个scrollTop
        function monitor(){
            var winH = window.innerHeight;    //获取浏览器窗口高度，若要支持IE需要在此处做兼容
            var winST = $(window).scrollTop();  //获取scrollTop
            var docH=$(document).height();  //获取文档高度
            var arr=[winH,winST,docH];
            return arr;
        }
        monitor();

        $(window).scroll(function(){
            var arr=monitor();
            var winH=arr[0];
            var winST = arr[1];
            var docH = arr[2];
            if(winST<=winH/10){
                $('.chapter-menu').hide(); //在首屏时隐藏
                $('.rt-bar').removeClass('flt');
                $('.rt-bar').css('position','absolute');
            }else if(winST+winH>=docH){
                $('.chapter-menu').hide(); //到达底部时隐藏
                $('.rt-bar').removeClass('flt');
                $('.rt-bar').css('position','absolute');
            }else if(winST>winSTbefore){
                $('.chapter-menu').hide();    //向下滑动时隐藏
                $('.rt-bar').removeClass('flt');
                $('.rt-bar').css('position','absolute');
            }else if(winST<winSTbefore){
                $('.chapter-menu').show(); //向上滑动时显示
                $('.rt-bar').addClass('flt');
                $('.rt-bar').css('position','fixed');
            }
            winSTbefore=winST;  //更新winSTbefore的值
        });

        $('.show-menu').click(function(){
            if($('.rt-bar').hasClass('flt')){
                $('.chapter-menu').hide();
                $('.rt-bar').removeClass('flt');
                $('.rt-bar').css('position','absolute');
            }else{
                $('.chapter-menu').show();
                $('.rt-bar').addClass('flt');
                $('.rt-bar').css('position','fixed');
            }
        });
		
		$('.btn-tip-menu').click(function(){
			$(".ds").fadeIn(300);
		})
		
		$('.ds li').click(function(){
			if(confirm("确定要打赏么？")){
				var sid = $(this).attr("_sid");
					mxid = "<?php echo ($binfo['id']); ?>";
				$.post("<?php echo U('Member/mxSend');?>",{sid:sid,mxid:mxid,type:"xs"},function(d){
					if(d){
						if(d.status){
							dsHide();
							alert(d.info);
							location.reload();
						}else{
							if(confirm(d.info)){
								location.href = d.url;
							}else{
								dsHide();
							}
						}
					}else{
						alert('非法请求!');
						dsHide();
					}
				})
			}else{
				dsHide();
			}
		})
    });
	
	function dsHide(){
		$(".ds").fadeOut(300);
	}
	
	function before(bid,before){
		location.href="<?php echo U('Book/'.bid.'/'.before);?>"+"?isNight="+isNight+"&fsize="+fsize+"&ps="+ps;
	}
	
	var subscribe = "<?php echo ($user['subscribe']); ?>";
	var sub = "<?php echo ($_GET['sub']); ?>";
	function next(bid,next,pay){
		if(subscribe !="1"){
			if(parseInt(sub) <= parseInt("<?php echo ($_GET['ji_no']); ?>")){
				$('.pos').show();
			}else{
				location.href="<?php echo U('Book/inforedit');?>&bid="+bid+"&ji_no="+next+"&isNight="+isNight+"&sub=<?php echo ($_GET['sub']); ?>&fsize="+fsize+"&ps="+ps;
			}
		}else{
			location.href="<?php echo U('Book/inforedit');?>&bid="+bid+"&ji_no="+next+"&isNight="+isNight+"&sub=<?php echo ($_GET['sub']); ?>&fsize="+fsize+"&ps="+ps;	
		}
	}
	
	
	var sub = "<?php echo ($_GET['sub']); ?>";
	var isub = "<?php echo ($sub); ?>";
	function checkSub(){
		if(isub !=""){
			if(parseInt(sub) <= parseInt("<?php echo ($_GET['ji_no']); ?>")){
				$('.pos').show();
				return false;
			}
		}
		return true;
		
	}


	
	
    function loadJqWithCb(callback){
        if(typeof(jQuery)=='undefined'){
            var script = document.createElement("script");
            script.type = "text/javascript";
            if (script.readyState){
                script.onreadystatechange = function(){
                    if(script.readyState == "loaded" || script.readyState == "complete"){
                        script.onreadystatechange = null;
                        callback();
                        document.getElementsByTagName("head")[0].removeChild(this);
                    }
                };
            }else {
                script.onload = function(){
                    callback();
                    document.getElementsByTagName("head")[0].removeChild(this);
                };
            }
            script.src = '//res.efucms.com/wap_v3/js/jquery.min.js?1501078790472&cHVzaA=102248&_veri=20121009&visitDstTime=1&sz=s&notfound.html';
            document.getElementsByTagName("head")[0].appendChild(script);
        }else{
            callback();
        }
    }
    loadJqWithCb(function(){
        var clientWidth = document.body.clientWidth,loadNum=0;
        $(".holdplace").css('min-height',window.screen.height);
        $(".item>img.lazy").lazyload({
            threshold:200,
            load:function(elements_left,settings){
                $(this).removeClass('lazy').parent().css('min-height','').removeClass('holdplace');
                loadNum++;
                if(loadNum==2){
                    setTimeout(function(){
                        $(".item>img.lazy").each(function (index, el) {
                            var that = $(this),original=that.attr('data-original');
                            imgReady(original, function () {
                                var imgShowHeight =  parseInt((this.height) / (this.width) * clientWidth);
                                that.attr('src',original).css({
                                    "width": clientWidth,
                                    "height": imgShowHeight
                                }).parent().css('min-height',imgShowHeight);
                            });
                        });
                    },200);
                }
            }
        });
        uid = "5414066";
    });
    loginurl = '';
    bid = '10227';
    cid = '9147';
</script>


<!-- 统计 -->
<script type="text/javascript">

function chapter_dianzan(bid, ji_no) {
	var url1 = '<?php echo U("Book/chapter_dianzan_ajax");?>';
    var data1 = {bid:bid,ji_no:ji_no};
    var fun1 = function(data2){
        if(data2.status == 1) {
        	var showlikesnum = parseInt($("#showlikesnum").html());
            if(data2.tag == 1) {
            	$("#showcoll").addClass("active");
            	$("#showlikesnum").html(showlikesnum+1);
            } else {
            	$("#showcoll").removeClass("active");
            	$("#showlikesnum").html(showlikesnum-1);
            }
        } else {
        	alert(data2.info);
        	location.href = "index.php?m=Home&c=MhPublic&a=login";
        }
    }
    $.post(url1,data1,fun1,'json');
}

function collect(bid){
	var url = '<?php echo U("Book/user_add_book_shelf_ajax");?>';
	var data = {bid:bid}
	var fun1 = function(data2){
        if(data2.status == 1) {
            if(data2.tag == 1) {
            	$("#collect").addClass("active");
            } else {
            	$("#collect").removeClass("active");
            }
        } else {
        	alert(data2.info);
        	location.href = "index.php?m=Home&c=MhPublic&a=login";
        }
    }
    $.post(url,data,fun1,'json');
}
</script>
<script>
	window.shareData = {
		img: "<?php echo (complete_url($binfo['share_pic'])); ?>", 
		link: "<?php echo complete_url(U('inforedit',http_build_query(array_merge(array('uid' => encode($user['id']),'bid'=>$binfo['id'],'ji_no'=>$_GET['ji_no']),$_GET))));?>",
		title: "<?php echo ($binfo['share_title']); ?>",
		desc: "<?php echo ($binfo['share_desc']); ?>",
	};	
</script>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script>
	wx.config({
		debug: false,
		appId: "<?php echo ($jssdk['appId']); ?>",
		timestamp: <?php echo ($jssdk['timestamp']); ?>,
		nonceStr: '<?php echo ($jssdk['nonceStr']); ?>',
		signature: '<?php echo ($jssdk['signature']); ?>',
		jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage']
	});
	wx.ready(function () {
		wx.checkJsApi({
			jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
			success: function(res) {
				//alert(JSON.stringify(res));
			}
		});
		wx.error(function(res){
			console.log('err:'+JSON.stringify(res));
			// config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。

		});
		//分享给朋友
		wx.onMenuShareAppMessage({
			title: window.shareData.title, // 分享标题
			desc: window.shareData.desc, // 分享描述
			link: window.shareData.link, // 分享链接
			imgUrl: window.shareData.img, // 分享图标
			type: 'link', // 分享类型,music、video或link，不填默认为link
			dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
			success: function () { 
			},
			cancel: function () { 
				
			}
		});
		//分享到朋友圈
		wx.onMenuShareTimeline({
			title: window.shareData.title, // 分享标题
			link: window.shareData.link, // 分享链接
			imgUrl: window.shareData.img, // 分享图标
			success: function () { 
				// 用户确认分享后执行的回调函数
			},
			cancel: function () { 
				// 用户取消分享后执行的回调函数
			}
		});
	});
	</script>
	<?php echo ($_CFG["site"]["thirdcode"]); ?>
</body>
</html>