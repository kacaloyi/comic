<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0038)https://m.efucms.com/pay/coin.html -->
<html data-dpr="1" style="font-size: 43.1px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo ($_CFG['site']['name']); ?> - 在线充值</title>
    <!-- 共用引入资源.开始 -->

    <script src="/Public/home/mhjs/stats.js" name="MTAH5" sid="500462993"></script>
    <meta name="viewport" content="designWidth=750,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- 防止加载lib.flexible加载的时候文字由大变小的闪烁 -->
    <style>html,body{font-size:12px;}
    .block {
        overflow: hidden;
        margin: 5px 0;
        width: 100%;
        display: block;
        /* background: #fff; */
    }
    .signbox {
        float: left;
        display: block;
        overflow: hidden;
        margin-top: 0;
        padding: 0;
        width: 100%;
        border-top: 1px solid #ddd;
    }
    .signbox img {
        float: left;
        margin: 18px 0px 18px 10px;;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    .signbox p {
        float: left;
        margin: 20px 13px 10px 20px;
        text-align: left;
        font-size: 1.1em;
        line-height: 0.6rem;
    }
    .w15 {
        display: block;
        width: 15%;
    }
    .w73 {
        display: block;
        width: 73%;
    }
    
    .fl {
        float: left;
    }
    
    .clearfix {
        zoom: 1;
    }
    

    .tip{
        font-size:10px;
        margin-left: 1px;
        padding: 1px 3px;
        border-radius: 3px;
        background: #f33;
        color: #fff;
    }
    
    .signtips {
        float: left;
        display: block;
        overflow: hidden;
        margin: 10px 3%;
        width: 94%;
        height: 2pc;
        border: 1px dashed #ee2112;
        border-radius: 9pt;
        background-color: #fff;
        color: red;
        text-align: center;
        font-weight: 700;
        font-size: .7em;
        line-height: 2pc;
    }
    
    .signtips.f14 {
        font-size: .7em;
    }
    .paybtnBOX p {
        margin: 10px auto 0px;
        text-align: center;
        font-size: .8em;
        line-height: 1.2rem;
        color: #555;
    }
    
    .checkBox {
        display: block;
        width: 98%;
        background: #EFEFF4;
        margin: 0px 1%;
        border-top: 2px #fff dashed;
     }
    
    .checkBox li {
        float: left;
        overflow: hidden;
    }
    </style>

    <!-- lib.flexible 移动端相对适应比例 必须在浏览器head类 -->
    <script type="text/javascript">
        !function (a, b) { function c() { var b = f.getBoundingClientRect().width; b / i > 540 && (b = 540 * i); var c = b / 10; f.style.fontSize = c + "px", k.rem = a.rem = c } var d, e = a.document, f = e.documentElement, g = e.querySelector('meta[name="viewport"]'), h = e.querySelector('meta[name="flexible"]'), i = 0, j = 0, k = b.flexible || (b.flexible = {}); if (g) {  var l = g.getAttribute("content").match(/initial\-scale=([\d\.]+)/); l && (j = parseFloat(l[1]), i = parseInt(1 / j)) } else if (h) { var m = h.getAttribute("content"); if (m) { var n = m.match(/initial\-dpr=([\d\.]+)/), o = m.match(/maximum\-dpr=([\d\.]+)/); n && (i = parseFloat(n[1]), j = parseFloat((1 / i).toFixed(2))), o && (i = parseFloat(o[1]), j = parseFloat((1 / i).toFixed(2))) } } if (!i && !j) { var p = (a.navigator.appVersion.match(/android/gi), a.navigator.appVersion.match(/iphone/gi)), q = a.devicePixelRatio; i = p ? q >= 3 && (!i || i >= 3) ? 3 : q >= 2 && (!i || i >= 2) ? 2 : 1 : 1, j = 1 / i } if (f.setAttribute("data-dpr", i), !g) if (g = e.createElement("meta"), g.setAttribute("name", "viewport"), g.setAttribute("content", "initial-scale=" + 1 + ", maximum-scale=" + 1 + ", minimum-scale=" + 1 + ", user-scalable=no"), f.firstElementChild) f.firstElementChild.appendChild(g); else { var r = e.createElement("div"); r.appendChild(g), e.write(r.innerHTML) } a.addEventListener("resize", function () { clearTimeout(d), d = setTimeout(c, 300) }, !1), a.addEventListener("pageshow", function (a) { a.persisted && (clearTimeout(d), d = setTimeout(c, 300)) }, !1), "complete" === e.readyState ? e.body.style.fontSize = 12 * i + "px" : e.addEventListener("DOMContentLoaded", function () { e.body.style.fontSize = 12 * i + "px" }, !1), c(), k.dpr = a.dpr = i, k.refreshRem = c, k.rem2px = function (a) { var b = parseFloat(a) * this.rem; return "string" == typeof a && a.match(/rem$/) && (b += "px"), b }, k.px2rem = function (a) { var b = parseFloat(a) / this.rem; return "string" == typeof a && a.match(/px$/) && (b += "rem"), b } }(window, window.lib || (window.lib = {}));
    </script>
    <link rel="stylesheet" type="text/css" href="/Public/home/mhcss/style.min.css">
    <script type="text/javascript" src="/Public/home/mhjs/fundebug.0.1.7.min.js" apikey="ba3a0e0d938e92b44f279067dffb8d071ee87fc35eb75918b7a900e8581a955d"></script>
    <script type="text/javascript" src="/Public/home/mhjs/jquery.js"></script>
	<script type="text/javascript" src="/Public/home/js/newWindow.js"></script>
    <!-- 共用引入资源.结束 -->
</head>
<body style="font-size: 12px;">
<div class="rt-bar">
    <div class="row">
        <div class="col icon">
            <a href="javascript:history.go(-1);">
                <svg width="15" height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40">
                <path d="M29.56 39.47a2 2 0 0 1-1.38-.56L8.45 20 28.17 1.09A2 2 0 1 1 30.94 4L14.23 20l16.71 16a2 2 0 0 1-1.38 3.44z" fill="#ff730a"></path></svg>
            </a>
        </div>
        <div class="col title" style="margin-right: 1.333rem;">补单请截图本页发给客服</div>
		<a href="/Mh/index.html"class="header-home">
			<div class="icon-home"></div>
		</a>
    </div>
</div>

<div class="clearfix"></div>  
<section class="block signbox">
  <a href="/Mh/my.html">
    <div class="fl w15" style="padding-left:20px;"><img src="<?php echo ($user["headimg"]); ?>"></div>
        <div class="fl w73">
            <p>
                <span>昵称：<?php echo ($user["nickname"]); ?>&nbsp;&nbsp;级别：
                <?php if($user['vip'] == 0): ?><em class="red">普通会员</em> 
                <?php else: ?>
                  <em class="yellow"> VIP会员  </em><?php endif; ?> 
                </span> 
                <br><span>官网：<i><?php echo ($_SERVER['HTTP_HOST']); ?> </i></span>
               
            </p>
        </div>
  </a> 
</section>
<div class="clearfix"></div> 
<div class="signtips f14 block">
充值账号：<?php echo ($user["username"]); ?>&nbsp;&nbsp;书币：<?php echo ($user["money"]); ?>&nbsp;枚</div>

<section class = "checkBox">
<div class="paybtnBOX clf  text-align:center">
		<p><b style="font-size:1.0em; color:#0a9ee6;">购买VIP会员 可免费阅读全站漫画！</b></p>
</div>
</section>
<!----------------------------------------------------------------------->
<div class="recharge-list">
	<?php if(is_array($_charge)): foreach($_charge as $key=>$v): ?><div class="item">
           <?php if($v['isVIP'] != 0): ?><input type="radio" name="recharge" value="<?php echo ($v['money']); ?>">
        		<a href="javascript:void(0);" class="container" data-fee="<?php echo ($v['send']); ?>" _vip="<?php echo ($v['isVIP']); ?>">
        			<div class="body">
        			    <?php if($v['tip'] != '' ): ?><div class="num"><?php echo ($v['title']); ?><san class="tip"><?php echo ($v['tip']); ?></san></div>
                        <?php else: ?>
                         <div class="num"><?php echo ($v['title']); ?></san></div><?php endif; ?>
        			    	<div class="bio"><?php echo ($v['money']); ?>元/<san style="color: #F33;"><?php echo ($v['title']); ?></san></div>
                            <div class="text"><?php echo ($v['ads']); ?></div>
                     
        			   </div>
        			<?php if($v['ishot']): ?><label class="label label-first"></label>
    				<?php else: ?>
    			    	<label class=""></label><?php endif; ?>
        		</a>
        
    	    <?php else: ?>
		  
    			<input type="radio" name="recharge" value="<?php echo ($v['money']); ?>">
    			<a href="javascript:void(0);" class="container" data-fee="<?php echo ($v['money']); ?>" _vip="0">
    				<div class="body">
    					<div class="num"><?php echo ($v['money']); ?>元</div>
    					<div class="bio"><?php echo ($v['money']*$_site['rate']); ?>+<?php echo ($v['send']); ?>书币</div>
    					<div class="bio"><?php echo ($v['ads']); ?></div>
    				</div>

    				<?php if($v['ishot']): ?><label class="label label-first"></label>
    				<?php else: ?>
    			    	<label class=""></label><?php endif; ?>
    			</a><?php endif; ?>
		</div><?php endforeach; endif; ?>
	
</div>

<style>
.action{
	    margin: .4rem .2133rem 0 .2133rem;
}
.btn{
    display: block;
    height: 1.333rem;
    line-height: 1.333rem;
    text-align: center;
    border-radius: 1.333rem;
    background-color: #ff730a;
    color: #fff;
    font-size: .4267rem;
}
.red{
    color: #f66;
}
</style>
<div class="action">
	<a href="javascript:void(0);" class="btn wap-btn">立即充值</a>
</div>
<p style="text-align:center">境外的漫友请联系<a href="/Mh/help.html" class="red">【客服】</a>升级</p>
<div class="recharge-notice">
    <div class="title">充值说明</div>
    <p>1、人民币/书币的汇率为：1元=<?php echo ($_site['rate']); ?>书币</p>
    <p>2、书币属于虚拟商品，一经购买概不退换。</p>
    <p>3、若充值遇到任何问题，可以联系我们的<a href="/Mh/help.html" class="red">【客服】</a>。</p>
</div>

<script type="text/javascript">

    function tips(msg,callback){
        $("body").append("<div id='pay-coin-tips' style='position:fixed;left:0;top:50%;z-index:100;text-align:center;width:100%'><span style='background: rgba(0, 0, 0, 0.65);color: #fff;padding: 10px 15px;border-radius: 3px; font-size: 14px;'>" + msg + "</span></div>");
        setTimeout(function(){$("#pay-coin-tips").remove();if(callback) callback();},2000);
    }

	var vip = 0;
	
	$(".action .wap-btn").click(function(){
		var that = $('.recharge-list > .item.active .container')
		var fee = that.attr('data-fee');
		vip = that.attr('_vip');

		if(fee == undefined || fee == ""){
			tips('请选择充值金额');
			return false;
		}

		var model = "<?php echo ($model); ?>";
		tips('数据正在请求中，请稍等...');
		$.post("<?php echo U('Mh/pay_ajax');?>",{money:fee,vip:vip},function(d){
			$('#pay-coin-tips').remove();
			console.log(d);
			if(d){
				if(d.status){
					if(model == 1){
						//调起微信支付js
						var jsapi =  d.info;
						var jsApiParameters = eval('(' +jsapi + ')');
						WeixinJSBridge.invoke(
							'getBrandWCPayRequest',
							jsApiParameters,
							function(res){
								WeixinJSBridge.log(res.err_msg);
								if(res.err_msg == "get_brand_wcpay_request:ok"){
									tips('充值成功');
									setTimeout(function(){
										location.href="<?php echo U('Mh/my');?>";
									},2000)
								}else if(res.err_msg == "get_brand_wcpay_request:cancel"){
										//tips('您取消了支付');
								
									  get_order_status();
								}else{
									tips('支付失败，请重试！');
								}
							}
						);
					}else if(model == 2){
						location.href=d.info;
					}else if(model == 3){
						location.href = "<?php echo U('Mh/paysApi');?>&qrcode="+d.info.qrcode+"&sn="+d.info.sn;
					}else if(model == 4){
					   	location.href = "<?php echo U('Mh/payChinaxingChange');?>&sn="+d.info.sn;
					}
				}else{
					tips(d.info);
				}
			}else{
				tips('请求失败!');
			}
		});
		
	});
   function get_order_status(sn){
        $.post("<?php echo U('paySend');?>",{sn:sn},function(d){
            if(d){
                if(d.status){
                    // alert('支付成功，跳转到个人中心！');
                    tips('您取消了支付');
                    //location.href="<?php echo U('Mh/pay');?>";
                }
            }
        });
    }
	$('.recharge-list > .item .container').on('click', function(e) {
		if ($(this).parent().hasClass('active')) return;
		$('.recharge-list > .item').removeClass('active');
		$(this).parent().addClass('active');
		$(this).siblings('input').prop('checked', true);
		vip = $(this).attr("_vip");
	});
</script>
<!-- 统计 -->
<script type="text/javascript" src="/Public/home/mhjs/gcoupon.min.js"></script>
<script type="text/javascript">
    function addLoadEvent(func){
        if (typeof window.addEventListener != "undefined") {
            window.addEventListener("load",func,false);
        } else {
            window.attachEvent("onload",func) ;
        }
    }
    function tj_getcookie(name){
        var nameValue = "";
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg)) {
            nameValue = decodeURI(arr[2]);
        }
        return nameValue;
    }
    function getQueryString(name){
        var reg = new RegExp("(^|&)"+name+"=([^&]*)(&|$)","i");
        var r = window.location.search.substr(1).match(reg);
        if (r!=null) return unescape(r[2]); return null;
    }
    /*addLoadEvent(function(){
        var error_img = new Image(),channel=tj_getcookie('qrmh_channel'),channel_type=tj_getcookie('qrmh_channel_type');
        error_img.onerror=null;
        error_img.src="//www.efucms.com/stats/?c="+channel+"&ct="+channel_type+"&rnd="+(+new Date);
        error_img=null;
        //某些地方页面缓存-检测
        var p_img =new Image(), p_userid = parseInt("5414066"),c_auth=tj_getcookie('qrmh_auth'),p_reload = getQueryString('p_reload');
        if(p_userid>0&&c_auth==''){
            if(p_reload==null){
                var url = window.location.href;
                //刷新一次页面
                window.location.href=url.indexOf("?")>0?(url+'&p_reload=1&reload_time='+(+new Date)):(url+'?p_reload=1&reload_time='+(+new Date));
            }else{
                //还是出现这个问题的话，就记录下来
                p_img.onerror=null;
                p_img.src="//www.efucms.com/page_stats/?p_userid="+p_userid+"&rnd="+(+new Date);
            }
        }
        p_img=p_userid=c_auth=p_reload=null;
    });*/
    //update byefucms 20170906 某些手机系统下，旋转屏幕出现页面混乱问题，通过延时500ms滚动页面1个单位得以恢复正常
    var evt = "onorientationchange" in window ? "orientationchange" : "resize";
    window.addEventListener(evt, function() {
        setTimeout(function(){
            window.scrollTo(0, window.pageYOffset+1);
        },500);
    }, false);
