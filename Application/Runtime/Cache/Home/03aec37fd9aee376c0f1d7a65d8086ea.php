<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html data-dpr="1" style="font-size: 41.6px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo ($_CFG['site']['name']); ?> - 漫画分类大全</title>
    <meta name="keywords" content="漫画大全,漫画图片,漫画投稿,在线漫画,斗破苍穹漫画,斗罗大陆漫画,偷星九月天,穿越西元3000后,凤逆天下,风起苍岚,妃夕妍雪,BL漫画,耽美漫画,知音漫客,飒漫画,漫画下载" />
    <meta name="description" content="<?php echo ($_CFG['site']['name']); ?>最好看的免费漫画在线看，斗破苍穹漫画、斗罗大陆漫画，更有APP和漫画下载等精彩内容等你发现，看漫画，就来<?php echo ($_CFG['site']['name']); ?>！" />
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
    <script type="text/javascript" src="/Public/home/mhjs/fundebug.0.1.7.min.js" apikey="ba3a0e0d938e92b44f279067dffb8d071ee87fc35eb75918b7a900e8581a955d"></script>
    <script type="text/javascript" src="/Public/home/mhjs/jquery.js"></script>
    <!-- 共用引入资源.结束 -->
    <script type="text/javascript" src="/Public/home/mhjs/saved_resource"></script>
</head>
<body style="font-size: 12px;">
<div class="navbar flt" style="background:#f97915;">
    <nav class="tab-box">
        <div class="item">
            <a href="<?php echo U('Mh/index');?>">首页</a>
        </div>
        <div class="item">
            <a href="<?php echo U('Mh/book_cate');?>" class="active">分类</a>
        </div>
    </nav>
    <div class="action">
        <a href="<?php echo U('Mh/load_search');?>" class="btn">
            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path d="M35.94 35.94l7.71 7.71" fill="none" stroke="#fff" stroke-width="3"></path>
            <circle cx="23.3" cy="23.3" r="18.5" fill="none" stroke="#fff" stroke-width="3"></circle>
            <path d="M11.72 23.15A12 12 0 0 1 24.5 12" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="3"></path></svg>
        </a>
    </div>
</div>

