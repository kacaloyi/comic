<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html data-dpr="1" style="font-size: 54px;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<title>账单明细</title>
<link rel="stylesheet" type="text/css" href="/Public/home/mhcss/style.min.css">
<script type="text/javascript" src="/Public/home/mhjs/jquery.js"></script>
<script type="text/javascript">
    if (self != top) {
        top.location.href=self.location.href;
    }
    var req_time = '30',page_start_time=+(new Date),page_end_time=page_start_time;
    </script>
<meta name="viewport" content="designWidth=750,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- 防止加载lib.flexible加载的时候文字由大变小的闪烁 -->
<style>
        html, body {
            font-size: 12px;
        }
</style>
<!-- lib.flexible 移动端相对适应比例 必须在浏览器head类 -->
<script type="text/javascript">
    !function (a, b) { function c() { var b = f.getBoundingClientRect().width; b / i > 540 && (b = 540 * i); var c = b / 10; f.style.fontSize = c + "px", k.rem = a.rem = c } var d, e = a.document, f = e.documentElement, g = e.querySelector('meta[name="viewport"]'), h = e.querySelector('meta[name="flexible"]'), i = 0, j = 0, k = b.flexible || (b.flexible = {}); if (g) {  var l = g.getAttribute("content").match(/initial\-scale=([\d\.]+)/); l && (j = parseFloat(l[1]), i = parseInt(1 / j)) } else if (h) { var m = h.getAttribute("content"); if (m) { var n = m.match(/initial\-dpr=([\d\.]+)/), o = m.match(/maximum\-dpr=([\d\.]+)/); n && (i = parseFloat(n[1]), j = parseFloat((1 / i).toFixed(2))), o && (i = parseFloat(o[1]), j = parseFloat((1 / i).toFixed(2))) } } if (!i && !j) { var p = (a.navigator.appVersion.match(/android/gi), a.navigator.appVersion.match(/iphone/gi)), q = a.devicePixelRatio; i = p ? q >= 3 && (!i || i >= 3) ? 3 : q >= 2 && (!i || i >= 2) ? 2 : 1 : 1, j = 1 / i } if (f.setAttribute("data-dpr", i), !g) if (g = e.createElement("meta"), g.setAttribute("name", "viewport"), g.setAttribute("content", "initial-scale=" + 1 + ", maximum-scale=" + 1 + ", minimum-scale=" + 1 + ", user-scalable=no"), f.firstElementChild) f.firstElementChild.appendChild(g); else { var r = e.createElement("div"); r.appendChild(g), e.write(r.innerHTML) } a.addEventListener("resize", function () { clearTimeout(d), d = setTimeout(c, 300) }, !1), a.addEventListener("pageshow", function (a) { a.persisted && (clearTimeout(d), d = setTimeout(c, 300)) }, !1), "complete" === e.readyState ? e.body.style.fontSize = 12 * i + "px" : e.addEventListener("DOMContentLoaded", function () { e.body.style.fontSize = 12 * i + "px" }, !1), c(), k.dpr = a.dpr = i, k.refreshRem = c, k.rem2px = function (a) { var b = parseFloat(a) * this.rem; return "string" == typeof a && a.match(/rem$/) && (b += "px"), b }, k.px2rem = function (a) { var b = parseFloat(a) / this.rem; return "string" == typeof a && a.match(/px$/) && (b += "rem"), b } }(window, window.lib || (window.lib = {}));
    </script>

<style type="text/css">
      #banner-container { display: block; position: relative; z-index: 1; width: 100%; overflow: hidden; }
      #banner-container .loading { display: block; width: 70px; text-align: center; font-size: 0; position: absolute; top: 50%; left: 50%; -webkit-transform: translate3d(-50%,-50%,0); transform: translate3d(-50%,-50%,0); }
      #banner-container .loading .item { width: 18px; height: 18px; margin: 0 2px; background-color: #333333; border-radius: 100%; display: inline-block; -webkit-animation: loading-delay 1.4s infinite ease-in-out; animation: loading-delay 1.4s infinite ease-in-out; -webkit-animation-fill-mode: both; animation-fill-mode: both; }
      #banner-container .loading .item:nth-child(2) { -webkit-animation-delay: -0.16s; animation-delay: -0.16s; }
      #banner-container .loading .item:nth-child(3) { -webkit-animation-delay: -0.32s; animation-delay: -0.32s; }
      @-webkit-keyframes loading-delay {
          0%,80%,100% {
              -webkit-transform: scale(0);
          }
          40% {
              -webkit-transform: scale(1);
          }
      }
      @keyframes loading-delay {
          0%,80%,100% {
              transform: scale(0);
              -webkit-transform: scale(0);
          }
          40% {
              transform: scale(1);
              -webkit-transform: scale(1);
          }
      }
