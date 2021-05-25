<?php
namespace Home\Controller;
use Think\Controller;
class AlipayController extends NotifyBaseController {
      //在类初始化方法中，引入相关类库    
       public function _initialize() {
        parent::_initialize();
           
        vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');
		
    }
	
	//支付宝支付
	public function ali_pay(){
		header("Content-type:text/html;charset=utf-8");
		
		$sn = I('sn');
		$table = I('table',"charge");
		if(empty($sn)){
		  die("没有订单号，阿里不能再赔");  	
		}
		
		$order = M($table)->where(array('sn'=>$sn))->find();
	    
        if(!is_array($order)) {
			echo "<script>alert($sn'订单未找到！');</script>";
			exit;
		}
		
		//$user = M('user')->find(intval($order['user_id']));
		
		$create_time = time();
		$time_start = date("YmdHis", $create_time); //交易起始时间
		$time_expire = date("YmdHis", $create_time + 7200); //交易结束时间  订单号有效期2小时
		
		$pay_array = array(
			'out_trade_no' => $order['sn'], 
			'total' => $order['money'], 
			'order_id' => $order['id'], 
			'time_start'=>$time_start,
			'time_expire'=>$time_expire,
			'body'	=> '支付宝在线支付',
			'ordbody'	=> '支付',
			'ordshow_url'	=> U('Member/my'),
			'type' =>$table,
		);
		
		//调用支付接口
		$this->assign('pay_array',$pay_array);
		$this->display();
	}
	
    
    //doalipay方法
    public function doalipay(){
        header("Content-type:text/html;charset=utf-8");
        /**************************请求参数**************************/
        $payment_type = "1"; //支付类型 //必填，不能修改
        $notify_url = C('alipay.notify_url'); //服务器异步通知页面路径
        $return_url = C('alipay.return_url'); //页面跳转同步通知页面路径
        $seller_email = C('alipay.seller_email');//卖家支付宝帐户必填
        $out_trade_no = $_POST['trade_no'];//商户订单号 通过支付页面的表单进行传递，注意要唯一！
        $subject = $_POST['ordsubject'];  //订单名称 //必填 通过支付页面的表单进行传递
        $total_fee = $_POST['ordtotal_fee'];   //付款金额  //必填 通过支付页面的表单进行传递
        $body = $_POST['type'];  //订单描述 通过支付页面的表单进行传递
        $show_url = $_POST['ordshow_url'];  //商品展示地址 通过支付页面的表单进行传递
        $anti_phishing_key = "";//防钓鱼时间戳 //若要使用请调用类文件submit中的query_timestamp函数
        $exter_invoke_ip = get_client_ip(); //客户端的IP地址 
		$is_mobile = $_POST['is_mobile']; //是否手机访问 1手机 2PC
		
		$type = $_POST['type'];
        /************************************************************/
        //echo("is_mobile=$is_mobile");
        //构造要请求的参数数组，无需改动
		if(1 == $is_mobile) {
			$alipay_config=C('alipay_config_mobile');
			$parameter = array(
				"service"       => $alipay_config['service'],
				"partner"       => $alipay_config['partner'],
				"seller_id"  	=> $alipay_config['seller_id'],
				"payment_type"	=> $alipay_config['payment_type'],
				"notify_url"	=> $alipay_config['notify_url'],
				"return_url"	=> $alipay_config['return_url'],
				"_input_charset"=> trim(strtolower($alipay_config['input_charset'])),
				"out_trade_no"	=> $out_trade_no,
				"subject"		=> $subject,
				"total_fee"		=> $total_fee,
				"show_url"		=> $show_url,
				//"app_pay"		=> "Y",//启用此参数能唤起钱包APP支付宝
				"body"			=> $body,

			);

			//建立请求
			$alipaySubmit = new \Vendor\Alipay\AlipaySubmit($alipay_config);
			$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
			echo $html_text;
		} 	
    }
    
    /********
    //验证签名是否正确，回调支付宝服务器，验证notify_id是否有效。
    //支付宝远程服务器ATN验证，结果$responsetTxt的结果不是true，与服务器设置问题、合作身份者ID、notify_id一分钟失效有关
	//签名结果果不是true，与安全校验码、请求时的参数格式（如：带自定义参数等）、编码格式有关
    **********/
    private function _verify($isnotify=true){
        $alipay_config=C('alipay_config_mobile');
       //计算得出通知验证结果
        $alipayNotify = new \Vendor\Alipay\AlipayNotify($alipay_config);
        $verify_result =  false;
        if($isnotify)
          $verify_result = $alipayNotify->verifyNotify();
        else
          $verify_result = $alipayNotify->verifyReturn();
          
        //file_put_contents('pay_notify.log',"检验结果:verify_result=".intval($verify_result),FILE_APPEND);  
          
        return $verify_result;
    }
    
