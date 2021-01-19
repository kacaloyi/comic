<?php
namespace Admin\Controller;
use Think\Controller;
class CenterController extends AdminController {
   
    //用户数据
	public function users(){
	    
		//今日用户数
		$tuser['all'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d')))))->count();
		//今日男性用户
		$tuser['nuser'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'sex'=>1))->count();
		//今日女性用户
		$tuser['vuser'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'sex'=>2))->count();
		//今日未知性别用户
		$tuser['wuser'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'sex'=>array('not in','1,2')))->count();
		//今日已关注用户
		$tuser['subuser'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'subscribe'=>1))->count();
		//今日付费用户
		$tuser['payuser'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'btotal'=>array('gt',0)))->count();
		//渲染数据
		$this->assign('tuser',$tuser);
		
		/**今日统计结束**/
		
		$etime = strtotime('today');
		$stime = $etime - 86400;
		//昨日用户数
		$yuser['all'] = M('user')->where(array('create_time'=>array(array('egt',$stime),array('elt',$etime))))->count();

		//昨日男性用户
		$yuser['nuser'] = M('user')->where(array('create_time'=>array(array('egt',$stime),array('elt',$etime)),'sex'=>1))->count();
		//昨日女性用户
		$yuser['vuser'] = M('user')->where(array('create_time'=>array(array('egt',$stime),array('elt',$etime)),'sex'=>2))->count();
		//昨日未知性别用户
		$yuser['wuser'] = M('user')->where(array('create_time'=>array(array('egt',$stime),array('elt',$etime)),'sex'=>array('not in','1,2')))->count();
		//昨日已关注用户
		$yuser['subuser'] = M('user')->where(array('create_time'=>array(array('egt',$stime),array('elt',$etime)),'subscribe'=>1))->count();
		//昨日付费用户
		$yuser['payuser'] = M('user')->where(array('create_time'=>array(array('egt',$stime),array('elt',$etime)),'btotal'=>array('gt',0)))->count();
		//渲染数据
		$this->assign('yuser',$yuser);
		
		/**昨日统计结束**/
		
		//本月用户数
		$muser['all'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-01')))))->count();
		//本月男性用户
		$muser['nuser'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-01'))),'sex'=>1))->count();
		//本月女性用户
		$muser['vuser'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-01'))),'sex'=>2))->count();
		//本月未知性别用户
		$muser['wuser'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-01'))),'sex'=>array('not in','1,2')))->count();
		//本月已关注用户
		$muser['subuser'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-01'))),'subscribe'=>1))->count();
		//本月付费用户
		$muser['payuser'] = M('user')->where(array('create_time'=>array('egt',strtotime(date('Y-m-01'))),'btotal'=>array('gt',0)))->count();
		//渲染数据
		$this->assign('muser',$muser);
		
		/**本月统计结束**/
		
		//所有用户数
		$auser['all'] = M('user')->count();
		//所有男性用户
		$auser['nuser'] = M('user')->where(array('sex'=>1))->count();
		//所有女性用户
		$auser['vuser'] = M('user')->where(array('sex'=>2))->count();
		//所有未知性别用户
		$auser['wuser'] = M('user')->where(array('sex'=>array('not in','1,2')))->count();
		//所有已关注用户
		$auser['subuser'] = M('user')->where(array('subscribe'=>1))->count();
		//所有付费用户
		$auser['payuser'] = M('user')->where(array('btotal'=>array('gt',0)))->count();
		//渲染数据
		$this->assign('auser',$auser);
		
	
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		$time1 = str_replace("-","",$_GET['time1']);
		$time2 = str_replace("-","",$_GET['time2']);
		if(!empty($_GET['time1']) && !empty($_GET['time2'])){
			$where['date'] = array(
				array('egt', $time1),
				array('elt', $time2)
			);
		}
		elseif(!empty($_GET['time1'])){
			$where['date'] = array('egt', $time1);
		}
		elseif(!empty($_GET['time2'])){
			$where['date'] = array('elt', $time2);
		}
		
		$where['mch'] = 0;
		//$this->display();
		$this -> _list('mchdata',$where,'id desc');
	}
	
	//充值数据
	public function charge(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['title'])){
			$where['title'] = array('like', '%'.$_GET['title'].'%');
		}
	
		$where['btype'] = I('get.btype')?I('get.btype'):1;
		$list = M('anime')->where($where)->order('sort desc')->select();

		
		foreach($list as $k=>$v){
			//推广次数
			$list[$k]['chapterNums'] = M('chapter')->where(array('anid'=>$v['id']))->count();
			//今日充值
			$list[$k]['tcharge'] = M('charge')->where(array('anid'=>$v['id'],'status'=>2,'create_time'=>array('egt',strtotime(date('Y-m-d')))))->sum('money');
			//昨日充值
			$beginYesterday = mktime(0,0,0,date('m'),date('d')-1,date('y'));
			$endYesterday = mktime(0,0,0,date('m'),date('d'),date('y'))-1;
			$list[$k]['ycharge'] = M('charge')->where(array(
				'anid'=>$v['id'],
				'status'=>2,
				'create_time'=>array( array('egt',$beginYesterday) , array('elt',$endYesterday) ),
			))->sum('money');
			//所有充值
			$list[$k]['acharge'] = M('charge')->where(array('anid'=>$v['id'],'status'=>2))->sum('money');
		}
		
		if(!empty($_GET['order'])){
			$order = explode(',',$_GET['order']);
			$list = arraySequence($list,$order[0],$order[1]);
		}
		
		$count = count($list);
		$page = new \Think\Page($count, 15);
			
		$p = $_GET['p']?$_GET['p']:1;
		$start = ($p-1)*15;		
		$list = array_slice($list,$start,15);
		
		
		//直接充值数量
		$tops['zcharge'] = M('charge')->where(array('status'=>2))->sum('money');
		//直接充值金额
		$tops['zchargeNums'] = M('charge')->where(array('status'=>2))->count();
		
		//引导充值数量
		$tops['dcharge'] = M('charge')->where(array('status'=>2,'anid'=>array('gt',0)))->sum('money');
	
		//引导充值金额
		$tops['dchargeNums'] = M('charge')->where(array('status'=>2,'anid'=>array('gt',0)))->count();

		
		$this->assign('tops',$tops);
		
		
		$this->assign('list',$list);
		$this->assign('page',$page -> show());
		$this->display();
	}
	
	
	//分成统计
	public function separate(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['time1']) && !empty($_GET['time2'])){
			$where['create_time'] = array(
				array('gt', strtotime($_GET['time1'])),
				array('lt', strtotime($_GET['time2']) + 86400)
			);
		}
		elseif(!empty($_GET['time1'])){
			$where['create_time'] = array('gt', strtotime($_GET['time1']));
		}
		elseif(!empty($_GET['time2'])){
			$where['create_time'] = array('lt', strtotime($_GET['time2'])+86400);
		}
		$where['status'] = 2;

		$list = $this -> _get_list('separate',$where,'create_time desc');
		foreach($list as $k=>$v){
			$list[$k]['mch'] = M('mch')->find(intval($v['smch']));
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
	//提现结算
	public function withdraw(){
		$status = I('get.status')?I('get.status'):1;
		
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['time1']) && !empty($_GET['time2'])){
			$where['create_time'] = array(
				array('gt', strtotime($_GET['time1'])),
				array('lt', strtotime($_GET['time2']) + 86400)
			);
		}
		elseif(!empty($_GET['time1'])){
			$where['create_time'] = array('gt', strtotime($_GET['time1']));
		}
		elseif(!empty($_GET['time2'])){
			$where['create_time'] = array('lt', strtotime($_GET['time2'])+86400);
		}
		$where['status'] = $status;
		//提现中金额
		$this->assign('wmoney',M('withdraw')->where(array('status'=>1))->sum('money'));
		//已完成金额
		$this->assign('ymoney',M('withdraw')->where(array('status'=>2))->sum('money'));
		
		
		//数据列表
		$this->_list('withdraw',$where,'create_time desc');
	}
	
	
	//审核提现
	public function setWithStatus(){
		if(IS_POST){
			$id = I('post.id');
			$status = I('post.status');
			$info = M('withdraw')->find(intval($id));
			if(M('withdraw')->where(array('id'=>$id))->save(array('status'=>$status))){
				if($status == -1){
					M('mch')->where(array('id'=>$info['mch']))->setInc('money',$info['money']);
				}
				$this->success('操作成功！');
			}else{
				$this->error('操作失败！');
			}
		
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//推广统计
	public function chapter(){	
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['time1']) && !empty($_GET['time2'])){
			$where['create_time'] = array(
				array('gt', strtotime($_GET['time1'])),
				array('lt', strtotime($_GET['time2']) + 86400)
			);
		}
		elseif(!empty($_GET['time1'])){
			$where['create_time'] = array('gt', strtotime($_GET['time1']));
		}
		elseif(!empty($_GET['time2'])){
			$where['create_time'] = array('lt', strtotime($_GET['time2'])+86400);
		}
		
		if(!empty($_GET['keyword'])){
			$where['name|msg|title'] = array('like', '%'.$_GET['keyword'].'%');
		}
	
		$list = $this->_get_list('chapter',$where,'create_time desc');
		foreach($list as $k=>$v){
			$list[$k]['mname'] = M('mch')->where(array('id'=>$v['mch']))->getField('title');
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	
	//举报统计
	public function lodge(){	
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}		
		if(!empty($_GET['title'])){
			$where['title'] = array('like', '%'.$_GET['title'].'%');
		}
		if(!empty($_GET['btype'])){
			$where['btype'] = $_GET['btype'];
		}
		$this->_list('lodge',$where,'id desc');
	}
	
	
	
	//订单统计
	public function orders(){
		//今日充值
		
		//今日充值总额
		$tcharge['total'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'separate'=>1))->sum('money');
		
		//今日普通充值总额
		$tcharge['ptotal'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'separate'=>1,'isyear'=>0,'isover'=>0))->sum('money');
		//今日普通充值支付笔数
		$tcharge['pnums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		//今日普通充值未支付笔数
		$tcharge['pwnums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>1,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		
		//今日年费充值总额
		$tcharge['ytotal'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'separate'=>1,'isyear'=>1,'isover'=>0))->sum('money');
		//今日年费充值支付笔数
		$tcharge['ynums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		//今日年费充值未支付笔数
		$tcharge['ywnums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>1,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		
		//今日终生充值总额
		$tcharge['ztotal'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'separate'=>1,'isyear'=>0,'isover'=>1))->sum('money');
		//今日终生充值支付笔数
		$tcharge['znums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		//今日终生充值未支付笔数
		$tcharge['zwnums'] = M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>1,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		
		$this->assign('tcharge',$tcharge);
		
		//今日充值结束
		
		//昨日充值，直接调用统计的数据
		$ytime =strtotime( date("Y-m-d",strtotime("-1 day")));
		$yesdate = array();
		//今日充值总额
		$yesdate['total'] = M('charge')->where(array('create_time'=>array('egt',$ytime),'status'=>2,'separate'=>1))->sum('money');
		
		//今日普通充值总额
		$yesdate['ptotal'] = M('charge')->where(array('create_time'=>array('egt',$ytime),'status'=>2,'separate'=>1,'isyear'=>0,'isover'=>0))->sum('money');
		//今日普通充值支付笔数
		$yesdate['pnums'] = M('charge')->where(array('create_time'=>array('egt',$ytime),'status'=>2,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		//今日普通充值未支付笔数
		$yesdate['pwnums'] = M('charge')->where(array('create_time'=>array('egt',$ytime),'status'=>1,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		
		//今日年费充值总额
		$yesdate['ytotal'] = M('charge')->where(array('create_time'=>array('egt',$ytime),'status'=>2,'separate'=>1,'isyear'=>1,'isover'=>0))->sum('money');
		//今日年费充值支付笔数
		$yesdate['ynums'] = M('charge')->where(array('create_time'=>array('egt',$ytime),'status'=>2,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		//今日年费充值未支付笔数
		$yesdate['ywnums'] = M('charge')->where(array('create_time'=>array('egt',$ytime),'status'=>1,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		
		//今日终生充值总额
		$yesdate['ztotal'] = M('charge')->where(array('create_time'=>array('egt',$ytime),'status'=>2,'separate'=>1,'isyear'=>0,'isover'=>1))->sum('money');
		//今日终生充值支付笔数
		$yesdate['znums'] = M('charge')->where(array('create_time'=>array('egt',$ytime),'status'=>2,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		//今日终生充值未支付笔数
		$yesdate['zwnums'] = M('charge')->where(array('create_time'=>array('egt',$ytime),'status'=>1,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		
		$this->assign('yescharge',$yesdate);//M('data')->where(array('date'=>$yesdate))->find());
		
		
		//累计充值
		
		//累计充值总额
		$acharge['total'] = M('charge')->where(array('status'=>2,'separate'=>1))->sum('money');
		
		//累计普通充值总额
		$acharge['ptotal'] = M('charge')->where(array('status'=>2,'separate'=>1,'isyear'=>0,'isover'=>0))->sum('money');
		//累计普通充值支付笔数
		$acharge['pnums'] = M('charge')->where(array('status'=>2,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		//累计普通充值未支付笔数
		$acharge['pwnums'] = M('charge')->where(array('status'=>1,'separate'=>1,'isyear'=>0,'isover'=>0))->count();
		
		//累计年费充值总额
		$acharge['ytotal'] = M('charge')->where(array('status'=>2,'separate'=>1,'isyear'=>1,'isover'=>0))->sum('money');
		//累计年费充值支付笔数
		$acharge['ynums'] = M('charge')->where(array('status'=>2,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		//累计年费充值未支付笔数
		$acharge['ywnums'] = M('charge')->where(array('status'=>1,'separate'=>1,'isyear'=>1,'isover'=>0))->count();
		
		//累计终生充值总额
		$acharge['ztotal'] = M('charge')->where(array('status'=>2,'separate'=>1,'isyear'=>0,'isover'=>1))->sum('money');
		//累计终生充值支付笔数
		$acharge['znums'] = M('charge')->where(array('status'=>2,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		//累计终生充值未支付笔数
		$acharge['zwnums'] = M('charge')->where(array('status'=>1,'separate'=>1,'isyear'=>0,'isover'=>1))->count();
		
		$this->assign('acharge',$acharge);
		
		//今日充值结束
		
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		$time1 = str_replace("-","",$_GET['time1']);
		$time2 = str_replace("-","",$_GET['time2']);
		if(!empty($_GET['time1']) && !empty($_GET['time2'])){
			$where['date'] = array(
				array('egt', $time1),
				array('elt', $time2)
			);
		}
		elseif(!empty($_GET['time1'])){
			$where['date'] = array('egt', $time1);
		}
		elseif(!empty($_GET['time2'])){
			$where['date'] = array('elt', $time2);
		}
		
		$where['mch'] = 0;
		
		$this->_list('mchdata',$where,'date desc');
	}
	
	
	
	//财务/订单
	public function corder(){
		
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		if(!empty($_GET['name'])){
			$where['sn|atitle'] = array('like','%'.$_GET['name'].'%');
		}
		
		if(!empty($_GET['status'])){
			$where['status'] = intval($_GET['status']);
		}

		$list = $this->_get_list('charge',$where,'create_time desc');

		foreach($list as $k=>$v){
			$mch =  M('mch')->where(array('id'=>$v['mch']))->find();
			$parent = M('mch')->where(array('id'=>$mch['parent1']))->find();
			$list[$k]['mchtitle'] = $mch['name'];
			$list[$k]['parent'] = $parent['name'];
			$list[$k]['user'] = M('user')->where(array('id'=>$v['user_id']))->find();
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
}