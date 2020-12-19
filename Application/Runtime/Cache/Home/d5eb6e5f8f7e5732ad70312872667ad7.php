<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}
</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<meta name="format-detection" content="telephone=no, address=no">
<title><?php echo ($_site['name']); ?></title>
<link rel="stylesheet" type="text/css" href="/Public/ever/css/common.css">
<link rel="stylesheet" type="text/css" href="/Public/ever/css/app.css">
<link rel="stylesheet" type="text/css" href="/Public/ever/css/font.css">
<link rel="stylesheet" type="text/css" href="/Public/ever/css/designer.css">
<link rel="stylesheet" type="text/css" href="/Public/ever/css/index.css">
<link href="/Public/ever/css/owl.carousel.css" rel="stylesheet">
<script src="/Public/ever/js/jquery-1.8.3.min.js"></script>
<script src="/Public/ever/js/owl.carousel.min.js"></script>
<script src="/Public/ever/js/common.js"></script>
<script src="/Public/ever/js/app.js"></script>
<body bgcolor="#f2f2f2">
<style>
.active {
    background: #ff5000!important;
}
</style>
<link rel="stylesheet" type="text/css" href="/Public/ever/css/spark.css">
<div class="sparkHead" style="background: #0085d0;color:#fff">
	<i class="iconfont icon-back commonBack" onclick="javascript:history.go(-1)"></i>
	<h3 class="text-overflow_1">预存金额成为代理</h3>
</div>
<div class="spark_content">
	<ul class="clr">
		<li class="flex spark-detail">
			<h4>预存金额</h4>
			<div class="flex_1">
			<?php if(is_array($_lv)): foreach($_lv as $k=>$v): ?><span class="" data-lv="<?php echo ($k); ?>" data-price="<?php echo ($v['money']); ?>"><?php echo ($v['money']); ?>元</span><?php endforeach; endif; ?>
			</div>
		</li>
		<li class="flex">
			<h4>&nbsp;&nbsp;&nbsp;&nbsp;</h4>
			<div class="flex_1">
				<input type="text" name="price" id="price" value="" placeholder="输入其他金额">
			</div>
		</li>
		<li class="flex">
			<h4>姓&nbsp;&nbsp;&nbsp;&nbsp;名</h4>
			<div class="flex_1">
				<input type="text" name="true_name" value="" placeholder="提现需要实名制">
			</div>
		</li>
		<li class="flex">
			<h4>微信号</h4>
			<div class="flex_1">
				<input type="text" name="wxId" value="" placeholder="请输入微信号">
			</div>
		</li>
		<li class="flex">
			<h4>手机号</h4>
			<div class="flex_1">
				<input type="text" name="mobile" value="" placeholder="请输入11位手机号">
			</div>
		</li>
		
		<li class="flex" id="pay">
			<h4>支付方式</h4>
			<span class="active" data-type="1">微信支付</span>
			<span data-type="2">支付宝支付</span>
		</li>
		</ul>
</div>
<div style="height:50px"></div>
<div class="spark_buy flex">
	<div class="flex_1 spark_price">价格 ￥<span></span></div>
	<button class="spark_submit" onclick="submitOrder()">立即预存</button>
</div>

<script type="text/javascript">
	var type = 0;//支付方式：1-微信支付，2-支付宝支付
		price = 0;
	$(function(){
		$(".spark-detail span").each(function () {
			if($(this).attr('data-lv') ==1){
				$(this).addClass('active');
				price =  $(this).attr('data-price') ;
				$(".spark_buy span").text(price);
			};
		});
		
		$('#pay').find('span').each(function () {
			if($(this).hasClass('active')){
				type = $(this).attr('data-type');
			};
		});
		
		$(".spark-detail span").click(function () {
			price =  $(this).attr('data-price') ;
			$(".spark-detail span").removeClass("active");
			$(this).addClass("active");
			$(".spark_buy span").text(price);
		});
		
		$('#pay').find('span').click(function(){
			$(this).addClass('active');
			type = $(this).attr('data-type');
			$(this).siblings().removeClass('active');
		});
		$('#price').bind('input propertychange', function() { 
			price = $(this).val();
			if($(this).val()==''){
				$(".spark_buy span").text('待输入');
			}else{
				$(".spark_buy span").text(price);
			}
			$(".spark-detail span").removeClass("active");
		});
	});

	function submitOrder() {
		var true_name = $("input[name=true_name]").val();
		var wxId = $("input[name=wxId]").val();
		var mobile = $("input[name=mobile]").val();
		if(price == 0){
			alert("请选择金额或输入其他金额");
			return;
		}
		if (true_name == "") {
			alert("姓名不能为空");
			$("input[name=true_name]").focus();
			return;
		}
		if (wxId == "") {
			alert("微信号不能为空");
			$("input[name=wxId]").focus();
			return;
		}
		var isMobile = /^1\d{10}$/;
		if (!isMobile.test(mobile)) {
			alert("请输入正确的11位手机号");
			$("input[name=mobile]").focus();
			return;
		}
		if(type == 0){
			alert("请选择支付方式");
			return;
		}
		
		$(".spark_submit").attr('disabled', "true").addClass("disabled");
		$(".spark_submit").text("正在提交...");
		$.post("<?php echo U('pay');?>",{ money:price,true_name: true_name, wxid: wxId, mobile: mobile,type:type},function (data) {
				console.log(data);
				if (data.status) {
					if(type==1){
						callpay(eval('(' +data.info + ')'));
					}else{
						console.log(data.info);
						window.location.href="/index.php?m=home&c=Alipay&a=ali_pay&order="+data.info+"&table=agent";
					}
				} else {
					alert(data.info);
					$(".spark_submit").removeAttr('disabled').removeClass("disabled");
					$(".spark_submit").text("立即预存");
					return;
				}
			},
			"json"
		);
	}
	
	
	//调用微信JS api 支付
	function jsApiCall(parameters)
	{
		WeixinJSBridge.invoke('getBrandWCPayRequest',parameters,function(res){
					WeixinJSBridge.log(res.err_msg);
					//alert(res.err_msg);
					if(res.err_msg == "get_brand_wcpay_request:ok"){
						window.location.href = "<?php echo U('Agent/record');?>";
					}
					if(res.err_msg == "get_brand_wcpay_request:cancel"){
						$(".spark_submit").removeAttr('disabled').removeClass("disabled");
						$(".spark_submit").text("立即预存");
					}
				}
		);
	}

	function callpay(parameters)
	{
		if (typeof WeixinJSBridge == "undefined"){
			if( document.addEventListener ){
				document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			}else if (document.attachEvent){
				document.attachEvent('WeixinJSBridgeReady', jsApiCall);
				document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			}
		}else{
			jsApiCall(parameters);
		}
	}
	
</script>
		

<div id="backtop"><i class="iconfont icon-fold"></i></div>
</body>
</html>