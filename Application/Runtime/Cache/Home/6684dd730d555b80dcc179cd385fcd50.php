<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0038)https://m.efucms.com/my/<?php echo U('Mh/index');?> -->
<html data-dpr="1" style="font-size: 37.5px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>会员中心</title>
    <meta name="keywords" content="个人中心" />
    <meta name="description" content="<?php echo ($_CFG['site']['name']); ?>会员中心" />
    <!-- 共用引入资源.开始 -->

    <script src="/Public/home/mhjs/stats.js" name="MTAH5" sid="500462993"></script>
    <meta name="viewport" content="designWidth=750,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- 防止加载lib.flexible加载的时候文字由大变小的闪烁 -->
    <style>html,body{font-size:12px;}
    </style>
    <!-- lib.flexible 移动端相对适应比例 必须在浏览器head类 -->
    <script type="text/javascript">
        !function (a, b) { function c() { var b = f.getBoundingClientRect().width; b / i > 540 && (b = 540 * i); var c = b / 10; f.style.fontSize = c + "px", k.rem = a.rem = c } var d, e = a.document, f = e.documentElement, g = e.querySelector('meta[name="viewport"]'), h = e.querySelector('meta[name="flexible"]'), i = 0, j = 0, k = b.flexible || (b.flexible = {}); if (g) {  var l = g.getAttribute("content").match(/initial\-scale=([\d\.]+)/); l && (j = parseFloat(l[1]), i = parseInt(1 / j)) } else if (h) { var m = h.getAttribute("content"); if (m) { var n = m.match(/initial\-dpr=([\d\.]+)/), o = m.match(/maximum\-dpr=([\d\.]+)/); n && (i = parseFloat(n[1]), j = parseFloat((1 / i).toFixed(2))), o && (i = parseFloat(o[1]), j = parseFloat((1 / i).toFixed(2))) } } if (!i && !j) { var p = (a.navigator.appVersion.match(/android/gi), a.navigator.appVersion.match(/iphone/gi)), q = a.devicePixelRatio; i = p ? q >= 3 && (!i || i >= 3) ? 3 : q >= 2 && (!i || i >= 2) ? 2 : 1 : 1, j = 1 / i } if (f.setAttribute("data-dpr", i), !g) if (g = e.createElement("meta"), g.setAttribute("name", "viewport"), g.setAttribute("content", "initial-scale=" + 1 + ", maximum-scale=" + 1 + ", minimum-scale=" + 1 + ", user-scalable=no"), f.firstElementChild) f.firstElementChild.appendChild(g); else { var r = e.createElement("div"); r.appendChild(g), e.write(r.innerHTML) } a.addEventListener("resize", function () { clearTimeout(d), d = setTimeout(c, 300) }, !1), a.addEventListener("pageshow", function (a) { a.persisted && (clearTimeout(d), d = setTimeout(c, 300)) }, !1), "complete" === e.readyState ? e.body.style.fontSize = 12 * i + "px" : e.addEventListener("DOMContentLoaded", function () { e.body.style.fontSize = 12 * i + "px" }, !1), c(), k.dpr = a.dpr = i, k.refreshRem = c, k.rem2px = function (a) { var b = parseFloat(a) * this.rem; return "string" == typeof a && a.match(/rem$/) && (b += "px"), b }, k.px2rem = function (a) { var b = parseFloat(a) / this.rem; return "string" == typeof a && a.match(/px$/) && (b += "rem"), b } }(window, window.lib || (window.lib = {}));
    </script>
    <link rel="stylesheet" type="text/css" href="/Public/home/mhcss/style.min.css">
    <script type="text/javascript" src="/Public/home/mhjs/fundebug.0.1.7.min.js" apikey="ba3a0e0d938e92b44f279067dffb8d071ee87fc35eb75918b7a900e8581a955d"></script>
    <script type="text/javascript" src="/Public/home/mhjs/jquery.js"></script>
    <!-- 共用引入资源.结束 -->
    <script type="text/javascript" src="/Public/home/mhjs/saved_resource"></script>
	
	<style>