</style>
</head>
<body style="font-size: 12px;" class="mui-ios mui-ios-11 mui-ios-11-0">
<div class="rt-bar">
	<div class="row">
		<div class="col icon">
			<a href="javascript:history.go(-1);">
			<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 40 40"><path d="M29.56 39.47a2 2 0 0 1-1.38-.56L8.45 20 28.17 1.09A2 2 0 1 1 30.94 4L14.23 20l16.71 16a2 2 0 0 1-1.38 3.44z" fill="#ff730a"></path></svg>
			</a>
		</div>
		<div class="col title" style="margin-right: 1.333rem;">
			账单明细
		</div>
	</div>
</div>
<div class="rt-tabs mt-10 tab">
	<div class="item">
		<a class="active" data-type="1">充值</a>
	</div>
	<div class="item">
		<a data-type="2">签到</a>
	</div>
</div>
<div class="rt-list" id="html_box">
	
</div>
<script>
    var page = 1;
    var wait = false;
	var model = 1;
	load();
	
    $(function () {
        $(".tab a").click(function () {
			$('#html_box').html('');
            model =parseInt($(this).attr("data-type"));
            if(!$(this).hasClass("active"))
            {
                if (model == 1) {
                    $(".tab a:eq(1)").removeClass('active');
                    $(".tab a:eq(0)").addClass('active');
                }
                else {
                    $(".tab a:eq(0)").removeClass('active');
                    $(".tab a:eq(1)").addClass('active');
                }
            }
			load();
        })
    })
    $(".rt-list").on('scroll', function () {
        if (wait) return;
        var wScrollY = window.scrollY; // 当前滚动条位置
        var wInnerH = window.innerHeight; // 设备窗口的高度（不会变）
        var bScrollH = document.body.scrollHeight; // 滚动条总高度
        if (wScrollY + wInnerH >= bScrollH) {
            wait = true;
            load();
        }
    });
	
	function load(){
		$.ajax({
			url: "<?php echo U('Book/getRecord');?>",
			type: 'post',
			data:{page:page,model:model},
			success: function(d) {
				console.log(d);
				if (d.status == 1) {
					appendBills(d.info);
					page++;
					wait = false;
				}else{
					bh_msg_tips(d.info);
				}
			},
		});
	}
	
	function appendBills(bills){
        for (var i in bills) {
            var li = '<div class="item"> <div class="title">' + (model == 1 ? "充值" : "签到") + '</div> <div class="body"> <div class="typo-orange">' ;
			if(bills[i].isvip == 1){
				li+= "vip会员"+'</div> <div class="typo-gray">' + bills[i].time + '</div> </div> </div>';
			}else{
				li+= '+'+bills[i].money + '书币</div> <div class="typo-gray">' + bills[i].time + '</div> </div> </div>';
			}
			$("#html_box").append(li);

        }
    }
   
	function bh_msg_tips(msg) {
		var oMask = document.createElement("div");
		oMask.id = "bh_msg_lay";
		oMask.style.position = "fixed";
		oMask.style.left = "0";
		oMask.style.top = "50%";
		oMask.style.zIndex = "100";
		oMask.style.textAlign = "center";
		oMask.style.width = "100%";
		oMask.innerHTML = "<span style='background: rgba(0, 0, 0, 0.65);color: #fff;padding: 10px 15px;border-radius: 3px; font-size: 14px;'>" + msg
			+ "</span>"; document.body.appendChild(oMask);
		setTimeout(function () {
			$("#bh_msg_lay").remove();
		}, 2000);
	}
	
	function ConvertJSONDateToJSDateObject(jsondate) {
		var date = new Date(parseInt(jsondate.replace("/Date(", "").replace(")/", ""), 10));
		return date;
	}
</script>
<div class="backtop" id="icon-top" style="display:none">
	<a href="javascript:void(0);" class="top">顶部</a>
</div>

</body>
</html>