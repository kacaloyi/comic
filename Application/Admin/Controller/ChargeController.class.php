<?php
namespace Admin\Controller;
use Think\Controller;
class ChargeController extends AdminController {
    // 通知列表
	public function index(){
		$where = $this -> _get_where();
		//$where['status'] = 2;
		$list = $this -> _get_list('charge',$where);
		foreach ($list as $k=>$v){
			$list[$k]['nickname'] = M('user')->where(array('id'=>$v['user_id']))->getField('nickname');
			if(1==$list[$k]['status']) $list[$k]['status'] = "下单";
			elseif (2==$list[$k]['status']) $list[$k]['status'] = "已支付";
			
		}
		$this->assign('list',$list);
		$this->assign('page',$this->data['page']);
		$this->display();
	}
	
	public function check_Alipay()
	{
	    $sn = I('sn');  //要补偿的订单
	    $alipay_config=C('alipay_config_mobile');
	    $data = [
            // 通过支付宝交易号查询，  推荐  效率更高
            //'transaction_id'    => '2016011421001004330041239366',// 支付宝
    
            // 通过订单号查询
            'order_no'    => $sn// 支付宝
        ];

	    $query = new QueryContext();
 
        try {
            // 支付宝查询
            $query->initQuery(Config::ALI, $aliconfig);
            $ret = $query->query($data);
         
        } catch (PayException $e) {
            echo $e->errorMessage();exit;
        }
         
        var_dump($ret);
	}

	public function pay_makeup(){
		$sn = I('sn');  //要补偿的订单
		$remark="补单";
		$paysn="000000000000000";
		$paytime = NOW;

		//进行订单处理；
		$order_info = M('charge')->where(array('sn'=>$sn))->find(); 
		$order_id = $order_info['id'];

		if($order_info['status'] !=1){//1代表没有处理过，处理过之后已经用户加过金币，就不能再次处理了。
			   $this->error("已经处理过了，不能重复处理") ;//	die('FAIL');
		}
        
        $obj = new \Home\Controller\NotifyBaseController();

        $obj->_charge($sn,$remark,$paysn,$paytime);

		
		$this->success("处理成功");
	}
	
	private function _get_where(){
		if(IS_POST){
			$_GET  = array_merge($_GET, $_POST);
			$_GET['p'] = 1; //如果是post的话回到第一页
		}
		
		if(!empty($_GET['user_id'])){
			$where['user_id'] = intval($_GET['user_id']);
		}
		
		if(!empty($_GET['sn'])){
			$where['sn'] = ($_GET['sn']);
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
		return $where;
	}
	
}?>