/* .user-notice{height: 1.5rem;padding: .5rem;font-size:.85rem;line-height: 1.5rem;background:#fff} */
.user-notice-l{width:25%;float:left;height:30px;line-height:30px;}
.user-notice-r{color:#928c8c;width:75%;float:left}

.back{position: absolute;    width: 20px;    height: 20px;  left: 10px;    top: 0.8em;}
.home{position: absolute;    width: 11px;    height: 20px; right: 10px;    top: 0.8em; background: url(/Public/home/mhimages/setting.png?v2) no-repeat;    background-size: 5px 20px;}

.title span {
    display: block;
    padding: 5px;
    color: #fff;
    font-size: .8em;
}

.title span .u2 {
    height: 26px;
    background-image: url(/Public/home/mhimages/vip.png?v2);
    background-repeat: no-repeat;
    background-position: left center;
    padding-left: 35px;
    text-align: left;
    margin-left: 7px;
    color: #AC7135;
}

#u2 {
    font-weight: bold;
    font-size: 0.8em;
    font-family: consolas, "Microsoft YaHei", "\5fae\8f6f\96c5\9ed1";
    color: transparent;
    background: -webkit-linear-gradient(45deg, #70f7fe, #fbd7c6, #fdefac, #bfb5dd, #bed5f5);
    -moz-linear-gradient(45deg, #70f7fe, #fbd7c6, #fdefac, #bfb5dd, #bed5f5): ;
    -ms-linear-gradient(45deg, #70f7fe, #fbd7c6, #fdefac, #bfb5dd, #bed5f5): ;
    -webkit-background-clip: text;
    animation: ran 1s linear infinite;
}


</style>
	
</head>
<body style="font-size: 12px;">
   
<div class="uh-box" style="height: 4rem;overflow: hidden;">
    <img src="/Public/home/images/ubg.gif" class="bg">
   
    <div class="container">
         
        <div class="avatar">
        <input type="file" name="file" onchange="upload(this)" class="file" style="display:none;" />
        <img width="65" height="65" id="showheadimg" src="<?php echo ($user["headimg"]); ?>" onclick="chheadimg();" />
    		<?php if($user['vip']): ?><div class="deco">
                  <label class="rank">VIP</label>
                </div><?php endif; ?>
        </div>
        <div class="body">
            <div class="title">
                <span style=" color: #FF;text-shadow: 0 0 1px rgba(0,0,0,.6);font-weight: bold;"><?php echo ($user["nickname"]); ?></span>
                <span class="u2" style="font-size: 0.3em;"> 个性签名:这家伙很懒什么也没写<!---162482---></span>
                <span><div class="u2"><b id="u2"> 普通会员</b></div></span>
            </div>
            <!--<div class="title">密码：<a style=" color: #FF0036;"><?php echo ($user["userpwd"]); ?></a></div>-->
             <div class="text">
             
             <?php if($user['vip']): ?><span style="display: block;">VIP到期时间：<a style=" color: #FF0036;"><?php echo (date("Y-m-d",$user['vip_e_time'])); ?></a></span><?php endif; ?>
            </div>
    		<!--<div class="action">
    			<a href="<?php echo U('Mh/withdraw');?>" class="btn btn-sign" style="color:#2196F3">申请提现</a>
    		</div>
    		<div class="action">
    			<?php if($sign): ?><a href="javascript:;" class="btn btn-sign" style="color:#FF5722">已签到</a>
    			<?php else: ?>
    				<a href="javascript:;" onclick="SignOn(this);" class="btn btn-sign" style="color:#2196F3">签到</a><?php endif; ?>
    			
    		</div>-->
		</div>
       <a href="javascript:history.go(-1);" class="back icon">

                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40">
        		<path d="M29.56 39.47a2 2 0 0 1-1.38-.56L8.45 20 28.17 1.09A2 2 0 1 1 30.94 4L14.23 20l16.71 16a2 2 0 0 1-1.38 3.44z" fill="#ff730a">
		        </path>
		        </svg>

        </a>
        <a href="<?php echo U('Mh/index');?>" class="home icon">
             <i class="icon-home" ></i>
        </a>

    </div>
</div>

  <script>
	function SignOn(ob){
		var $this = ob;
		bh_msg_tips('请稍候，请求正在发送中');
		$.post("<?php echo U('Book/sign');?>",function(d){
			$("#bh_msg_lay").remove();
			if(d){
				if(d.status){
					bh_msg_tips(d.info);
					$($this).attr('onclick','').unbind('click');
					$($this).html('签到成功');
				}else{
					bh_msg_tips(d.info);
				}
			}else{
				alert('非法请求');
			}
		});
	}
  </script>
    
<div class="uh-row" style="position: relative;">
    <div class="col" onclick="javascript:void(0);">
       <a href="<?php echo U('Mh/pay');?>" class="btn">
        <div class="num"><?php echo (floatval($user["money"])); ?></div>
        <div class="title">书币余额</div>
      </a>
    </div>
    <div class="col" onclick="javascript:void(0);">
      <a href="<?php echo U('Mh/pay');?>" class="btn">
        <?php if($user['vip']): ?><div class="num today-bean"><?php echo (date("Y-m-d",$user['vip_e_time'])); ?></div>
          <?php else: ?>
          <div class="num today-bean">                                   
            -------
          </div><?php endif; ?>
        <?php if($user['vip']): ?><div class="title">VIP到期时间</div>
           <?php else: ?>
          <div class="title">未开通VIP</div><?php endif; ?>
        </a>
      </div>
<!--  <div class="col" onclick="javascript:void(0);">
        <div class="num today-bean"><?php echo (floatval($user["rmb"])); ?></div>
        <div class="title">佣金</div>
    </div> -->
</div>
<!-- <div class="user-notice">
		<div class="user-notice-l fl">
			<i class="glyphicon glyphicon-volume-up"></i>	最新公告：
		</div>
		<div class="user-notice-r fl">
			<marquee behavior="scroll" direction="left" style="color: #EC5C11;font-weight: bold;width: 100%;height: 30px;font-size: 14px;line-height: 30px;" scrollamount="3"><?php echo ($_CFG['site']['gonggao']); ?></marquee>
		</div>
</div>
 -->
<div class="uh-nav mb-10 mb-tabar" style="clear:both">

    <div class="item mt-10">
        <a href="#" class="link">
            <i class="icon-level"></i>
             <div class="title">
            <marquee width="80%" height="100%" scrollamount="3" >
                <font size="+1" color="#D7BA6F"><strong>公告：每日签到可以获得书币！并有机会获得VIP会员享受全站免费看！</strong>
                </font>
            </marquee>
            </div>
        </a>
        <div class="action"> 
    			<?php if(($sign == true)): ?><a href="#" class="btn" style="color:#FF5722">已签到</a>
    			<?php else: ?>
    				<a href="javascript:;" onclick="SignOn(this);" class="btn" style="color:#2196F3">签到</a><?php endif; ?>
    			
    	</div>
     
        
    </div>
    
    <div class="item tl">
        <a href="<?php echo U('Mh/pay');?>" class="link">
            <i class="icon-money"></i>
           <div class="title">储值中心</div> 
         <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24"><title>right-arrow</title><path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
         </div>            
           
        </a>

    </div>
    <div class="item tl">
      <a href="<?php echo U('Mh/record');?>" class="link">
        <i class="icon-buy"></i>
        <div class="title">消费记录</div>
         <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24"><title>right-arrow</title><path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
         </div> 
      </a>
    </div>
    
     <div class="item tl">
      <a href="<?php echo U('Mh/my_tuiguang');?>" class="link">
        <i class="icon-shop"></i>
        <div class="title">任务中心</div> <font size="-1" color="#D7BA6F">做任务赚VIP</font>
         <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24"><title>right-arrow</title><path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
         </div> 
      </a>
    </div>
    <!--<div class="item tl">
        <a href="<?php echo U('Mh/pay');?>" class="link">
            <i class="icon-level"></i>
            <div class="title">书币：<?php echo (floatval($user["money"])); ?>枚</div>
        </a>    
            <div class="action">
            <a href="<?php echo U('Mh/pay');?>" class="btn">充值书币</a>
        </div>
        </a>
    </div> ->
    

<!--    <div class="item mt-10">
        <a href="<?php echo U('Mh/myTeam');?>" class="link">
            <i class="icon-level"></i>  
            <div class="title">我的客户</div>
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24">
                <title>right-arrow</title>
                <path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </div>
        </a>
    </div>
    
    <div class="item tl">
        <a href="<?php echo U('Mh/qrcode');?>&id=<?php echo ($user['id']); ?>" class="link">
            <i class="icon-shop"></i>
            <div class="title">推广二维码</div>
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24">
                <title>right-arrow</title>
                <path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </div>
        </a>
    </div>
 -->
    <div class="item tl">
        <a href="<?php echo U('Mh/look',array('sc'=>$user['username']));?>" class="link">
            <i class="icon-level"></i>
            <div class="title" style="color:#FF5722">点击收藏网址发布页，放走失【重要】</div>
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24"><title>right-arrow</title><path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
            </div> 
        </a>
    </div> 

   
    <div class="item tl">
        <a href="<?php echo ($_CFG['site']['appdownload']); ?>" class="link">
            <i class="icon-feedback"></i>
            <div class="title">APP下载</div>
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24">
                    <title>right-arrow</title>
                    <path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </div>
        </a>
    </div>    

	
	<div class="item tl">
        <a href="<?php echo U('Mh/message_index');?>" class="link">
            <i class="icon-message"></i>
            <div class="title">我的消息</div>
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24"><title>right-arrow</title><path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
            </div>
        </a>
    </div>

    <div class="item tl">
        <a href="<?php echo U('Mh/my_feedback');?>" class="link">
            <i class="icon-feedback"></i>
            <div class="title">建议反馈</div>
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24"><title>right-arrow</title><path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
            </div>
        </a>
    </div>
    <div class="item tl">
        <a href="<?php echo U('Mh/help');?>" class="link">
            <i class="icon-service"></i>
            <div class="title">客服帮助</div>
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24"><title>right-arrow</title><path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
            </div>
        </a>
    </div>


<!--    <div class="item tl">
        <a href="<?php echo U('Mh/bangding');?>" class="link">
            <i class="icon-feedback"></i>
            <div class="title">绑定手机端账号</div>
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24">
                    <title>right-arrow</title>
                    <path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </div>
        </a>
    </div>-->
  


   
    <div class="item mt-10">  
        <a href="<?php echo U('Member/login');?>" class="link">
            <i class="icon-feedback"></i>
            <div class="title">修改密码</div>
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24">
                    <title>right-arrow</title>
                    <path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </div>
        </a>
    </div>

    <div class="item tl">
        <a href="<?php echo U('Member/logout');?>" class="link">
            <i class="icon-account"></i>
            <div class="title">退出/切换账号</div>
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 14 24">
                    <title>right-arrow</title>
                    <path d="M1.91 1.93L12.06 12 1.91 22" fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
            </div>
        </a>
    </div>
</div>

<div class="tabar flb">
    <nav class="nav hls1">
        <div class="item">
            <a href="<?php echo U('Mh/book_recent_read');?>">
                <i class="icon-book"></i><div class="title">书架</div>
            </a>
        </div>
        <div class="item">
            <a href="<?php echo U('Mh/index');?>" >
                <i class="icon-home"></i><div class="title">漫画</div>
            </a>
        </div>
       <div class="item">
            <a href="<?php echo U('Book/index');?>" >
                <i class="icon-home"></i><div class="title">小说</div>
            </a>
        </div>
        <div class="item">
            <a href="<?php echo U('Mh/my');?>" class="active">
                <i class="icon-user"></i><div class="title">我的</div>
            </a>
        </div>
    </nav>
</div>

<div class="mask-box" style="display: none;"></div>
<!-- <div class="modal" style="display: none;">
    <div class="inner">
        <div class="sign-box">
            <div class="head">
                <div class="title">签到成功</div>
            </div>
            <div class="body">
                <div class="text">金豆+10</div>
                <div class="row">
                    <div class="col mon sign-1"><span>1</span><div>周一</div></div>
                    <div class="col tue sign-2"><span>2</span><div>周二</div></div>
                    <div class="col wed sign-3"><span>3</span><div>周三</div></div>
                    <div class="col thu sign-4"><span>4</span><div>周四</div></div>
                    <div class="col fri sign-5"><span>5</span><div>周五</div></div>
                    <div class="col sat sign-6"><span>6</span><div>周六</div></div>
                    <div class="col sun sign-7"><span>7</span><div>周日</div></div>
                </div>
                <div class="desc">每周连续签到7天，额外奖励50金豆</div>
            </div>
        </div>
        <div class="pull-action-2">
            <a href="javascript:void(0);" onclick="$(&#39;.mask-box&#39;).hide();$(&#39;.modal&#39;).hide();">
                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M29.65 27.53L18.11 16 29.65 4.44a1.5 1.5 0 0 0-2.12-2.12L16 13.86 4.44 2.32a1.5 1.5 0 0 0-2.12 2.12L13.86 16 2.32 27.53a1.5 1.5 0 1 0 2.12 2.12L16 18.1l11.53 11.55a1.5 1.5 0 0 0 2.12-2.12z" fill="#999"></path></svg>
            </a>
        </div>
    </div>
</div> -->
<script type="text/javascript">
    $(function(){
        var $autopay = $("#autopay");
        $("#switch-auto-buy").click(function(){
            if($autopay.hasClass('posting')){
                bh_msg_tips('请稍等，正在设置中');
                return false;
            }
            var autoPay = parseInt($autopay.val()),autoPay=!autoPay?1:0;
            $autopay.addClass('posting');
            AjaxJson("/My/switchAutoBuy",{autoPay:autoPay,random:+(new Date)},function(res){
                $autopay.removeClass('posting');
                if(res.status*1 == 1){
                    $autopay.val(autoPay).prop('checked',!!autoPay);
                }else{
                    bh_msg_tips(res.info);
                }
            })
        });
    });
    var is_request = false;
    function sign_in(){
        if(is_request){
            return false;
        }
        is_request = true;
        AjaxJson("/My/ajax_sign",{random:+(new Date)},function(res){
            is_request = 0;
            if(res.status*1 == 1){
                var sign_weeks = res.sign_weeks.split(',');
                for(var i=0;i<res.week;i++){
                    $('.sign-'+(i+1)).addClass('after')
                }
                sign_weeks.forEach(function(val,index){
                    $('.sign-'+val).addClass('signed');
                });
                $('.mask-box').show();
                $('.modal').show();
                $('.btn-sign').removeAttr('onclick');
                $('.btn-sign').text('已签到');
                $('.btn-sign').css({"color":"#999"});
                $('.today-bean').text(res.today_bean);
            }else{
                bh_msg_tips(res.msg);
            }
        });
    }
</script>
<!--<script type="text/javascript" src="/Public/home/mhjs/gcoupon.min.js"></script>-->
<script type="text/javascript" src="/Public/home/mhjs/lrz.mobile.min.js"></script>
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
    
    //点击头像
    function chheadimg() {
    	$("input[name='file']").click();
    }
    function upload(obj){
		//上传图片至服务器
		lrz(obj.files[0], {
			done: function (results) {
				  // 你需要的数据都在这里，可以以字符串的形式传送base64给服务端转存为图片。
				  $.post("<?php echo U('upload_64');?>",
						  {img:results.base64,size:results.base64.length,user_id:"<?php echo ($user['id']); ?>"},function(data){
							  if(data.status){
								  //img.attr('src',data.info);
								  $("#showheadimg").attr('src',data.info.uploadPathtrue);
							  }else{
								  alert(data.info.message);
							  }
						  });
			}
		});
		
	}
    
</script>-->



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