<nav class="nav-row-cate mt-navbar">
    <div class="shrink collect-box condition-box" style="display: none;">
        <div class="row container close-type">
            <div class="item"><a href="javascript:;" type="tid" val="0" class="active" id="close-all">全部</a></div>
            <div class="item"><a href="javascript:;" type="tid" val="1" id="close-8">总裁</a></div>
            <div class="item"><a href="javascript:;" type="tid" val="2" id="close-12">穿越</a></div>
            <div class="item"><a href="javascript:;" type="tid" val="3" id="close-1">校园</a></div>
            <div class="item"><a href="javascript:;" type="tid" val="4" id="close-11">恐怖</a></div>
        </div>
    </div>
    <div class="shrink open-box condition-box" style="display: block;">
        <div class="row has-label">
            <label class="label"><span>分类</span></label>
            <div class="container open-type">
                <div class="item"><a href="<?php echo ($selfurl); ?>&cateid=0" type="tid" val="0" <?php if($cateid == 0): ?>class="active"<?php endif; ?> id="open-all">全部</a></div>
                <div class="item"><a href="<?php echo ($selfurl); ?>&cateid=9" type="tid" val="9" <?php if($cateid == 9): ?>class="active"<?php endif; ?> id="open-9">霸总</a></div>
                <div class="item"><a href="<?php echo ($selfurl); ?>&cateid=2" type="tid" val="2" <?php if($cateid == 2): ?>class="active"<?php endif; ?> id="open-2">仙侠</a></div>
                <div class="item"><a href="<?php echo ($selfurl); ?>&cateid=10" type="tid" val="10" <?php if($cateid == 10): ?>class="active"<?php endif; ?> id="open-10">恋爱</a></div>
                <div class="item"><a href="<?php echo ($selfurl); ?>&cateid=11" type="tid" val="11" <?php if($cateid == 11): ?>class="active"<?php endif; ?> id="open-11">校园</a></div>
                <div class="item"><a href="<?php echo ($selfurl); ?>&cateid=12" type="tid" val="12" <?php if($cateid == 12): ?>class="active"<?php endif; ?> id="open-12">冒险</a></div>
                <div class="item"><a href="<?php echo ($selfurl); ?>&cateid=13" type="tid" val="13" <?php if($cateid == 13): ?>class="active"<?php endif; ?> id="open-13">搞笑</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=14" type="tid" val="14" <?php if($cateid == 14): ?>class="active"<?php endif; ?> id="open-14">生活</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=15" type="tid" val="15" <?php if($cateid == 15): ?>class="active"<?php endif; ?> id="open-15">热血</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=16" type="tid" val="16" <?php if($cateid == 16): ?>class="active"<?php endif; ?> id="open-16">架空</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=17" type="tid" val="17" <?php if($cateid == 17): ?>class="active"<?php endif; ?> id="open-17">后宫</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=18" type="tid" val="18" <?php if($cateid == 18): ?>class="active"<?php endif; ?> id="open-18">耽美</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=1" type="tid" val="1" <?php if($cateid == 1): ?>class="active"<?php endif; ?> id="open-1">玄幻</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=19" type="tid" val="19" <?php if($cateid == 19): ?>class="active"<?php endif; ?> id="open-19">悬疑</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=20" type="tid" val="20" <?php if($cateid == 20): ?>class="active"<?php endif; ?> id="open-20">恐怖</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=7" type="tid" val="7" <?php if($cateid == 7): ?>class="active"<?php endif; ?> id="open-7">灵异</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=21" type="tid" val="21" <?php if($cateid == 21): ?>class="active"<?php endif; ?> id="open-21">动作</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=6" type="tid" val="6" <?php if($cateid == 6): ?>class="active"<?php endif; ?> id="open-6">科幻</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=22" type="tid" val="22" <?php if($cateid == 22): ?>class="active"<?php endif; ?> id="open-22">战争</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=23" type="tid" val="23" <?php if($cateid == 23): ?>class="active"<?php endif; ?> id="open-23">古风</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=24" type="tid" val="24" <?php if($cateid == 24): ?>class="active"<?php endif; ?> id="open-24">穿越</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=25" type="tid" val="25" <?php if($cateid == 25): ?>class="active"<?php endif; ?> id="open-25">竞技</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=26" type="tid" val="26" <?php if($cateid == 26): ?>class="active"<?php endif; ?> id="open-26">百合</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=27" type="tid" val="27" <?php if($cateid == 27): ?>class="active"<?php endif; ?> id="open-27">励志</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=28" type="tid" val="28" <?php if($cateid == 28): ?>class="active"<?php endif; ?> id="open-28">同人</a></div>
				<div class="item"><a href="<?php echo ($selfurl); ?>&cateid=29" type="tid" val="29" <?php if($cateid == 29): ?>class="active"<?php endif; ?> id="open-29">真人</a></div>
            </div>
        </div>
        <div class="row has-label">
            <label class="label"><span>状态</span></label>
            <div class="container">
                <div class="item"><a href="<?php echo ($selfurl); ?>&status=0" type="end" val="0" <?php if($status == 0): ?>class="active"<?php endif; ?> >全部</a></div>
                <div class="item"><a href="<?php echo ($selfurl); ?>&status=1" type="end" val="1" <?php if($status == 1): ?>class="active"<?php endif; ?> >连载</a></div>
                <div class="item"><a href="<?php echo ($selfurl); ?>&status=2" type="end" val="2" <?php if($status == 2): ?>class="active"<?php endif; ?> >完结</a></div>
            </div>
        </div>
        <div class="row has-label">
            <label class="label"><span>属性</span></label>
            <div class="container">
                <div class="item"><a href="<?php echo ($selfurl); ?>&free_type=0" type="vip" val="0" <?php if($free_type == 0): ?>class="active"<?php endif; ?> >全部</a></div>
                <div class="item"><a href="<?php echo ($selfurl); ?>&free_type=1" type="vip" val="1" <?php if($free_type == 1): ?>class="active"<?php endif; ?> >免费</a></div>
                <div class="item"><a href="<?php echo ($selfurl); ?>&free_type=2" type="vip" val="2" <?php if($free_type == 2): ?>class="active"<?php endif; ?> >付费</a></div>
            </div>
        </div>
    </div>
    <div class="action">
        <a href="javascript:void(0);" class="opened"><span class="text">收起</span><i class="icon-arrow"></i></a>
    </div>
</nav>