    //记账
    private function _fee(){
           $body           = I('body');              //订单所使用的表名在这里面。
           $is_success     = I('is_success');        //成功是'T'
           $out_trade_no   = I('out_trade_no');      //商户订单号
           $trade_no       = I('trade_no');          //支付宝交易号
           $trade_status   = I('trade_status');      //交易状态
           $total_fee      = I('total_fee');         //交易金额
           $notify_id      = I('notify_id');         //通知校验ID。
           $notify_time    = I('notify_time');       //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
           $notify_type    = I('notify_type');       //trade _status_sync
           $seller_id      = I('seller_id');         //卖方ID
           $subject        = I('subject');           //商品标题
           $buyer_email    = I('buyer_email');       //买家支付宝帐号；
           $parameter = array(
             "subject"       => base64_decode($subject),
             "body"          => $body,
             "is_success"    => $is_success,
             "out_trade_no"  => $out_trade_no, //商户订单编号；
             "trade_no"      => $trade_no,     //支付宝交易号；
             "total_fee"     => $total_fee,    //交易金额；
             "trade_status"  => $trade_status, //交易状态
             "notify_id"     => $notify_id,    //通知校验ID。
             "notify_time"   => $notify_time,  //通知的发送时间。
             "buyer_email"   => $buyer_email,  //买家支付宝帐号；
           );  
           
        //file_put_contents('fee.log',implode(",",$parameter),FILE_APPEND);
		//file_put_contents('pay_notify.log',"检验结果:verify_result=".intval($verify_result),FILE_APPEND);  
           
        if ($trade_status == 'TRADE_SUCCESS' || $trade_status == 'TRADE_FINISHED') {
			   $table = $body;
			   
			//进行订单处理，并传送从支付宝返回的参数；
			$order_info = M($table)->where(array('sn'=>$out_trade_no))->find(); 
			$order_id = $order_info['id'];
					
			if(!$order_info){
				return ;// die ('FAIL');
			}
					
			if($order_info['status'] !=1){//1代表没有处理过，处理过之后已经用户加过金币，就不能再次处理了。
			   return ;//	die('FAIL');
			}
			
		
			$paid_fee =  $total_fee;
					
			// 实际支付费用要大于等于订单记录中约定的费用。
			if($paid_fee >= $order_info['money']){
						
			//file_put_contents('a.txt',$paid_fee.'MONEY',FILE_APPEND);
						
			$save['status'] = 2;
			$save['pay_time'] = NOW_TIME;
						
			switch ($table){
			    case  'order':
					M('separate_log') -> where(array('order_id'=>$order_id)) -> setField('status', 2);
					//更新用户销售业绩+等级+分拥+购买额度
					//upUser($order_info);
				    break;
				
				//如果是预存信息
				case 'agent':
					{
    				//给用户充值金额和变更代理等级
    				    $this->user = M('user')->where(array('id'=>$order_info['user_id']))->find();
    					$userData['money'] = array('exp', 'money+'.$paid_fee);
    					$save['pay_type'] = 2;
    					if(!$this->user['join_lv_time']){
    				    	$userData['join_lv_time'] = time();
    					}
    					if($this->user['lv']<$order_info['lv']){
    						$userData['lv'] = $order_info['lv'];
    					}
    					M('user')->where(array('id'=>$this->user['id']))->save($userData);
    					flog($this -> user['id'],'money',$data['total_fee']/100, 1); // 记录财务日志
    							
					}
					break;
				default:
					$this->_charge($out_trade_no,$subject,$trade_no,$notify_time);	      
				   break;
				}
						
				M($table) -> where('id='.$order_id) -> save($save);	
			
              } 
            }   
        
    }
	
	/******************************
		服务器异步通知页面方 这个接口支付宝会自动地反复通知，直到你返回它一个success
		notify_url为服务器通知，支付宝可以保证99.9999%的通知到达率，前提是您的网络通畅。
		
		notify_url: 服务器后台通知,这个页面是支付宝服务器端自动调用这个页面的链接地址,
		这个页面根据支付宝反馈过来的信息修改网站的定单状态,更新完成后需要返回一个success给支付宝.,不能含有任何其它的字符包括html语言.
		
        流 程:
        买家付完款(trade_status=WAIT_SELLER_SEND_GOODS)—>支付宝通知 notify_url—>如果反馈给支付宝的是success(表示成功,这个状态下不再反馈,如果不是继续通知,一般第一次发送和第二次发送 的时间间隔是3分钟)
        剩下的过程,卖家发货,买家确认收货,交易成功都是这个流程
	*******************************/
    public function notifyurl(){
        header("Content-type:text/html;charset=utf-8");
        if($this->_verify(true)) {
           //验证成功
                $this->_fee();
                echo "success";        //请不要修改或删除
         }else {
			//验证失败
			echo "fail";
        }    
    }
	
    
    /******************************************
     return_url为网页重定向通知，是由客户的浏览器触发的一个通知，若客户去网银支付，也会受银行接口影响，由于各种影响因素特别多，所以该种类型的通知支付宝不保证其到达率。
     页面跳转处理方法； 这个接口，由客户端完成付款后，客户端的浏览器跳转过来，只跳转一次，而且可以被客户端打断，并不可靠。
     买家付款成功后,会跳到 return_url所在的页面,这个页面可以展示给客户看,这个页面只有付款成功才会跳转,并且只跳转一次
     
    *************************/
    public function returnurl(){
           $body           = I('body');              //订单所使用的表名在这里面。
           $is_success     = I('is_success');        //成功是'T'
           $out_trade_no   = I('out_trade_no');      //商户订单号
           $trade_no       = I('trade_no');          //支付宝交易号
           $trade_status   = I('trade_status');      //交易状态
           $total_fee      = I('total_fee');         //交易金额
           $notify_id      = I('notify_id');         //通知校验ID。
           $notify_time    = I('notify_time');       //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
           $notify_type    = I('notify_type');       //trade _status_sync
           $seller_id      = I('seller_id');         //卖方ID
           $subject        = I('subject');           //商品标题
           $buyer_email    = I('buyer_email');       //买家支付宝帐号；
        
        $this->assign("subject",$subject);
        $this->assign("total_fee",$total_fee);
        
        if ($trade_status == 'TRADE_SUCCESS')
            $this->assign("trade_status","<span style='color:red'>支付成功！</span>");
        else{
            $this->assign("trade_status","<span style='color:green'>订单尚未到账。</span>");
        }
        $this->display();
	}
	
}?>