</script>
<!-- 统计 -->
<!-- 第三方qq统计 -->
<!-- <script type="text/javascript">
    var _mtac = {};
    (function() {
        setTimeout(function(){
            var mta = document.createElement("script");
            mta.src = (("https:" == document.location.protocol) ? "https://" : "http://")+"pingjs.qq.com/h5/stats.js?v2.0.4";
            mta.setAttribute("name", "MTAH5");
            mta.setAttribute("sid", "500462993");
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(mta, s);
        },888);
    })();
</script> -->
<!-- 第三方qq统计 -->



<!--51LA统计-->
<!--<script type="text/javascript" src="https://js.users.51.la/19935271.js"></script>-->
<!--51LA统计-->
<!--百度统计-->
<!--<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?3d1dfafa9e0d026d0806c2e8e8b36311";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
-->
<!--百度统计-->

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
var links = window.location.href+'&parent='+"<?php echo ($user["id"]); ?>";
var img = "<?php echo ($share["pic"]); ?>";
var title = "<?php echo ($share["title"]); ?>";
var desc = "<?php echo ($share["desc"]); ?>";
wx.config({
	debug: false,
	appId: "<?php echo ($jssdk['appId']); ?>",
	timestamp:"<?php echo ($jssdk['timestamp']); ?>",
	nonceStr: "<?php echo ($jssdk['nonceStr']); ?>",
	signature: "<?php echo ($jssdk['signature']); ?>",
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
	});
	//分享给朋友
	wx.onMenuShareAppMessage({
		title:title, // 分享标题
		desc:desc, // 分享描述
		link:links, // 分享链接
		imgUrl:img, // 分享图标
		type: 'link', // 分享类型,music、video或link，不填默认为link
		dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		success: function () { 
		},
		cancel: function () { 
			
		}
	});
	//分享到朋友圈
	wx.onMenuShareTimeline({
		title:title, // 分享标题
		link: links, // 分享链接
		imgUrl:img, // 分享图标
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

</body></html>