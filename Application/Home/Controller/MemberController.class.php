<?php
/***********************
 * 用户认证 充值 分享推广相关的内容，都统一放在这里来。
 * 
 * *********************/
 /*************************************************************************
    登录用户的信息汇总，从HomeContoller.class.php/_initialize()中分析得到。
    
    推广的途径有三个，代理网站 文案链接 用户分享。
    1、代理网站：
    代理的信息，存储在member表中。其中比较重要的信息是imei和memid.
    代理的网站后面，会有参数imei。如果用户通过代理网站访问主站，就会带imei参数。
    在HomeController._initialize()中，通过imei找到代理的数据member
    并且把member存储在$this->member和session('member')中。
    
    
    
    2、文案链接
    代理商可以在后台，用小说漫画的内容生成分享文案。
    文案链接的信息，存储在chapter表中。其中比较重要的信息是id、memid和对应的分享路径章节标题等等，还有阅读数量和充值数量的统计。
    如果用户是看到推广文案进来的，就会在访问链接中带chapid参数。
    在HomeController._initialize()中，通过chapid找到推广文案的信息chapter
    并且把chapter存储在$this->chapter 和  session('chapter')中。
    
    chapter包含代理商的信息memid。所以通过chapter进来的，都应该算这个代理商的用户。
    所以，会根据chapter的memid，刷新代理商数据member。原来代理网站的imei会被抵消。
    
    但是，总的来说，效果是一样的。
    通过代理网站吸引用户，和通过文案吸引用户，对代理商而言，效果相同。
    网站利于做广告跳转，文案利于做内容分享
   
    
    3、用户分享
    一般用户分享仅仅在分享链接后面加一个parent参数。parent是分享者的userid。
    在HomeController._initialize()中，不去找parent的具体信息，仅仅只是把它记录下来。
        session('parent',intval($_GET['parent']));
    注意，如果用户先后通过两个不同的分享进入，后一个分享的parent会覆盖前一个。
    
    包括代理信息也是一样，后一个会覆盖前一个。
    除非，玩家已经注册了自己的信息，而且使用已经注册信息在登录。
    
    4、自动注册和注册。
    为了方便，网站有自动注册功能。
    自动注册，包括微信公众平台获得信息来自动注册，和随机自动注册两部分。
    如果在微信环境中，就调用微信公众平台完成自动注册，如果在普通环境中，就随机自动注册。
    
    无论哪一种，都会记录下parent的信息，在新的user账户中。
    
    我打开了玩家手工注册。
    如果玩家手工注册，那么还是应该保留现有的parent信息。
    
    
    
    //登录用户信息
    $_COOKIE['uloginid'];
    $uloginid = $_COOKIE['uloginid'];
    $this->user = M('user')->find($uid);
    
    session('user',$this->user);
    
    //代理的信息
    $_GET['imei']
    session('member', $member);
    
    //推广链接信息，如果推广链接的发布者是代理，那么代理信息会被换成推广链接发布者。
    $_GET['chapid']
    session('chapter', $chapter);
    
    session('chapid', $chapter['id']);
    session('sub', $chapter['isubscribe']);
    
    //分享人的userid  .这个不应该这样单独弄出来呀，应该直接在chapter里面的。
    //意思应该是代理可以生成二维码和推广链接，分享人去分享，代理和分享人可以是分离的两个人。
    $_GET['parent']
    $user_id = decode($_GET['uid']); 给这个人发信息，他分享的小说漫画有人看到了。
    
    //上级的信息
    $_GET['parent'])
    session('parent',intval($_GET['parent']));
********************************************************************/
namespace Home\Controller;
use Think\Controller;
class MemberController extends HomeController {
	
	public function _initialize(){
		parent::_initialize();
	}
	
	//注册
	//TODO:推广链接和代理的信息，已经通过HomeController写入session，用户注册，需要把代理和推广信息也加入进去。
	public function register() {
	    
		$parent = intval( session('parent'));
		$fuid = I('fuid', $parent, 'intval');
		
		
		
		if(IS_POST){
			$username = trim($_POST['username']);
			//$mobile = trim($_POST['mobile']);
			$userpwd = xmd5(trim($_POST['userpwd']));
			$userpwdck = xmd5(trim($_POST['userpwdck']));
			if($userpwd != $userpwdck){
				//$this->sendAjax(0,'两次输入的密码不一致！');exit;
				$uu = U('Member/register');
				//echo "<script>alert('两次输入的密码不一致！');window.location.href='{$uu}'</script>";
				$arrret = array(
						'status' => 0,
						'info'		=> '两次输入的密码不一致！',
						'url'		=> $uu,
				);
				echo json_encode($arrret);exit;
			}
			$user = M('user')->where(array('username'=>"{$username}"))->find();
			if($user) {
				//$this->sendAjax(0,'用户名重复，请重新输入！');exit;
				$uu = U('Member/register');
				//echo "<script>alert('用户名重复，请重新输入！');window.location.href='{$uu}'</script>";
				$arrret = array(
						'status' => 0,
						'info'		=> '用户名重复，请重新输入！',
						'url'		=> $uu,
				);
				echo json_encode($arrret);exit;
			}
			/* $user2 = M('user')->where(array('mobile'=>"%{$mobile}%"))->find();
			if($user2) {
				//$this->sendAjax(0,'手机号重复，请重新输入！');exit;
				$uu = U('MhPublic/register');
				echo "<script>alert('手机号重复，请重新输入！');window.location.href='{$uu}'</script>";
			} */
			$ins = array(
					'nickname'	=> $username,
					'headimg'	=> '/Public/home/mhimages/'.rand(1,20).'.jpg',
					//'mobile'	=> $mobile,
					'money'     => 200,
					'vip_level'	=> 0,
					'username'	=> $username,
					'userpwd'	=> $userpwd, 
					'fid'		=> 0,
					'sub_time'	=> NOW_TIME,
					'create_time'=>NOW_TIME,
					'update_time'=>NOW_TIME,
			);
			if($fuid > 0) {
				$ins['parent1'] = $fuid;
				
				$p2 = M('user')->where("id={$fuid}")->find();
				if ($p2['parent1'] > 0) {
					$ins['parent2'] = $p2['parent1'];
				}
				if($p2['parent2'] > 0) {
					$ins['parent3'] = $p2['parent2'];
				}
			}
			$user_id = M("user")->add($ins);
			if($fuid>0 && $user_id>0) {//记录发展了三级代理各多少人。
				$agent1 = M('user')->where("parent1={$fuid}")->count();
				M('user')->where("id={$fuid}")->setField('agent1', $agent1);
				
				$p2 = M('user')->where("id={$fuid}")->find();
				if ($p2['parent1'] > 0) {
					$agent2 = M('user')->where("parent2={$p2['parent1']}")->count();
					M('user')->where("id={$p2['parent1']}")->setField('agent2', $agent2);
				}
				if($p2['parent2'] > 0) {
					$agent3 = M('user')->where("parent3={$p2['parent2']}")->count();
					M('user')->where("id={$p2['parent2']}")->setField('agent3', $agent3);
				}
			}
			$userinfo = M('user')->where("id={$user_id}")->find();
			
			$this->user = $userinfo;
			session('vip_user',$userinfo);
			session('user',$userinfo);
			session('user_id',$user_id);
			//$_COOKIE['uloginid']=rand(100,999).user_id;
			setcookie("uloginid",rand(100,999).user_id,time()+5*365*24*3600);
			//session('login_time',time());
			//$this->sendAjax(1,'注册成功',U('Mh/index'));
			//$this->success('注册成功', U('Mh/index'));
			$uu = U('Member/login');
			//echo "<script>alert('注册成功！');window.location.href='{$uu}'</script>";
			$arrret = array(
					'status' => 1,
					'info'		=> '注册成功！请登录。',
					'url'		=> $uu,
			);
			echo json_encode($arrret);exit;
			exit;
		}
		
		$this->assign('fuid', $fuid);
		$this->display();
	}
		