<div class="books-list mt-10 mb-tabar" id="html_box">
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item"> 
            <a href="<?php echo U('Mh/'.$vo['id']);?>"> 
                <div class="cover"> <img width="160" height="90" src="<?php echo ($vo["cover_pic"]); ?>" > </div> 
                <div class="body"> 
                    <div class="title"><?php echo ($vo["title"]); ?></div> 
                    <div class="text"><?php echo ($vo["summary"]); ?></div> 
                    <div class="bottom"> 
                        <span class="col"><i class="icon-gray-hot"></i><?php echo ($vo["reader"]); ?></span> 
                        <span class="col"><i class="icon-hand"></i><?php echo ($vo["likes"]); ?></span> 
                    </div>
                </div>
            </a>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>


<div class="tabar flb">
    <nav class="nav hls1">
        <div class="item">
            <a href="<?php echo U('Mh/book_recent_read');?>">
                <i class="icon-book"></i><div class="title">书架</div>
            </a>
        </div>
       <div class="item">
            <a href="/index.php?m=&c=Book&a=index">
                <i class="icon-home"></i><div class="title">小说</div>
            </a>
        </div>
        <div class="item">
            <a href="<?php echo U('Mh/index');?>" class="active">
                <i class="icon-home"></i><div class="title">漫画</div>
            </a>
        </div>
        
        <div class="item">
            <a href="<?php echo U('Mh/my');?>">
                <i class="icon-user"></i><div class="title">我的</div>
            </a>
        </div>
    </nav>
</div>
<div class="backtop" id="icon-top" style="display:none;">
    <a href="javascript:void(0);" class="top">顶部</a>
</div>
<script id="itemTpl" type="text/html">
    {{# for(var i = 0, len = d.length; i < len; i++){ }}
    <div class="item">
        <a href="/book/{{ d[i].id }}/">
            <div class="cover">
                <img width="160" height="90" src="{{ d[i].book_horizontal }}" />
            </div>
            <div class="body">
                <div class="title">{{ d[i].book_name }}</div>
                <div class="text">{{ d[i].short_title }}</div>
                <div class="bottom">
                    <span class="col"><i class="icon-gray-hot"></i> {{=formatTjNumber(d[i].read_cnt) }}</span>
                    <span class="col"><i class="icon-hand"></i> {{=formatTjNumber(d[i].like_cnt) }}</span>
                </div>
            </div>
        </a>
    </div>
    {{# } }}
</script>
<script>
    var p = 1;
    var tid = "all";
    var vip = "all";
    var end = "all";
    $(document).ready(function() {
        $('.nav-row-cate > .action a').click(function(e) {
            var collect = $('.collect-box');
            var open = $('.open-box');
            var self = $(this);
            if (self.hasClass('opened')) {
                open.hide();
                collect.show();
                self.find('.text').text('展开');
                self.removeClass('opened');

                var type_id =  $('.open-type .active').attr('val');
                $(".close-type div a").removeClass('active');
                $('#close-'+type_id).addClass('active');
                return
            }
            var type_id =  $('.close-type .active').attr('val');
            if($("#open-"+type_id).length>0){
                $(".open-type div a").removeClass('active');
            }
            $('#open-'+type_id).addClass('active');
            collect.hide();
            open.show();
            self.find('.text').text('收起');
            self.addClass('opened')
        });

        // 滚动到底部获取新的分页
        var url = "index.php?m=Home&c=Mh&a=ajax_book_cate_list";
        var data = {tid:tid,vip:vip,end:end,p:p};
        if(p == 1){
            get_page_data(url,data);
        }
        list_page(url,data);
        // 选择分类显示
        $(".condition-box .container div a").click(function(){
            var p_entry = $(this).parents('.container');
            p_entry.find("div a").removeClass("active");
            $(this).addClass("active");
            var c_type = $(this).attr('type');
            var c_val = $(this).attr('val');
            if(c_type == 'tid'){
                tid = c_val;
            }
            if(c_type == 'vip'){
                vip = c_val;
            }
            if(c_type == 'end'){
                end = c_val;
            }
            p = 1;
            $("#html_box").empty();
            data['p'] = p;
            data['end'] = end;
            data['vip'] = vip;
            data['tid'] = tid;
            //window.console&&console.log(data);
            get_page_data(url,data);
        });
    })
</script>
<!-- 统计 -->
<script type="text/javascript" src="/Public/home/mhjs/gcoupon.min.js"></script>
<!--<script type="text/javascript">
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