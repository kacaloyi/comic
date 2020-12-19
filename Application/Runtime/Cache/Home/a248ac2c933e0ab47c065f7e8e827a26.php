<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <title><?php echo ($_CFG['site']['name']); ?> - 漫画搜索</title>
    <!-- 共用引入资源.开始 -->
  <meta charset="UTF-8">
  <script type="text/javascript">
    if (self != top) {
        top.location.href=self.location.href;
    }
    /* if (window.location.protocol != 'https:'){
      	window.location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
    } */
    /* var req_time = '19',page_start_time=+(new Date),page_end_time=page_start_time; */
  </script>
  <meta name="viewport" content="designWidth=750,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <!-- 防止加载lib.flexible加载的时候文字由大变小的闪烁 -->
  <style>html,body{font-size:12px;}</style>
  <!-- lib.flexible 移动端相对适应比例 必须在浏览器head类 -->
  <script type="text/javascript">
    !function (a, b) { function c() { var b = f.getBoundingClientRect().width; b / i > 540 && (b = 540 * i); var c = b / 10; f.style.fontSize = c + "px", k.rem = a.rem = c } var d, e = a.document, f = e.documentElement, g = e.querySelector('meta[name="viewport"]'), h = e.querySelector('meta[name="flexible"]'), i = 0, j = 0, k = b.flexible || (b.flexible = {}); if (g) {  var l = g.getAttribute("content").match(/initial\-scale=([\d\.]+)/); l && (j = parseFloat(l[1]), i = parseInt(1 / j)) } else if (h) { var m = h.getAttribute("content"); if (m) { var n = m.match(/initial\-dpr=([\d\.]+)/), o = m.match(/maximum\-dpr=([\d\.]+)/); n && (i = parseFloat(n[1]), j = parseFloat((1 / i).toFixed(2))), o && (i = parseFloat(o[1]), j = parseFloat((1 / i).toFixed(2))) } } if (!i && !j) { var p = (a.navigator.appVersion.match(/android/gi), a.navigator.appVersion.match(/iphone/gi)), q = a.devicePixelRatio; i = p ? q >= 3 && (!i || i >= 3) ? 3 : q >= 2 && (!i || i >= 2) ? 2 : 1 : 1, j = 1 / i } if (f.setAttribute("data-dpr", i), !g) if (g = e.createElement("meta"), g.setAttribute("name", "viewport"), g.setAttribute("content", "initial-scale=" + 1 + ", maximum-scale=" + 1 + ", minimum-scale=" + 1 + ", user-scalable=no"), f.firstElementChild) f.firstElementChild.appendChild(g); else { var r = e.createElement("div"); r.appendChild(g), e.write(r.innerHTML) } a.addEventListener("resize", function () { clearTimeout(d), d = setTimeout(c, 300) }, !1), a.addEventListener("pageshow", function (a) { a.persisted && (clearTimeout(d), d = setTimeout(c, 300)) }, !1), "complete" === e.readyState ? e.body.style.fontSize = 12 * i + "px" : e.addEventListener("DOMContentLoaded", function () { e.body.style.fontSize = 12 * i + "px" }, !1), c(), k.dpr = a.dpr = i, k.refreshRem = c, k.rem2px = function (a) { var b = parseFloat(a) * this.rem; return "string" == typeof a && a.match(/rem$/) && (b += "px"), b }, k.px2rem = function (a) { var b = parseFloat(a) / this.rem; return "string" == typeof a && a.match(/px$/) && (b += "rem"), b } }(window, window.lib || (window.lib = {}));
  </script>
  <link rel="stylesheet" type="text/css" href="/Public/home/mhcss/style.min.css" />
  <script type="text/javascript" src="/Public/home/mhjs/fundebug.0.1.7.min.js" apikey="ba3a0e0d938e92b44f279067dffb8d071ee87fc35eb75918b7a900e8581a955d"></script>
  <script type="text/javascript" src="/Public/home/mhjs/jquery.js"></script>
  <!-- 共用引入资源.结束 -->
  <script type="text/javascript" src="/Public/home/mhjs/public.js"></script>
  <!-- <script type="text/javascript" src="//res.efucms.com/wap_v2/js/??laytpl.js,public.js,notfound.html"></script> -->
</head>
<body>

<div class="search-bar search-multiple">
  <div class="inner">
    <div class="field">
      <div class="icon">
        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M31.21 27.4l-5.15-5.15a13.06 13.06 0 1 0-2.52 3.13l4.84 4.84zM3.8 15.78a11 11 0 1 1 11 11 11 11 0 0 1-11-11z" fill="#999"/></svg>
      </div>
      <input type="text" placeholder="输入漫画名或作者" id="search_keyword" maxlength="18" value="<?php echo ($key); ?>" onkeyup="keyup_search(this);"/>
    </div>
    <button onclick="location.href='/';" id="show_cleare_btn">取消</button>
    <button onclick="key_search_href();" id="show_sear_btn" style="display: none;">搜索</button>
  </div>
  <div class="res-text">搜索“<span class="typo-orange"><?php echo ($key); ?></span>”结果，共<span class="typo-orange"><?php echo (count($list)); ?></span>条</div>