	//登陆
	public function login(){
		if(IS_POST){
			$username = trim($_POST['username']);
			$password = xmd5(trim($_POST['password']));
			$user = M('user')->where(array('username'=>$username))->find();
			if(!$user){
				$this->sendAjax(0,'不存在该用户');
			}else{
				//$this->sendAjax(0,$username);
				if(strcmp($password,$user['userpwd'])!=0){
					$this->sendAjax(0,'用户密码错误');
				}else{
				     
                     $this->user = $user;
                     session('user',$user);
                     session('vip_user',$user);
                     session('user_id',$user['id']);
                     setcookie("uloginid",rand(100,999).user_id,time()+5*365*24*3600);
				//	session('adminuser',$user);
					$this->sendAjax(1,'登录成功'.$user['id'],U('Member/my'));
				}
			}
			exit;
		}
		$this->display();
	}
    
	public function logout(){
		$_SESSION['vip_user'] = null;
		$_SESSION['user'] = null;
		$_SESSION['user_id'] = null;
    //只去掉登录用户的信息，保留代理信息，
        $_COOKIE['uloginid'] = null;
        $this->user = null;
        session('user',null);
    
    //保留文案的信息。这样用户重新注册账号，也不会丢失从属关系。
    // $_GET['chapid']
    // session('chapter', $chapter);
    
    // session('chapid', $chapter['id']);
    // session('sub', $chapter['isubscribe']);
    //保留上级的信息。这样用户重新注册账号，也不会丢失从属关系。
    // $_GET['parent']=null;
    // session('parent',null);		
		redirect(U('Member/login'));
	}
	
	//设置新密码
	public function password(){
	    
	    if(!$this->user)
	    {
	      	$this->error("请先用原密码登录！",U('Member/login'));  
	    }
	    
	    if(IS_POST){
    	    $username = I('post.username',0,'trim');
    	    $oldpassword = I('post.oldpassword',0,'trim');
    	    $npassword1=I('post.npassword1',0,'trim');
    	    $npassword2=I('post.npassword2',0,'trim');
    	    
    	    if($username === 0 || $oldpassword === 0 || $npassword1 === 0 ||$npassword2 === 0)
    	    {
    	        $this->error("数据不完整".$username.$oldpassword.$npassword1.$npassword1);
    	    }
    	    
    	    if(strcmp($npassword1,$npassword2)!=0)
    	    {
    	        $this->error("两次输入的密码不一致");
    	    }
    	    
    	    $oldpassword = xmd5($oldpassword);
    	    
    	    if(strcmp($username,$this->user['username'])!=0||
    	     strcmp($oldpassword,$this->user['userpwd'])!=0
    	    )
    	    {
    	        $this->error("身份认证错误");
    	    }
    	    
    	    $npassword1 = xmd5($npassword1);
    	    $this->user['userpwd'] = $npassword1;
    	    M('user')->where(array("id"=>$this->user['id']))->save(array('userpwd'=>$npassword1));
    	    
    	    $this->success("密码已经成功修改","#",10);
	    
	    }
	    
	    $this->assign('faceurl',$this->user['headimg']);
	    $this->assign('username',$this->user['username']);
		$this->display();
	}
	
	
	/****
	public function gproduct(){
		$this->display();
	}

	//检查条形码
	public function get_barcode(){
		$barcode = $_POST['barcode'];
		$normal = M('product_normal')->where(array('barcode'=>$barcode))->find();
		if(!$normal){
			$this->sendAjax(0,'输入的条形码编码不存在');
		}else{
			
			$this->sendAjax(1,$normal,U('Public/prcode',array('id'=>$normal['id'])));
		}
	}
	****/	
	//TODO：分享
	public function share(){
		//当前地址
		$id = I('get.id');
		$info = M('anime')->find(intval($id));
		if(!$info || !$id){
			$this->error('数据错误');
		}
		
		$this->assign('info',$info);
		//分享地址,无论第几章都是分享第一章开始。其实不如从小说信息页开始，或者从目录页开始。
		
		$url = complete_url(U('Index/readAnime',array('anid'=>$id,'chaps'=>1)));
		$shareUrl = $url.'&shareUser='.encode($this->user['id']);
		$shareUrl = getSinaShortUrl($shareUrl);
		$this->assign('shareUrl',$shareUrl);
		$this->display();
	}
	
	
    /**
     * 个人中心
     */
    public function my(){
    	$user = M('user')->where(array("id"=>$this->user['id']))->find();
    	
    	$asdata = array(
    			'user'	=> $user,
    	);
    	 
		//查询是否签到
		$this->assign('sign',M('sign')->where(array('date'=>date('Ymd'),'user_id'=>$this->user['id']))->find());
    	$this->assign($asdata);
    	$this->display();
    }
    
    /**
     * 我的消息
     */
    public function message_index(){
    	$cond = array();
    	$list = M('notice')->where($cond)->order('id desc')->limit(50)->select();
    	$asdata = array(
    			'list'	=> $list,
    	);
    	 
    	$this->assign($asdata);
    	$this->display();
    }
    
    /**
     * 评论消息
     */
    public function message_reply(){
    	$msgid = I('msgid',0,'intval');
    	$cond = array('id' => $msgid);
    	$info = M('notice')->where($cond)->find();

    	$asdata = array(
    			'info'	=> $info,
    	);
    	
    	$this->assign($asdata);
    	$this->display();
    }
        
    
    /**
     * 建议反馈
     */
    public function my_feedback(){
    	$this->display();
    }
    
