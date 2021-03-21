<?php
/****

*****/
namespace Home\Controller;
use Think\Controller;
class NotifyBaseController extends Controller {
	public function _initialize(){
		// 加载配置 这个控制器是由第三方充值服务器调用起来的，所以没有imei和chapid等信息。
		$config = M('config') -> select();
		if(!is_array($config)){
			die('请先在后台设置好各参数');
		}
		foreach($config as $v){
			$key = '_'.$v['name'];
			$this -> $key = unserialize($v['value']);
			$_CFG[$v['name']] = $this -> $key;
		}
		$GLOBALS['_CFG'] = $_CFG;
	}
	
	private function _getChargeConfig($money){
	   $conf = $this->_charge;
	   foreach ($conf as $v){
		   if($v['money']==$money)
			   return $v;
	   }
      return null;
	}
	
	//给分享者奖励 ,这个要改，不再给分享者现金奖励。因为分享来的用户可以刷。
	//每次分享，来一个新用户，如果充值了，给1天的VIP好了。
	private function _give_money_2_sharer($order_id){
		//给用户奖励。
		$logs = M('separate_log')->where(array('order_id'=>$order_id,'status'=>1))->select();
		if($logs){
			foreach((array)$logs as $v){
				//M('user') -> where('id='.$v['user_id']) -> save(array(
				//	'rmb' => array('exp', 'rmb+'.$v['money']),
				//));
				M('reward_task')->add(
				  array(
				    'user_id'=>$v['id'],
					'days'=>0,  //奖励1天VIP 用户要去消费清单中领取。或者去任务中心领取。任务中心设计三种任务：分享充值用户得VIP天数，点击广告得书币，签到得书币。奖励的内容都记录在reward_record中。
					'money'=>200, //奖励200书币  
					'statu'=>1, //状态 1尚未领取，0已经领取。
					'create_time'=>time()
				  )
				);
				M('separate_log')->where(array('id'=>$v['id']))->save(array('status'=>4));
				//flog($v['user_id'], 'money', $v['money'],3);
			}
		}
		
	}
	
	//给加盟代理商奖励
	private function _give_money_2_member($mid,$cid){
		
		return;//暂时不考虑加盟商
		
		if($mid){
			$member = M('member')->where(array('id'=>$mid))->find();
		}
		if($member){
			//更新分成状态
			M('member_separate')->where(array('cid'=>$id))->save(array('status'=>2,'pay_time'=>NOW_TIME));
			//添加分成佣金到代理账户
			$msep = M('member_separate')->where(array('cid'=>$id))->find();
			M('member')->where(array('id'=>$msep['mid']))->save(array(
				'money' => array('exp', 'money+'.$msep['money']),
			));	
		}


	}
    
    /***
     * 用户IP ,充值元 ，赠送币,vip时长(天)
     * *///
	private function _give_money($userid,$money,$send,$gvip){
		//$rule = $this->_getChargeConfig($money);
		//if($rule == null ) $this->error_log("找不到对应的付费项目:".$money);
		
		
		//$gmoney = $rule['send'];
		//$gvip = $rule['isVIP'];
		$gmoney = $send;
		$user = M('user')->where(array('id'=>$userid))->find();
		
		$stime = $user['vip_s_time'];
		$etime = $user['vip_e_time'];
		
		
		if(0 == $gvip){
		//说明买的是书币，要把钱换成书币，加入送的书币中。
			$gmoney = $gmoney + $money * $this->_site['rate'];
			
		}else {	
		//说明买的是VIP时间，开始算时间长度。
		    $now = time();
		    
		    if($user['vip_e_time']<$now)
			  $stime = $now;
			else//这种情况是用户还有VIP时间，他要延长时间。
			  $stime = $user['vip_e_time'];
			
			$etime = $stime + $gvip * 24 * 60 * 60 ;//商品中表明的是天，换算成秒
			$stime = $now;
		}
		
		$timestr = date('Y-m-d H:i',$etime);
		echo("<br>给{$userid}加币{$gmoney},gvip为{$gvip},uservip为{$user['vip']}，结束时{$stime}间{$etime}是{$timestr}<br>");
		$ok   = M('user')->where(array('id'=>$userid))->save(array(
							'money'=>$gmoney+$user['money'],
							'vip'=>($gvip+$user['vip']>0 ?1:0),
							'vip_s_time'=>$stime,
							'vip_e_time'=>$etime,
							'btotal'=>$money+$user['btotal']//记录此用户生命周期的全部充值
						));
		//不要覆盖掉原来的VIP信息和书币信息，只能加。
		
	}
	

	//订单完成充值后，分钱。
    //$params
    //$sn 在本站的订单号
    //$remark 标注
    //$payno 在支付服务器的订单号
    //$paytime 充值完成的时间（与充值服务器同步） 	
	public function _charge($sn,$remark,$paysn,$paytime){
	 //首先，根据money去充值项目表中，找对应的充值项目，
	 //读出需要充值多少币，送多少币，加多长时间的VIP。
	 
	 //把订单状态改成“2 已支付”。
		 $charge =  M('charge')->where(array('sn'=>$sn))->find();
		 if($charge == null ) return false;
		
		 if($charge['status'] == 1){
				$money = $charge['money'];//金额 
				$gvip  = $charge['isvip'];//vip时长
				$send  = $charge['smoney'];//赠送的币
				$result = M('charge')->where(array('sn'=>$sn))->save(array(
					'pay_time' => $paytime,
					'remark' => $remark,
					'paysn'=>$paysn,
					'status' => 2,
					));	
					
			//找到对应的充值用户，给用户加币=moneyx汇率+送币 加VIP时间，设置用户身份为VIP。
			$userid = $charge['user_id'];
			
			//拿到手的money，开始分钱。
			//根据加盟商memberid，分钱。
			//按用户的上级分享者，发奖。
			$this->_give_money($userid,$money,$send,$gvip);
			
			//记录日志
			flog($userid, "money", $money, 1); 
			
			//新增如果有文案推广，增加文案推广的充值金额
			if($charge['chapid']>0){
				M('chapter')->where(array('id'=>$charge['chapid']))->setInc(
							'charge',$money
						);
			}

			$this->_give_money_2_member($charge['mid'],$charge['id']);
			$this->_give_money_2_sharer($charge['id']);
			
		 } 
		 
     //status其余的状态不用理睬，因为可以是充值服务器的多次调用。
 	 return true;	 
	 

	}


	
}?>