</div>
<!-- 显示书名作者匹配-->
<div class="books-res" id="search-result-container" >
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
    <a href="<?php echo U('Mh/'.$vo['id']);?>" class="link">
      <div class="cover">
        <img width="63" height="84" src="<?php echo ($vo["cover_pic"]); ?>" />
      </div>
      <div class="body">
        <div class="title"><?php echo ($vo["title"]); ?></div>
        <div class="author">作者：<?php echo ($vo["author"]); ?></div>
        <div class="text"><?php echo (mb_substr($vo["summary"],0,20)); ?></div>
        <div class="bottom">
          <span class="col"><i class="icon-gray-hot"></i><?php echo ($vo["reader"]); ?></span>
          <span class="col"><i class="icon-hand"></i><?php echo ($vo["likes"]); ?></span>
        </div>
      </div>
    </a>
    <div class="action">
      <a href="<?php echo U('Mh/'.$vo['id']);?>" class="btn">阅读</a>
    </div>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>

<!--小于五条显示你可能喜欢-->
<!-- <div class="books-res mt-10" style="display: none;">
  <div class="head">
    <div class="title">你可能会喜欢</div>
  </div>
</div> -->

<!--没有搜索到记录时显示-->
<!--<div class="sd-box"  style="display: none" >
  <img src="//res.efucms.com/wap_v3/images/utils/res-default.png" width="147" height="87" />
</div>
-->

<!--没有搜索到结果显示为你推荐-->
<!-- <div class="bm-box mt-10"  style="display: none" >
  <div class="head">
    <div class="title">为你推荐</div>
  </div>
  <div class="books-row">
      </div>
</div> -->
<!--<div class="backtop" id="icon-top" style="display:none;">
  <a href="javascript:void(0);" class="top">顶部</a>
</div>
<script id="itemTpl" type="text/html">
  {{# for(var i = 0, len = d.length; i < len; i++){ }}
  <div class="item">
    <a href="/book/{{ d[i].id }}/" class="link">
      <div class="cover">
        <img width="63" height="84" src="{{ d[i].book_unruly }}" />
      </div>
      <div class="body">
        <div class="title">{{ d[i].book_name }}</div>
        <div class="author">作者：{{ d[i].book_author }}</div>
        <div class="text">{{ d[i].short_title }}</div>
        <div class="bottom">
          <span class="col"><i class="icon-gray-hot"></i> {{=formatTjNumber(d[i].read_cnt) }}</span>
          <span class="col"><i class="icon-hand"></i>{{=formatTjNumber(d[i].like_cnt) }}</span>
        </div>
      </div>
    </a>
    <div class="action">
      <a href="/book/{{ d[i].id }}/" class="btn">阅读</a>
    </div>
  </div>
  {{# } }}
</script>-->

<script>
    $(function () {
        //回车自动提交
        $('#search_keyword').keyup(function(event){
            var key_v = $('#search_keyword').val();
            if(key_v == ''){
                $('#show_cleare_btn').show();
                $('#show_sear_btn').hide();
                return false;
            }
            if(event.keyCode===13){
                key_search_href();
            }
        });
    });
    </script>
<!-- 统计 -->
  <script type="text/javascript" src="/Public/home/mhjs/gcoupon.min.js"></script>
<!--   <script type="text/javascript">
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
    addLoadEvent(function(){
        page_end_time = +(new Date);
        var error_img = new Image(),channel=tj_getcookie('qrmh_channel'),channel_type=tj_getcookie('qrmh_channel_type');
        error_img.onerror=null;
        error_img.src="//www.efucms.com/stats/?c="+channel+"&ct="+channel_type+"&rnd="+(+new Date);
        error_img=null;
        //某些地方页面缓存-检测
        var p_img =new Image(), p_userid = parseInt("5646242"),c_auth=tj_getcookie('qrmh_auth'),p_reload = getQueryString('p_reload');
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
    }); 
    //update byefucms 20170906 某些手机系统下，旋转屏幕出现页面混乱问题，通过延时500ms滚动页面1个单位得以恢复正常
    var evt = "onorientationchange" in window ? "orientationchange" : "resize";
    window.addEventListener(evt, function() {
        setTimeout(function(){
            window.scrollTo(0, window.pageYOffset+1);
        },500);
    }, false);
  </script>-->
 
  <!-- 统计 -->
  <!-- 第三方qq统计 -->  
<!--   <script type="text/javascript">
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
<script type="text/javascript" src="https://js.users.51.la/19935271.js"></script>
<!--51LA统计-->
<!--百度统计-->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?3d1dfafa9e0d026d0806c2e8e8b36311";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
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

</body>
</html>