    /**
     * 建议反馈操作
     */
    public function my_feedbackdo(){
    	$content = I('content', '', 'trim');
    	$ins = array(
    			'user_id'	=> $this->user['id'],
    			'content'	=> $content,
    			'create_time'=>NOW_TIME,
    	);
    	M('mh_feedback')->add($ins);
    	
    	$value = array(
    			'status'	=> 1,
    			'info'		=> 'mss',
    	);
    	echo json_encode($value);
    }
    
    //推广中心
    public function my_tuiguang(){
        
        
        $this->display();
    }
    
    /**
     * 客服帮助
     */
    public function help(){
    
    	$this->display();
    }
    
    /**
     * 充值
     */
    public function pay() {

    	$user_info = M('user')->where(array("user_id"=>$this->user['id']))->find();
		$paymodel = $this->_site['paymodel']?$this->_site['paymodel']:1;
		$this->assign('model',$paymodel);
    	$this->display();
    }
    
    /**
     * 充值ajax
     */
    public function pay_ajax() {   	
    	$money = I('post.money');
    	$send  = I('post.send');
		$vip = I('post.vip');

    	if(!$money) {
    		$this->error('充值金额错误！');
    	}
		$sn = $this->user['id'].date('Ymdhis').rand(10000,99999);
		//添加充值订单

		$data = array(
			'user_id' => $this->user['id'],
			'mid'=>session('member.id'),
			'sn' => $sn,
			'money' => $money,
			'smoney'=> $send,
			'dmoney' => $separate,
			'way' => $this->_yyb['name'],
			'create_time'=>time(),
			'isvip'=>$vip,
		);
		if(session('chapid')){
			$data['chapid'] = session('chapid');
		}
		
		$cid = M('charge')->add($data);
		
		//充值后，要给三级代理分，还要给加盟商分。分成的比例都是实际支付的钱数量。不存在谁的先扣掉再给其它分的情况。
		//若加盟商分80%，三级代理再分30%，那加起来超过100%了，每充值一笔，运营商要赔钱。
		//而且，还要承担支付渠道费用。
		
		/***********应该等订单支付之后，再来做分成的动作。******/
		//添加分成记录 
		$data['id'] = $cid;
		//$this->separate($data);
		
		//若有代理   ，还没有支付成功呢，就给加盟商分账？有钱吗？
		if(session('member')){
		    //判断是否需要扣量
		    $separate = session('member.separate')*$money/100;
		    $desc = session('member.declv')*$money/100;
		    $separate = $separate - $desc;				    
		    
			M('member_separate')->add(array(
				'date'=>date('Ymd'),
				'sn'=>$sn,
				'user_id' => $this->user['id'],
				'mid' => session('member.id'),
				'cid'=>$cid,
				'money' => $separate,
				'pay'=>$money,
				'create_time'=>time(),
			));
		}
		/*******************************************************/
		$paymodel = $this->_site['paymodel']?$this->_site['paymodel']:2;
		if($cid){
			if($paymodel == 1){//企业微信收款
				$jsapi_params = wxPay($cid,'charge','charge');
				//file_put_contents('log.txt',var_export($jsapi_params,true),FILE_APPEND);
				$this->success($jsapi_params);
			}elseif($paymodel == 2){//优云宝
				$gateWary="http://pay2.youyunnet.com/pay";
				$params="pid=".$this->_yyb['payid'];
				$params.="&money=".$money;
				$params.="&data=".$sn."-1";
				$params.="&url=http://".$_SERVER['HTTP_HOST'].__ROOT__.'/index.php?m=Member&a=my';
				$params.="&lb=3";
				$params.="&bk=1";
				$url = $gateWary.'?'.$params;
				$this->success($url);
			}elseif($paymodel == 3){//Payspai个人二维码收款
				$url = "https://pay.bbbapi.com/?format=json";
				$data = array(
					'uid'=>$this->_site['uid'],
					'price'=>floatval($money),
					'istype'=>2,
					'notify_url'=>"http://".$_SERVER['HTTP_HOST'].__ROOT__."/paysNotify.php",
					'return_url'=>"http://".$_SERVER['HTTP_HOST'].__ROOT__."/paysReturn.php",
					'orderid'=>$sn,
					'orderuid'=>$this->user['id'],
					'goodsname'=>"在线充值",
				);
				$str = $data['goodsname'].$data['istype']. $data['notify_url'] . $data['orderid'] . $data['orderuid'] . $data['price'] . $data['return_url'] . $this->_site['token'] . $this->_site['uid'];
				$data['key'] = md5($str);
				$return = http($url,$data);
				$json = json_decode($return,1);
				if($json['data']['qrcode']){
					$this->success(array('qrcode'=>$json['data']['qrcode'],'sn'=>$sn));
				}else{
					$this->error($json['msg']);
				 }
						
				}else if($paymodel == 4){//支付宝，送回去订单号，让客户端带订单号跳转支付宝支付地址。
					  $this->success(array('sn'=>$sn,'url'=>U('/Alipay/ali_pay',array('sn'=>$sn,'table'=>'charge'))));    	
			   }
		}
    }
	public function payChinaxing(){
		        $sn = I('post.sn');
		       $type=I('post.type');
		       $order = M('charge')->where(array('sn'=>$sn))->find();
			   if(!$order || empty($order)){
				   exit('error!');
			   }
		
			   import('Vendor.chinaxingLib.epay_submit');
			   $alipay_config=$GLOBALS['_CFG']['alipay_config'];
				$notify_url = "http://".$_SERVER['HTTP_HOST'].__ROOT__."/chinaxingNotify.php";
				//echo 	$notify_url = "http://".$_SERVER['HTTP_HOST'].__ROOT__."/chinaxingNotify.php";;exit;
				$return_url = "http://".$_SERVER['HTTP_HOST'].__ROOT__."/index.php?m=&c=Mh&a=my";
				//商品名称
				$name = "在线充值";
				//站点名称
				$sitename = '易支付';
		//构造要请求的参数数组，无需改动
		   $parameter = array(
				"pid" =>   $alipay_config['partner'],
				"type" => $type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"out_trade_no"	=>  $sn,
				"name"	=> $name,
				"money"	=> $order['money'],
				"sitename"	=> $sitename
		);
	
       //  print_r($alipay_config );exit;
	 
		//建立请求
		 $alipaySubmit = new \AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter);
		echo $html_text;
	}
	public function  payChinaxingChange(){
			$sn = I('get.sn');
		  $order = M('charge')->where(array('sn'=>$sn))->find();
		  $this->assign('info',$order);
		  $this->display();
	}
	//paysApi支付页面
	public function paysApi(){
		$sn = I('get.sn');
		$order = M('charge')->where(array('sn'=>$sn))->find();
		$this->assign('info',$order);
		$this->display();
	}
	
   public function paySend(){
        //发送客服消息
        $user_id = $this->user['id'];
        $shuser = M('user')->find(intval($user_id));
        $dd = new \Common\Util\ddwechat;
        $dd->setParam($this->_mp);
        $url = U('Member/pay');
        $url = complete_url($url);
        $html = "尊敬的" . $shuser['nickname'] . "，您有订单未支付，请尽快支付".'<a href="'.$url.'">【点击充值】</a>';
        $dd->send_msg($shuser['openid'], $html);
        $this->success('发送成功');
    }
	
	
	//ajax查询订单状态
	public function getOrderStatus(){
		if(IS_POST){
			$sn = I('post.sn');
			$charge = M('charge')->where(array('sn'=>$sn))->find();
			if($charge['status'] == 2){
				$this->success('支付成功！');
			}else{
				$this->error("还未支付！");
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	//给分享者奖励 ,这个要改，不再给分享者现金奖励。因为分享来的用户可以刷。
	//每次分享，来一个新用户，如果充值了，给1天的VIP好了。
	//配合后台的配置功能，这里记录的数据，在NotifyBaseController中处理，仅仅作为有资格领奖的依据。
	//按三级分销关系做佣金分成
	public function separate($order){
	    
		if(!is_array($order)){
			$order = M('charge') -> find(intval($order));
		}
		if(!$order){
			return;
		}
		$user = M('user');
		
		// 查询用户信息
		$user_info = $user -> find($order['user_id']);
		if(!$user_info){
			return false;
		}
		
		$dist = $this -> _dist;
		$total = $order['money'];
		// 循环分红
		for($i=1; $i<=3; $i++){
			// 检查是否设置该级分成信息
			if(empty($dist["level{$i}_per"])){
				break;
			}
			// 检查是否有这一级别的上级
			if(empty($user_info['parent'.$i]) || $user_info['parent'.$i] <1){
				break;
			}
			
			// 查询上级资料
			$parent_info = $user -> find($user_info['parent'.$i]);
			if(!$parent_info){
				break; // 这级别代理都木有就没有在上一级了，直接跳出循环
			}
			
			// 进行分红  
			$separate_money	= $total * $dist["level{$i}_per"]/100; // 分红金额
			if($separate_money>0){
				M('separate_log') -> add(array(
					'user_id' => $user_info["parent{$i}"],
					'order_id' => $order['id'],
					'self_id' => $user_info['id'],
					'level' => $i,
					'money' => $separate_money,
					'status' => 1,
					'create_time' => NOW_TIME
				));	
			}	
		}
	}
	
	
	
	/**
     * 赠送佣金
     */
    public function send_money() {
        die("功能已经取消");
    	$user_info = M('user')->where(array("user_id"=>$this->user['id']))->find();
    	
    	if(IS_POST){
    		$send_money = floatval($_POST['send_money']);
    		$send_id = intval($_POST['send_id']);
    		
			if($user_id == $send_id) {
    			$this->ajaxReturn(array('status'=>0,'info'=>'不能赠送给自己'));
    		}
			
    		$send_uinfo = M('user')->where("id={$send_id}")->find();
    		if(empty($send_uinfo)) {
    			$this->ajaxReturn(array('status'=>0,'info'=>'您输入的被赠送用户ID错误'));
    		}    		
			
    		if($send_money==''){
    			$this->ajaxReturn(array('status'=>0,'info'=>'请输入您要赠送的金额'));
    		}
    		// 检查余额是否足够
    		if($user_info['money'] < $send_money){
    			$this->ajaxReturn(array('status'=>0,'info'=>'您的余额不足'));
    		}
    		
    			if($send_money < 0.01) {
    				$this->ajaxReturn(array('status'=>0,'info'=>'赠送金额不对'));
    			}
    	
    			// 减少可用余额
    			M('user') -> where("id=".$this->user['id']) -> setDec('money',$send_money);
    			M('user') -> where("id=".$this->user['id']) -> setDec('expense',$send_money);
				M('user') -> where("id=".$send_id) -> setInc('money',$send_money);
    			M('user') -> where("id=".$send_id) -> setInc('expense',$send_money);
    			// 增加提现记录
    			$rs = M('send') -> add(array(
    					'send_user_id'	=> $this->user['id'],
    					'get_user_id'	=> $send_id,
    					'money'			=> $send_money,
    					'create_time'	=> NOW_TIME,
    			));
    			if($rs){
    				$this->ajaxReturn(array('status'=>1,'info'=>'赠送佣金成功','url'=>U('Member/my')));
    				exit;
    			} else {
    				$this->ajaxReturn(array('status'=>0,'info'=>'赠送佣金失败','url'=>U('Member/send_money')));
    				exit;
    			}
    	}
    	
    	$sdata = array(
    			'user_id'	=> $this->user['id'],
    			'user_info'	=> $user_info,
    			'user'		=> $user_info,
    	);
    	$this->assign($sdata);
    	$this->display();
    }

    //提现
    public function withdraw(){ 
        die("功能已经取消");
    	if(IS_POST){
    		$status = $_POST['status'];
    		$money = $_POST['money'];
    		$bankname = $_POST['bankname'];
    		$cardno = $_POST['cardno'];
    		$truename = $_POST['truename'];
    			
    		if($money==''){
    			$this->ajaxReturn(array('status'=>0,'info'=>'请输入您要提现的金额'));
    		}
    		// 检查余额是否足够
    		if($this->user['rmb'] < $money){
    			$this->ajaxReturn(array('status'=>0,'info'=>'您的余额不足'));
    		}
			if($money<1 || $money>10000){
				$this->ajaxReturn(array('status'=>0,'info'=>'提现的金额不对'));
			}
			// 减少可用余额
			M('user') -> where(array("id"=>$this->user['id'])) -> setDec('rmb',$money);
			// 增加提现记录
			$rs = M('withdraw') -> add(array(
					'user_id' => $this->user['id'],
					'money' => $money,
					'bank' => $truename,
					'bank_id' => 0,
					'cardno' => $cardno,
					'truename' => $truename,
					//'way' => 2, // 提现方式，1银行卡，2一件转账
					'create_time' => NOW_TIME,
					'err_msg'=>'提现申请',
					'status' => 1
			));
			if($rs){
				$this->ajaxReturn(array('status'=>1,'info'=>'申请提现成功','url'=>U('Member/my')));
				exit;
			}
    		exit;
    	}
    	//已提现
    	$this->display();
    }
    
    //提现记录
    public function withdraw_recode(){
    	$user = M('user')->where(array("id"=>$this->user['id']))->find();
    	
    	$page = $_POST['p']?$_POST['p']:1;
    	$pagesize = 5;
    	$stat = ($page-1)*$pagesize;
    	$where['user_id'] = $this->user['id'];
    	$where['status'] = 3;
    	$count =M('withdraw')->where($where)->count();
    	$list = M('withdraw')->where($where)->order('id desc')->limit($stat,$pagesize)->select();
    	$page_list = ceil($count/$pagesize);
    
    	$html = '';
    
    	if(!$list){
    		if($page==1){
    			$html.='<li>无提现记录 <span class="f_r"></span></li>';
    			$this->ajaxReturn(array('status'=>1,'info'=>$html,'page_list'=>$page_list));
    		}else{
    			$this->ajaxReturn(array('status'=>0,'info'=>'已全部加载完成','page_list'=>$page_list));
    		}
    	}else{
    		foreach($list as $k=>$v){
    			$html.='<li>'.date('Y-m-d H:i:s',$v['create_time']).' 提现 <span class="f_r">'.$v['money'].'元</span></li>';
    		}
    		$this->ajaxReturn(array('status'=>1,'info'=>$html,'page_list'=>$page_list));
    	}
    }
	
		//推广二维码
	public function qrcode(){
		$this->assign('img',$this->getQrcode());
		$this->display();
	}
	
	//用PHP直接构建二维码
	public function getQrcode(){
		include COMMON_PATH.'Util/phpqrcode/phpqrcode.php';
		// 忽略用户取消，限制执行时间为90s
		ignore_user_abort();
		set_time_limit(90);
		//获取推广码信息
		$path_info = get_user_qrcode($this -> user['id']);
		// 目录不存在则创建
		if(!is_dir($path_info['path'])){
			mkdir($path_info['path'], 0777,1);
		}
		if(!is_file($path_info['qrcode'])){
			$uid = encode($this->user['id']);
			//$url = "http://".$_SERVER['HTTP_HOST'].__ROOT__."/index.php?m=&c=Index&a=index&shareUser=".$uid;
			//在分享的地址后面加上分享者的信息。会在HomeController.class.php的初始化程序解读。
			//在MemberController.class.php的注册函数中，也会解读记录分享者的信息。
			$url = U('Mh/index',array('parent'=>$uid));
			
			$errorCorrectionLevel = 'L';
			$matrixPointSize = 6;
			\QRcode::png($url, $path_info['qrcode'], $errorCorrectionLevel, $matrixPointSize, 2);	
		}

		//合成背景文字和头像
		$bj = $this->_site['sharepic'];
		$QR = $path_info['qrcode'];
		if($bj !== FALSE)
		{					
			$QR = imagecreatefromstring(file_get_contents($QR));
			$logo = imagecreatefromstring(file_get_contents($bj));

			$QR_width = imagesx($QR);
			$QR_height = imagesy($QR);
			// 合成二维码
			imagecopyresampled($logo , $QR , 350, 1070, 0, 0, $QR_width*1.65,$QR_height*1.65, $QR_width, $QR_height);
			imagejpeg($logo, $path_info['new']);
			imagedestroy($logo);
			imagedestroy($QR);
		}
		return $path_info['new'];
	}
	
	/****
	public function qrcode(){
		$this->assign('img',$this->get_qrcode());
		$this->display();
	}
	**/
    
    //用微信的API构建二维码。
	public function get_qrcode(){
		header("Content-type: image/jpeg");
		
		// 忽略用户取消，限制执行时间为90s
		ignore_user_abort();
		set_time_limit(90);
		
		$path_info = get_qrcode_path($this -> user);
		
		// 已生成则直接返回
		if(is_file($path_info['new'])){
			echo file_get_contents($path_info['new']);
			exit;
		}
		
		// 目录不存在则创建
		if(!is_dir($path_info['path'])){
			mkdir($path_info['path'], 0777,1);
		}
		
		$dd = new \Common\Util\ddwechat($this -> _mp);
		
		if(!is_file($path_info['qrcode'])){
		
			
			$accesstoken = $dd -> getaccesstoken();
			$rs = $dd -> createqrcode('user_'.$this -> user['id'],null,$accesstoken);
			if(!$rs){
				if(APP_DEBUG){
					$this -> error($dd -> errmsg);
				}else{
					$this -> error('推广二维码生成失败，请稍后重试！');
				}
			}
			
			$qrcode_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$rs['ticket'];
			$qrcode_img = $dd -> exechttp($qrcode_url, 'get', null , true); //file_get_contents($qrcode_url);
			if(!$qrcode_img){
				$this -> error('获取二维码失败');
			}
			
			// 保存图片	
			$save = file_put_contents($path_info['qrcode'],$qrcode_img);

			if(!$save){
				$this -> error('二维码保存失败！');
			}
		}
		// 合成
		$im_dst = imagecreatefromjpeg("/Public/images/tpl.jpg");
		$im_src = imagecreatefromjpeg($path_info['qrcode']);
		
		// 合成二维码（二维码大小282*282)
		imagecopyresized ( $im_dst, $im_src,204, 587, 0, 0, 231, 231, 430, 430);		
		// 保存
		imagejpeg($im_dst, $path_info['new']);
		// 销毁
		imagedestroy($im_src);
		imagedestroy($im_dst);
		return $path_info['new'];
	}
    
    //我的班级米粒
    public function myTeam(){
    	$user = M('user')->where(array("id"=>$this->user['id']))->find();
    	
    	$asdata = array(
    			'user'	=> $user,
    	);
    	$this->assign($asdata);
    	$this->display();
    }
    
    //获取我的班级米粒信息
    public function getTeam(){
    	$user = M('user')->where(array("id"=>$this->user['id']))->find();
    	
    	$status = I('post.status');
    	$page = I('post.page')?I('post.page'):1;
    	$pagesize = 5 ;
    	$start = ($page-1)*$pagesize;
    	$where[$status] = $user['id'];
    	$list = M('user')->where($where)->order('id desc')->limit($start,$pagesize)->select();
    	$this->assign('list',$list);
    	$this->assign('page',$page);
    	$this->assign('current_user_id', $user['id']);
    	$this->assign('type',I('post.type'));
    	$html = $this->fetch();
    	if(!$list){
    		$this->error($html);
    	}else{
    		$this->success($html);
    	}
    }
    
    //下级学员查看
    public function TeamL(){
    	$this->display();
    }	
	
	 
   public function sign(){
	   if(IS_POST){
		   if($this->_site['sign'] == 0 || !$this->_site['sign']){
			   $this->error('未开启签到功能');
		   }
		   $date = date('Ymd');
		   $sign = M('sign')->where(array('date'=>$date,'user_id'=>$this->user['id']))->find();
		   if($sign){
			   $this->error('今日已签到!');
		   }else{
				$id = M('sign')->add(array(
					'user_id'=>$this->user['id'],
					'date'=>$date,
					'money'=>$this->_site['sign'],
					'create_time'=>NOW_TIME,
				));
				if($id){
					M('user')->where(array('id'=>$this->user['id']))->setInc('money',$this->_site['sign']);
					flog($this->user['id'], 'money', $this->_site['sign'], 10);
					$dd = new \Common\Util\ddwechat;
					
					//浏览记录
					$a = "\n";
					$read = M('read')->where(array('user_id'=>$this->user['id']))->order('create_time desc')->find();
					if($read){
						if($read['type'] == "mh"){
							$url = U('Mh/inforedit',array('mhid'=>$read['rid'],'ji_no'=>$read['episodes']));
						}else{
							$url = U('Book/inforedit',array('bid'=>$read['rid'],'ji_no'=>$read['episodes']));
						}
						$url = complete_url($url);
						$a = "\n\n".'<a href="'.$url.'">点击我继续上次阅读</a>'."\n\n";
					}
					
					//历史阅读记录
					$li = "历史阅读记录\n\n";
					$lishi = M('read')->distinct(true)->field('type,rid')->where(array('id'=>array('neq',$read['id']),'user_id'=>$this->user['id']))->select();
					if($lishi){
						foreach($lishi as $v){
							$max = M('read')->where(array('type'=>$v['type'],'rid'=>$v['rid']))->order('episodes desc')->find();
							if($read['type'] == "mh"){
								$url = U('Mh/inforedit',array('mhid'=>$max['rid'],'ji_no'=>$max['episodes']));
							}else{
								$url = U('Book/inforedit',array('bid'=>$max['rid'],'ji_no'=>$max['episodes']));
							}
							$url = complete_url($url);
							$li .= '<a href="'.$url.'">>'.$max['title'].'</a>'."\n\n";
						}
					}else{
						$li ="";
					}
					
					$html = '本次签到成功，赠送'.$this->_site['sign'].'书币，请明天继续签到哦!'.$a.$li.'为方便下次阅读，请置顶公众号';
					$dd -> send_msg($this->user['openid'],$html);
					$this->success('签到成功');
				}else{
					$this->error('签到失败');
				}
		   }
	   }else{
		   $this->error('非法请求!');
	   }
   }
  
 	private function _getChargeConfig($money){
	   $conf = $this->_charge;
	   foreach ($conf as $v){
		   if($v['money']==$money)
			   return $v;
	   }
      return null;
	}  
 
	   //获取账单记录
   public function getRecord(){
	   if(IS_POST){
		   $model = I('post.model');
		   $page = intval(I('post.page'));
		   if($page<=1) $page = 1;
		   $size = 20;
		   $start =($page-1)*$size;
		   $end = ($page)*$size;
		   $list =array();

		   
		  
           switch (intval($model)) {
                case 1:
                    {
                    $list = M('charge')->where(array('user_id'=>$this->user['id'],'status'=>2))->order('create_time desc')->limit($start,$size)->select();  //->limit($start,$size)
    				foreach($list as $k=>$v){
						$rule = $this->_getChargeConfig($v['money']);
						if($v['isvip']==0)
    					$list[$k]['money'] = $v['money']*$this->_site['rate']+$v['smoney'];//买书币各种充值都有大量赠送。
						else
						$list[$k]['money'] = $v['isvip']; //买VIP的，就只有赠送 
					 
    					$list[$k]['time'] = date('Y-m-d H:i:s',$v['create_time']);
    				}}
                    break;
                case 2:
                    {
                    $list = M('sign')->where(array('user_id'=>$this->user['id']))->order('create_time desc')->limit($start,$size)->select();
    				foreach($list as $k=>$v){
    					$list[$k]['time'] = date('Y-m-d H:i:s',$v['create_time']);
    				}}
                    break;
                case 3:
                    {
                    $list = M('reward_task')->where(array('user_id'=>$this->user['id']))->order('create_time desc')->limit($start,$size)->select();
    				foreach($list as $k=>$v){
    				    if(0<$list[$k]['days']){
    				       $list[$k]['isvip']=$list[$k]['days'];
    				       $list[$k]['money']=$list[$k]['days'];
    				    }
    					$list[$k]['time'] = date('Y-m-d H:i:s',$v['create_time']);
    				}}
                    break;
                case 0:
                    {
                     
                    $list = M('read_charge')->where(array('user_id'=>$this->user['id']))->order('create_time desc')->limit($start,$size)->select();
                    //$this->error('进来了'.sizeof($list)."userid=".$this->user['id']);
                    foreach($list as $k=>$v){
    					$list[$k]['time'] = date('Y-m-d H:i:s',$v['create_time']);
    				}}
                    break;
           }
            
		   if(sizeof($list)>0){ 
		       
		       $this->success($list);
		   
		       
		   }else{
			   if($page == 1){
				   $this->error('没有数据哟~');
			   }else{
				   $this->error('已加载完所有数据');
			   }
		   }
	   }else{
		   $this->error('非法请求！');
	   }
   }

	//对漫画和小说打赏AJAX
	public function mxSend(){
		if(IS_POST){
			$post = I('post.');
			$money = $this->_send[$post['sid']]['money'];
			if($money>$this->user['money']){
				$this->error('您的书币不足,是否立即去充值!',U('Member/pay'));
			}else{
				if(M('user')->where(array('id'=>$this->user['id']))->setDec('money',$money)){
					flog($this->user['id'], 'money', 0-$money, 12);
					$post['user_id'] = $this->user['id'];
					$post['headimg'] = $this->user['headimg'];
					$post['nickname'] = $this->user['nickname'];
					$post['create_time'] = date('Y-m-d H:i:s');
					$post['pic'] = $this->_send[$post['sid']]['pic'];
					$post['money'] = $this->_send[$post['sid']]['money'];
					M('mxsend')->add($post);
					if($post['type'] == "mh"){
						M('mh_list')->where(array('id'=>$post['mxid']))->setInc('send',$money);
					}else{
						M('book')->where(array('id'=>$post['mxid']))->setInc('send',$money);
					}
					$this->success('打赏成功！');
				}else{
					$this->error('数据错误!');
				}
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	//加载小说或漫画的打赏记录
	public function LoadSend(){
		if(IS_POST){
			$mxid = I('post.mxid');
			$page = I('post.page');
			$type = I('post.type');
			$size = 10;
			$start = ($page -1) * $size;
			
			$list = M('mxsend')->where(array('mxid'=>$mxid,'type'=>$type))->order('create_time desc')->limit($start,$size)->select();
			if($list){
				$this->success($list);
			}else{
				if($page !=1){
					$this->error('没有更多的打赏记录了哟~！',M()->getLastSql());
				}else{
					$this->error('');
				}
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	
	//举报小说漫画
	public function jubao(){
		$rid = I('get.rid');
		$type = I('get.type');
		if(!$rid || !$type){
			$this->error('参数错误！');
		}
		if($type == "xs"){
			$db = M('book');
		}else{
			$db = M('mh_list');
		}
		$info = $db->find(intval($rid));
		if(!$info){
			$this->error('信息错误！');
		}
		if(IS_POST){
			$jid = I('post.jid');
			if($jid == "seqing"){
				$save = array(
					"seqing"=>array("exp","seqing+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"seqing"=>1,
					"nums"=>1,
					"rid"=>$rid,
					"type"=>$type,
					"title"=>$info['title'],
				);
			}
			if($jid == "xuexing"){
				$save = array(
					"xuexing"=>array("exp","xuexing+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"xuexing"=>1,
					"nums"=>1,
					"rid"=>$rid,
					"type"=>$type,
					"title"=>$info['title'],
				);
			}
			if($jid == "baoili"){
				$save = array(
					"baoili"=>array("exp","baoili+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"baoili"=>1,
					"nums"=>1,
					"rid"=>$rid,
					"type"=>$type,
					"title"=>$info['title'],
				);
			}
			if($jid == "weifa"){
				$save = array(
					"weifa"=>array("exp","weifa+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"weifa"=>1,
					"nums"=>1,
					"rid"=>$rid,
					"type"=>$type,
					"title"=>$info['title'],
				);
			}
			if($jid == "daoban"){
				$save = array(
					"daoban"=>array("exp","daoban+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"daoban"=>1,
					"nums"=>1,
					"rid"=>$rid,
					"type"=>$type,
					"title"=>$info['title'],
				);
			}
			if($jid == "qita"){
				$save = array(
					"qita"=>array("exp","qita+1"),
					"nums"=>array("exp","nums+1"),
				);
				$add = array(
					"qita"=>1,
					"nums"=>1,
					"rid"=>$rid,
					"type"=>$type,
					"title"=>$info['title'],
				);
			}
			if(M('jubao')->where(array('rid'=>$rid,'type'=>$type))->find()){
				M('jubao')->where(array('rid'=>$rid,'type'=>$type))->save($save);
			}else{
				M('jubao')->add($add);
			}
			$this->success("举报成功！");
		}
		$url = get_current_url();
		$this->assign('list',C('JUB'));
		$this->assign('url',$url);
		$this->display();
	}   
/*****	
	public function cultrue(){
		$this->display();
	}

	//绑定手机号（没有用短信检测) 现在被改成登录了。输入的手机号当作用户名。
	public function binding(){
		if(IS_POST){
			$username = trim($_POST['mobile']);
			$password = xmd5(trim($_POST['pass']));
			$fr = trim($_POST['fr']);
			$user = M('user')->where("username='{$username}'")->find();
			if(!$user){
				//$this->sendAjax(0,'不存在该用户');
				$uu = U('Member/login');
				//echo "<script>alert('不存在该用户！');window.location.href='{$uu}'</script>";
				$arrret = array(
						'status' 	=> 0,
						'info'		=> '不存在该用户！',
						'url'		=> $fr,
				);
				echo json_encode($arrret);exit;
			}else{
				if($password != $user['userpwd']){
					//$this->sendAjax(0,'用户密码错误');
					$uu = U('Member/login');
					//echo "<script>alert('密码错误！');window.location.href='{$uu}'</script>";
					$arrret = array(
							'status' 	=> 0,
							'info'		=> '密码错误！',
							'url'		=> $fr,
					);
					echo json_encode($arrret);exit;
				}else{
					session('vip_user',$user);
					session('user',$user);
					session('user_id',$user['id']);
					//session('login_time',time());
					//$this->sendAjax(1,'登录成功',U('Mh/index'));
					$uu = U('Mh/my');
					//echo "<script>window.location.href='{$uu}'</script>";
					$arrret = array(
							'status' => 1,
							'info'		=> '绑定成功！',
							'url'		=> $fr,
					);
					echo json_encode($arrret);exit;
				}
			}
			exit;
		}
		$this->display('Member/login');
	}
    ****/	
 /**************************	
	//获取员工之家的最新信息
	public function getCultrue(){
		$page = $_POST['p']?$_POST['p']:1;
		$pagesize = 15;
		$start = ($page-1)*$pagesize;
		$list = M('cultrue')->order('create_time desc')->limit($start,$pagesize)->select();
		$count =M('cultrue')->count();
		$page_list = ceil($count/$pagesize);
		$html='';
		if($list){
			foreach($list as $k=>$v){
				
				$html.='<a href="'.U('Public/cultrue_info',array('id'=>$v['id'])).'">';
				$html.='<li>'.$v['title'];
				$html.='</li>';
				$html.='</a>';

			}
			$this->ajaxReturn(array('status'=>1,'info'=>$html,'page_list'=>$page_list));			
		}else{
			if($page == 1){
				$html.='<li>无记录</li>';
				$this->ajaxReturn(array('status'=>1,'info'=>$html,'page_list'=>$page_list));	
			}else{
				$html.='<li>没有更多记录</li>';
				$this->ajaxReturn(array('status'=>0,'info'=>'已经没有更多数据了'));	
			}
			
		}
	}
	
	public function cultrue_info(){
		$id = $_GET['id'];
		$this->assign('cultrue',M('cultrue')->where(array('id'=>$id))->find());
		$this->display();
	}
	
	
	//合成图片
	public function prcode(){
		$id = $_GET['id'];
		if(!M('product_normal')->where(array('id'=>$id))->find()){
			$this->error('不存在该正品溯源');
			exit;
		}
		$this->assign('id',$id);
		$this->display();
	}
	
	// 显示/获取推广二维码图片
	public function get_prcode($id){
		header("Content-type: image/jpeg");
		// 忽略用户取消，限制执行时间为90s
		ignore_user_abort();
		set_time_limit(90);
		$path_info = get_prcode_path($id);
		
		// 已生成则直接返回
		if(is_file($path_info['new'])){
			echo file_get_contents($path_info['new']);
			exit;
		}
		
		// 目录不存在则创建
		if(!is_dir($path_info['path'])){
			mkdir($path_info['path'], 0777,1);
		}
		$normal = M('product_normal')->where(array('id'=>$id))->find();
		// 合成
		$im_dst = imagecreatefromjpeg("/Public/wine/images/sb.jpg");

		$color = ImageColorAllocate($im_dst, 0,0,0);
		// 合成品名
		$title = '品名：'.$normal['name'];
		$rs1 = imagettftext($im_dst, '25', 0, 100, 550, $color, '/Public/font/simhei.ttf',  $title);
		//装柜价
		$price = '装柜价：'.$normal['price'].'元';
		$rs2 = imagettftext($im_dst, '25', 0, 100, 590, $color, '/Public/font/simhei.ttf',  $price);
		//酒精度
		$alc = '酒精度：'.$normal['alc'];
		$rs3 = imagettftext($im_dst, '25', 0, 100, 630, $color, '/Public/font/simhei.ttf',  $alc);
		//净含量
		$weight = '净含量：'.$normal['weight'];
		$rs4 = imagettftext($im_dst, '25', 0, 330, 630, $color, '/Public/font/simhei.ttf',  $weight);
		//生产许可证号：
		$cardno = '生产许可证号：'.$normal['cardno'];
		$rs5 = imagettftext($im_dst, '25', 0, 100, 670, $color, '/Public/font/simhei.ttf',  $cardno);
		//原产地：
		$address = '原产地：'.$normal['address'];
		$rs6 = imagettftext($im_dst, '25', 0, 100, 710, $color, '/Public/font/simhei.ttf',  $address);
		//基酒储存日期：
		$ymonth = '基酒储存日期：'.date('Y-m-d',$normal['ymonth']);
		$rs7 = imagettftext($im_dst, '25', 0, 100, 750, $color, '/Public/font/simhei.ttf',  $ymonth);
		//包装日期：
		$packdate = '包装日期：'.date('Y-m-d',$normal['packdate']);
		$rs8 = imagettftext($im_dst, '25', 0, 100, 790, $color, '/Public/font/simhei.ttf',  $packdate);
		//出厂日期：
		$outdate = '出厂日期：'.date('Y-m-d',$normal['outdate']);
		$rs9 = imagettftext($im_dst, '25', 0, 100, 830, $color, '/Public/font/simhei.ttf',  $outdate);
		
		//合成酒图片
		$im_src0 = imagecreatefromjpeg($normal['pic']);
		imagecopyresized ($im_dst, $im_src0,650, 560, 0, 0, 300, 300, 300, 300);
		//合成条形码1
		$im_src1 = imagecreatefromjpeg($normal['bar1']);
		imagecopyresized ($im_dst, $im_src1,45, 1150, 0, 0, 430, 300, 430, 300);
		//合成条形码2
		$im_src2 = imagecreatefromjpeg($normal['bar2']);
		imagecopyresized ($im_dst, $im_src2,522, 1150, 0, 0, 430, 300, 430, 300);
		
		//检酒员姓名
		$wine_name = '姓名：'.$normal['wine_name'];
		$rs10 = imagettftext($im_dst, '25', 0, 50,1950, $color, '/Public/font/simhei.ttf',  $wine_name);
		//包装员姓名
		$pack_name = '姓名：'.$normal['pack_name'];
		$rs11 = imagettftext($im_dst, '25', 0, 530,1950, $color, '/Public/font/simhei.ttf',  $pack_name);
		//检酒员身份证
		$wine_card = '身份证：'.$normal['wine_card'];
		$rs12 = imagettftext($im_dst, '25', 0, 50,1990, $color, '/Public/font/simhei.ttf',  $wine_card);
		//包装员身份证
		$pack_card = '身份证：'.$normal['pack_card'];
		$rs13 = imagettftext($im_dst, '25', 0, 530,1990, $color, '/Public/font/simhei.ttf',  $pack_card);
		//存储坛以及图片
		$arr1 = explode('</p>',$normal['storage']);
		$height = 2200;
		foreach($arr1 as $k=>$v){
			if($k==0){
				$width = 460;
			}else{
				$width = 400;
			}
			$v = str_replace('<br/>','',$v);
			$v = str_replace('<p>','',$v);
			$v = str_replace('&nbsp;','',$v);
			$kk = imagettftext($im_dst, '25', 0, $width,$height, $color, '/Public/font/simhei.ttf',$v);
			$height = $height+40;
		}
		
		//合成酒坛
		$im_src3 = imagecreatefromjpeg($normal['storage_pic']);
		imagecopyresized ($im_dst, $im_src3,60, 2130, 0, 0, 300, 350, 300, 350);
		
		//简介
		$arr2 = explode('</p>',$normal['remark']);
		$height = 2680;
		foreach($arr2 as $k=>$v){
			if($k==0){
				$width = 160;
			}else{
				$width = 100;
			}
			$v = str_replace('<br/>','',$v);
			$v = str_replace('<p>','',$v);
			$v = str_replace('&nbsp;','',$v);
			$kk = imagettftext($im_dst, '25', 0, $width,$height, $color, '/Public/font/simhei.ttf',  $v);
			$height = $height+40;
		}
		
		// 保存
		imagejpeg($im_dst, $path_info['new']);
		
		// 输出
		imagejpeg($im_dst);
		
		// 销毁
		imagedestroy($im_src0);
		imagedestroy($im_src1);
		imagedestroy($im_src2);
		imagedestroy($im_src3);
		imagedestroy($im_dst);
	}

	//绑定微信账户
    public function binding1(){
        if(IS_POST) {
            $wxtel = trim($_POST['wxtel']);
            $wxpassword= trim($_POST['wxpassword']);
            $fr = trim($_POST['fr']);
            $user = M('user')->where(array(['wxtel'=>$wxtel,'wxpassword'=>$wxpassword]))->find();

            if(!$user){
                $arrret = array(
                    'status' 	=> 0,
                    'info'		=> '不存在该用户！',
                    'url'		=> $fr,
                );
                echo json_encode($arrret);exit;
            }else{

                    session('vip_user',$user);
                    session('user',$user);
                    session('user_id',$user['id']);
                    //session('login_time',time());
                    //$this->sendAjax(1,'登录成功',U('Mh/index'));
                    $uu = U('Mh/my');
                    //echo "<script>window.location.href='{$uu}'</script>";
                    $arrret = array(
                        'status' => 1,
                        'info'		=> '登陆成功！',
                        'url'		=> $uu,
                    );
                    echo json_encode($arrret);exit;

            }
            exit;
        }
        $this->display();
    }
    ************************/
	

}