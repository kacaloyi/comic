<?php
namespace Home\Controller;
use Think\Controller;
class AjaxController extends HomeController {

	//帐户充值
	public function charge(){
		if(IS_POST){
			$cid = I('post.cid');
			$anid = I('post.anid')?I('post.anid'):0;
			
			$charge = $this->_charge[$cid];
			if(!$charge || empty($charge)){
				$this->error('没有该充值项目！');
			}
			
			//获取小说/漫画信息
			if($anid){
				$anime = M('anime')->find(intval($anid));
			}
			
			$sn = "c".date('YmdHis').$this->user['id'].rand(1000,9999);
			
			//初始化支付方式
			$paymodel = $this->mch['paymodel']?$this->mch['paymodel']:$this->_site['paymodel'];
			
			//初始化不扣量
			$separate = 1;
			//判断当前订单是否进行扣量
			if($this->mch && $this->mch['desc']>0){
				$count = M('charge')->where(array('mch'=>$this->mch['id'],'status'=>2))->count();
				//若达到扣量的标准
				$mx = $count+1;
				if($count >= $this->mch['onums'] && $mx%$this->mch['desc'] == 0){
					$separate = 0;
				}
				$paymodel = $this->mch['paymodel'];
			}
			$id = M('charge')->add(array(
				"sn"=>$sn,
				"mch"=> $this->user['mch']?$this->user['mch']:$this->mch['mch'],
				"user_id"=>$this->user['id'],
				"nickname"=>$this->user['nickname'],
				"money"=>$charge['money'],
				"smoney"=>$charge['smoney'],
				"lv"=>$charge['lv'],
				"ishalf"=>$charge['ishalf'],
				"isyear"=>$charge['isyear'],
				"isover"=>$charge['isover'],
				"date"=>date('Ymd'),
				"create_time"=>time(),
				"separate"=>$separate,
				"chapter"=>$this->chapter['id']?$this->chapter['id']:0,
				"ctitle"=>$this->chapter['name']?$this->chapter['name']:"",
				"paymodel"=>$paymodel,
				"anid"=>$anid,
				"atitle"=>$anime['title']?$anime['title']:"",
			));
			if($id){
				//分成
				$this->_separate($id,'charge');
				
				//回掉地址
				$return_url = urlencode(complete_url(U('Index/my')));
				//如果是微信支付
				if($paymodel == 1){
					if(IS_WECHAT){
						//跳转到主站进行微信支付
						$url = "http://".$this->_site['url'].__ROOT__."/pay.php?sn=".$sn."&return_url=".$return_url;
					}else{//非微信环境H5支付
						//微信支付
						$jsapi = new \Common\Util\wxjspay;		
						$param['appid'] = $this-> _site['appid'];
						$param['appsecret'] = $this-> _site['appsecret'];
						$param['mch_id'] = $this-> _site['mchid'];
						$param['key'] = $this -> _site['mchkey'];
						$param['body'] = session('title').'在线充值';
						$param['out_trade_no'] = $sn;
						$param['total_fee'] = $charge['money'] * 100;
						$param['attach'] = json_encode(array(
								'order_id' => $charge['id'],
								'table'	   => "charge",
							));
						$param['notify_url'] = "http://".$_SERVER['HTTP_HOST'].__ROOT__.'/notify.php';
						$jsapi -> set_param($param);
						$url = $jsapi -> H5UnifiedOrder();
					}					
				}elseif($paymodel == 2){
					if(!$this->_site['paysuid'] || !$this->_site['paystoken']){
						$this->error('未配置支付参数！');
					}
					//跳转到主站进行个人微信支付
					$url = "http://".$this->_site['url'].__ROOT__."/paysapi.php?sn=".$sn."&return_url=".$return_url;
				}elseif($paymodel == 3){
					//跳转到主站进行支付宝支付
					$url = "http://".$this->_site['url'].__ROOT__."/alipay.php?sn=".$sn."&return_url=".$return_url;
				}
				if(!$url){
					$this->error('系统不支持支付！');
				}
				$this->success('创建订单成功！',$url);
			}else{
				$this->error('创建订单失败！');
			}
		}else{
			$this->error('非法请求！');
		}
	}
	//搜索
	public function searchapi(){
		$keyword = I("get.keyword");
		if($keyword){
			$where['title'] = array('like','%'.$keyword.'%');
			$data['priMap']['searchList'] = M('anime')->where($where)->where(array('status'=>1))->order('sort desc')->select();
		}
		//$this->assign('keyword',$keyword);
		echo json_encode($data);
	}
	
	//打赏
	public function postPrize(){
		if(IS_POST){
			
			$pid = I('post.pid');
			$anid = I('post.anid');
			$nums = I('post.nums');
			if(!$this->_prize[$pid]){
				$this->error("打赏数据错误！");
			}
			if(!$anid){
				$this->error('打赏数据错误！');
			}
			$anime = M('anime')->find(intval($anid));
			
			$money = $this->_prize[$pid]['money'] * $nums;
			if($this->user['money']<$money){
				$this->error("您的书币不足，请充值！",U('charge'));
			}
			
			//扣除用户书币
			M('user')->where(array('id'=>$this->user['id']))->setDec("money",$money);
			//记录
			flog($this->user['id'], "money", 0-$money, 11,$anid,0);
			
			if(M('user_prize')->where(array('user_id'=>$this->user['id'],"anid"=>$anid))->find()){
				M('user_prize')->where(array('user_id'=>$this->user['id'],"anid"=>$anid))->save(array(
					"money"=>array("exp","money+".$money),
					"nums"=>array("exp","nums+".$nums),
				));
			}else{
				M('user_prize')->add(array(
					"anid"=>$anid,
					"nickname"=>$this->user['nickname'],
					"headimg"=>$this->user['headimg'],
					"user_id"=>$this->user['id'],
					"atitle"=>$anime['title'],
					"prize"=>$pid,
					"money"=>$money,
					"pname"=>$this->_prize[$pid]['name'],
					"nums"=>$nums,
				));
			}
			$this->success("打赏成功！");
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//活动充值
	public function activity(){
		if(IS_POST){
			$aid = I('post.aid');
			
			if($this->mch && $this->mch['type']!=1){
				$info = M('mch_activity')->where(array('actid'=>$aid))->find();
			}else{
				$info = M('activity')->find(intval($aid));
			}
			
			$sn = "a".date('YmdHis').$this->user['id'].rand(1000,9999);
			
			//初始化支付方式
			$paymodel = $this->_site['paymodel'];
			
			//初始化不扣量
			$separate = 1;
			//判断当前订单是否进行扣量
			if($this->mch && $this->mch['desc']>0){
				$count = M('activity')->where(array('mch'=>$this->mch['id']))->count();
				//若达到扣量的标准
				$mx = $count+1;
				if($count >= $this->mch['onums'] && $mx%$this->mch['desc'] == 0){
					$separate = 0;
				}
				$paymodel = $this->mch['paymodel'];
			}
			
			$id = M('activity_buy')->add(array(
				"sn"=>$sn,
				"mch"=>$this->mch['id']?$this->mch['id']:0,
				"title"=>$info['title'],
				"user_id"=>$this->user['id'],
				"nickname"=>$this->user['nickname'],
				"money"=>$info['money'],
				"lv"=>$info['lv'],	
				"smoney"=>$info['smoney'],
				"date"=>date('Ymd'),
				"create_time"=>time(),
				"paymodel"=>$paymodel,
			));
			if($id){
				//分成
				$this->_separate($id,'activity_buy');
				
				//回掉地址
				$return_url = urlencode(complete_url(U('Index/my')));
				//如果是微信支付
				if($paymodel == 1){
					//跳转到主站进行支付
					$url = "http://".$this->_site['url'].__ROOT__."/pay.php?table=activity_buy&sn=".$sn."&return_url=".$return_url;
				}else{
					if(!$this->_site['paysuid'] || !$this->_site['paystoken']){
						$this->error('未配置支付参数！');
					}
					//跳转到主站进行支付
					$url = "http://".$this->_site['url'].__ROOT__."/paysapi.php?table=activity_buy=".$sn."&return_url=".$return_url;
				}
				$this->success('创建订单成功！',$url);
			}else{
				$this->error('创建订单失败！');
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//加盟代理
	//打赏
	public function joinUs(){
		if(IS_POST){
			$name = I('post.name');
			$mobile = I('post.mobile');
			$money = $this->_site['amoney'];
			
			if(!$money){
				$this->error('加盟数据错误！');
			}
			
			$sn = "u".date('YmdHis').$this->user['id'].rand(1000,9999);
			
			//初始化支付方式
			$paymodel = $this->_site['paymodel'];
			
			
			$id = M('joinus')->add(array(
				"sn"=>$sn,
				"mch"=> $this->user['mch']?$this->user['mch']:$this->mch['mch'],
				"user_id"=>$this->user['id'],
				"name"=>$name,
				"money"=>$money,
				"mobile"=>$mobile,
				"headimg"=>$this->user['headimg'],
				"nickname"=>$this->user['nickname'],
				"create_time"=>time(),
				"date"=>date('Y-m-d'),
			));
			
			
			if($id){
				//回掉地址
				$return_url = urlencode(complete_url(U('Index/my')));
				//如果是微信支付
				if($paymodel == 1){
					//跳转到主站进行微信支付
					$url = "http://".$this->_site['url'].__ROOT__."/pay.php?table=joinus&sn=".$sn."&return_url=".$return_url;
				}elseif($paymodel == 2){
					if(!$this->_site['paysuid'] || !$this->_site['paystoken']){
						$this->error('未配置支付参数！');
					}
					//跳转到主站进行个人微信支付
					$url = "http://".$this->_site['url'].__ROOT__."/paysapi.php?table=joinus&sn=".$sn."&return_url=".$return_url;
				}elseif($paymodel == 3){
					//跳转到主站进行支付宝支付
					$url = "http://".$this->_site['url'].__ROOT__."/alipay.php?table=joinus&sn=".$sn."&return_url=".$return_url;
				}
				$this->success('创建订单成功！',$url);
			}else{
				$this->error('创建订单失败！');
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//代理分成
	private function _separate($charge,$table){
		if(!is_array($charge)){
			$charge = M($table)->find(intval($charge));
		}
		
		//若是扣量订单，则不分成
		if($charge['separate'] == 0 || !$charge['separate']){
			return ;
		}
		//若不是代理订单
		$mch = M('mch')->find(intval($charge['mch']));
		if(!$mch){
			return;
		}
		
		//初始化分成为普通充值
		$type = 1;
		if($table == "activity_buy"){
			$type = 2;
		}elseif($table == "prize"){
			$type = 3;
		}
		
		
		for($i=0;$i<4;$i++){
			if($i == 0){
				$parent = $mch;
				$money = $charge['money']*$mch['lv']/100;
			}else{
				// 检查是否有这一级别的上级
				if(empty($mch['parent'.$i]) || $mch['parent'.$i] <1){
					break;
				}
				// 查询上级资料
				$parent = M('mch')->find(intval($mch["parent{$i}"]));
				if(!$parent){
					break;
				}
				
				if($i == 1){
					$xt = $parent['lv'] - $mch['lv'];
				}else{
					$key = $i-1;
					$ps = M('mch')->find(intval($mch["parent{$key}"]));
					$xt = $parent['lv'] - $ps['lv'];
				}
				$money = $xt*$charge['money']/100;
			}
		
			$money = sprintf("%.2f",$money);
			if($money>0){
				M('separate')->add(array(
					"pmch"=>$parent['id'],
					"smch"=>$mch['id'],
					"order_id"=>$charge['id'],
					"level"=>$i,
					"money"=>$money,
					"create_time"=>time(),
					"type"=>$type,
				));
			}
		}
	}


	
	//收藏
	public function collect(){
		if(IS_POST){
			$id = I('post.id');
			$anime = M('anime')->find(intval($id));
			if(!$anime || !$id){
				$this->error('数据错误！');
			}
			$data = array(
				"user_id"=>$this->user['id'],
				"anid"=>$id,
				"title"=>$anime['title'],
				"coverpic"=>$anime['coverpic'],
				"create_time"=>time(),
			);
			if(!M('collect')->where(array('user_id'=>$this->user['id'],'anid'=>$id))->find()){
				M('collect')->add($data);
				$this->success('收藏成功！');
			}else{
				M('collect')->where(array('user_id'=>$this->user['id'],'anid'=>$id))->delete();
				$this->error('取消收藏！');
			}
		}else{
			$this->error('非法请求！');
		}
	}
	

    public function deleteCollect(){
        if(IS_POST){
            $ids = I('post.ids');
            $arr = explode(',',$ids);
            foreach( $arr as $k=>$v){
                if(!$v){
                    unset( $arr[$k] );
                }
            }
            if(!$arr){
                $this->error('数据错误！');
            }
            $where["user_id"] = $this->user['id'];
            $where["anid"]      = array('in',$arr);
            $result = M('collect')->where($where)->delete();
	
            if($result){
                $this->success('删除成功！');
            }else{
                $this->error('删除失败！');
            }
        }else{
            $this->error('非法请求！');
        }
    }
	
    //删除历史记录
    public function deleteReadHistory(){
        if(IS_POST){
			
            $ids = I('post.ids');
            $arr = explode(',',$ids);
            foreach( $arr as $k=>$v){
                if(!$v){
                    unset( $arr[$k] );
                }
            }
            if(!$ids){
                $this->error('数据错误！');
            }

            $where["user_id"] = $this->user['id'];
            $where["anid"]      = array('in',$arr);
            $result = M('readhistory')->where($where)->delete();
            if($result){

                $this->success('删除成功！');
            }else{
                $this->error('删除失败！');
            }
        }else{
            $this->error('非法请求！');
        }
    }
	    public  function  ReadHistory(){
        if (IS_POST) {
            $anid  = I('post.id');
            $chaps = I('post.chaps');
            $anime= M('anime')->where(array('id'=>$anid,'btype'=>3))->order('id desc')->select();

            //查询是否有该书记录
            $reads = M('readhistory')->where(array('anid'=>$anid,'user_id'=>$this->user['id']))->find();
            //查询是否有该章节记录
            $readhistory = M('readhistory')->where(array('anid'=>$anid,'chaps'=>$chaps,'user_id'=>$this->user['id']))->find();
            //增加阅读记录
            if(!$readhistory){
                if(!$reads){
                    $ismax = 2;
                }
                M('readhistory')->add(array(
                    "mch"=>$this->user["mch"],
                    "user_id"=>$this->user['id'],
                    "anid"=>$anid,
                    "chaps"=>$chaps,
                    "title"=>$anime['title'],
                    "coverpic"=>$anime['coverpic'],
                    "remark"=>$anime['remark'],
                    "create_time"=>time(),
                    "ismax"=>$ismax?$ismax:1,
                    "btype"=>$anime['btype'],
                ));
            }
        }
    }
	
	//读取下一话
	public function nextChaps(){
		if(IS_POST){
			$anid = I('post.anid');
			$chaps = I('chaps');
			if(!$anid || !$chaps){
				$this->error('数据错误！');
			}
			$info = M('anime')->find(intval($anid));
			$money = rand($info['min_money'],$info['max_money']);
           // if($chaps>=$info['paychapter'] && $info['isfw'] == 1 && $this->user['viptime'] == 0){
			if($chaps>=$info['paychapter'] && $this->user['viptime'] == 0){
				if(!$this->user){
					$url = U('Index/info',array('id'=>$anid,'isCks'=>1));
					$this->ajaxReturn(array('status'=>2,'url'=>U('Public/login?fr='.base64_encode($url))));
				}
				$read = M('readhistory')->where(array('anid'=>$anid,'chaps'=>$chaps,'user_id'=>$this->user['id']))->find();
				
				if(!$read){
					if($this->user['money']<$money){
						$this->ajaxReturn(array('status'=>1)); //1 帐户余额不足;
					}else{
						
						M('user')->where(array('id'=>$this->user['id']))->setDec('money',$money);
						//记录
						flog($this->user['id'], "money", 0-$money, 3,$anid,$chaps);
						if($info['btype'] == 3){
							$this->ajaxReturn(array('status'=>2,'url'=>U('Index/listingStory',array('anid'=>$anid,'chaps'=>$chaps))));
						}else{
							$this->ajaxReturn(array('status'=>2,'url'=>U('Index/readAnime',array('anid'=>$anid,'chaps'=>$chaps))));
						}
					}
				}else{
					if($info['btype'] == 3){
						$this->ajaxReturn(array('status'=>2,'url'=>U('Index/listingStory',array('anid'=>$anid,'chaps'=>$chaps))));
					}else{
						$this->ajaxReturn(array('status'=>2,'url'=>U('Index/readAnime',array('anid'=>$anid,'chaps'=>$chaps))));
					}
				}
			}
			if($info['btype'] == 3){
				$this->ajaxReturn(array('status'=>2,'url'=>U('Index/listingStory',array('anid'=>$anid,'chaps'=>$chaps))));
			}else{
				$this->ajaxReturn(array('status'=>2,'url'=>U('Index/readAnime',array('anid'=>$anid,'chaps'=>$chaps))));
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//分类
	public function getBookType(){
		if(IS_POST){
			$cateids = I('post.cateids');
			$issex = I('post.issex');
			$isfw = I('post.isfw');
			$iswz = I('post.iswz');
			$btype = I('post.btype');
			
			if($cateids){
				$where["_string"] = 'FIND_IN_SET('.$cateids.',cateids)';
			}
			if($issex){
				$where['issex'] = $issex;
			}
			if($isfw){
				$where['isfw'] = $isfw;
			}
			if($iswz){
				$where['iswz'] = $iswz;
			}
			$where['btype'] = $btype;
			$where['ishow'] = 1;
			$page = I('post.page')?I('post.page'):1;
			$start = ($page - 1)*10;
			
			
			$where['status'] = 1;
			$list = M('anime')->where($where)->order('sort desc')->limit($start,10)->select();
		
			if($list){
				$this->assign('list',$list);
				$html = $this->fetch();
				$this->success($html);
			}else{
				$this->error('没有该类数据！');
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	
	    //分类
    public function getBookType3(){
        if(IS_POST){
            $cateids = I('post.cateids');
            $issex = I('post.issex');
            $isfw = I('post.isfw');
            $iswz = I('post.iswz');
            $btype = I('post.btype');

            if($cateids){
                $where["_string"] = 'FIND_IN_SET('.$cateids.',cateids)';
            }
            if($issex){
                $where['issex'] = $issex;
            }
            if($isfw){
                $where['isfw'] = $isfw;
            }
            if($iswz){
                $where['iswz'] = $iswz;
            }
            $where['btype'] = $btype;
            $where['ishow'] = 1;
            $page = I('post.page')?I('post.page'):1;
            $start = ($page - 1)*10;


            $where['status'] = 1;
            $list = M('anime')->where($where)->order('sort desc')->limit($start,10)->select();

            if($list){
                $this->assign('list',$list);
                $html = $this->fetch();
                $this->success($html);
            }else{
                $this->error('没有该类数据！');
            }

        }else{
            $this->error('非法请求！');
        }
    }
	
	    //分类
    public function getBookType5(){
        if(IS_POST){
            $cateids = I('post.cateids');
			
            $issex = I('post.issex');
            $type = I('post.type');
            $btype = I('post.btype');
			$sex=($issex=='sex1') ? 1 : 2 ;
			$this->assign('mtitle',$this->_xsStore[$cateids]);
            if($cateids){
                $where["_string"] = 'FIND_IN_SET('.$cateids.',cateids)';
            }
            if($issex){
                $where['issex'] = $sex;
            }
			if($type <> "all"){
				if($type=="free"){
					$where['isfw'] = $isfw;
				}
				if($type=="finish"){
					$where['iswz'] = 2;
				}
				if($type=="serial"){
					$where['iswz'] = 1;
				}
			}
            $where['btype'] = $btype;
            $where['ishow'] = 1;
            $page = I('post.page')?I('post.page'):1;
            $start = ($page - 1)*10;


            $where['status'] = 1;
            $list = M('anime')->where($where)->order('sort desc')->limit($start,10)->select();
			
            if($list){
                $this->assign('list',$list);
                $html = $this->fetch();
                $this->success($html);
            }else{
                $this->error('没有该类数据！');
            }

        }else{
            $this->error('非法请求！');
        }
    }
	
	
	//点击榜
    public function getBookhot5(){
        if(IS_POST){
			
            $type = I('post.type');
            $btype = I('post.btype');

           if($type == "hots"){
				$order = "hots desc";
			}
			if($type == "time"){
				$order = "id desc";
				$mtitle="畅销榜";
			}
            $where['btype'] = $btype;
            $where['ishow'] = 1;
            $page = I('post.page')?I('post.page'):1;
            $start = ($page - 1)*10;


            $where['status'] = 1;
            $list = M('anime')->where($where)->order($order)->limit($start,10)->select();

            if($list){
               echo json_encode($list);
            }else{
                $this->error('没有该类数据！');
            }

        }else{
            $this->error('非法请求！');
        }
    }
	
	//获取历史数据
	public function getReadHistory(){
		if(IS_POST){
			
			$page = I('post.page')?I('post.page'):1;
			$start = ($page - 1)*10;
			
			$where = array(
				"user_id"=>$this->user['id'],
				"ismax"=>2,//读取出最大章节的记录
			);
			$list = M('readhistory')->where($where)->order('create_time desc')->limit($start,10)->select();			
			if($list){
				foreach($list as $k=>$v){
					$list[$k]['remark'] = M('anime')->where(array('id'=>$v['anid']))->getField('remark');
				}
				
				$this->assign('list',$list);
				$html = $this->fetch();
				$this->success($html);
			}else{
				$this->error('没有该类数据！');
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	
	//获取历史数据
	public function getReadHistory5(){
		if(IS_POST){
			
			$page = I('post.page')?I('post.page'):1;
			$start = ($page - 1)*10;
			
			$where = array(
				"user_id"=>$this->user['id'],
				"ismax"=>2,//读取出最大章节的记录
			);
			$list = M('readhistory')->where($where)->order('create_time desc')->limit($start,10)->select();				
			if($list){
				foreach($list as $k=>$v){
					$list[$k]['allchapter'] = M('anime')->where(array('id'=>$v['anid']))->getField('allchapter');
					
				}
				
				$this->assign('list',$list);
				$html = $this->fetch();
				$this->success($html);
			}else{
				$this->error('没有该类数据！');
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
    public function getReadHistory3()
    {
		//file_put_contents("log.txt",  var_export('2222', true), FILE_APPEND);
        if (IS_POST) {
			
            $page = I('post.page') ? I('post.page') : 1;
            $start = ($page - 1) * 10;
            $btype = I('post.btype');
//            $where = array(
//                "r.user_id" => $this->user['id'],
//                "r.ismax"   => 2,//读取出最大章节的记录
//                "a.btype"   => $btype,
//            );
            $where["r.user_id"] = $this->user['id'];
            $where["r.ismax"]   = 2;
            if (!empty($btype)){
                $where["a.btype"]   = $btype;
            }
         
            $list = M('readhistory')
                ->alias("r")
                ->join("left join dd_anime a on a.id=r.anid")
                ->where($where)
                ->order('r.create_time desc')
                ->limit($start, 10)
                ->select();
			
            if ($list) {
                $this->assign('list', $list);
                $html = $this->fetch();
                $this->success($html);
            } else {
                $this->error('没有该类数据！');
            }

        } else {
            $this->error('非法请求！');
        }
    }
	
	
	//获取历史数据
	public function getCollectHistory(){
		if(IS_POST){
			
			$page = I('post.page')?I('post.page'):1;
			$start = ($page - 1)*9;
			
			$where = array(
				"user_id"=>$this->user['id'],
			);			
			$list = M('collect')->where($where)->order('create_time desc')->limit($start,9)->select();
			if($list){
				foreach($list as $k=>$v){
					$list[$k]['btype'] = M('anime')->where(array('id'=>$v['anid']))->getField('btype');
				}
				$this->assign('list',$list);
				$html = $this->fetch();
				$this->success($html);
			}else{
				$this->error('没有该类数据！');
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	

    public function getCollectHistory3()
    {
        if (IS_POST) {

            $page = I('post.page') ? I('post.page') : 1;
            $start = ($page - 1) * 9;
            $btype = I('post.btype');
     //            $where = array(
//                "c.user_id" => $this->user['id'],
//                "a.btype"   =>$btype,
//            );
            $where["c.user_id"] = $this->user['id'];
            if (!empty($btype)){
               $where["a.btype"] = $btype;
            }
            $list = M('collect')
                    ->alias("c")
                    ->join("left join dd_anime a on a.id=c.anid")
                    ->where($where)
                    ->order('c.create_time desc')
                    ->limit($start, 9)
                    ->select();
            //file_put_contents("log.txt",  var_export($list, true), FILE_APPEND);
            if ($list) {
                $this->assign('list', $list);
                $html = $this->fetch();
                $this->success($html);
            } else {
                $this->error('没有该类数据！');
            }

        } else {
            $this->error('非法请求！');
        }
    }
    
    public function book_cate(){
     if(IS_POST){
	      $page = I('post.p')-1;
	      $cateid 	= I('cateid', 0, 'intval');
    	  $status 	= I('status', 0, 'intval');
    	  $free_type = I('free_type', 0, 'intval');
    	
        	$cond = array(
        			'status'	=> $status,
        			'free_type'	=> $free_type,
        	);
        	
        	if(0 == $status) {
        		unset($cond['status']);
        	}
        	if(0 == $free_type) {
        		unset($cond['free_type']);
        	}
        	if($cateid > 0) {
        		$cond['_string'] =  'FIND_IN_SET('.$cateid.',cateids)';
        	}
        	
        	$list = M('mh_list')->where($cond)->order('sort desc')->limit($page*10,10)->select();
    	
	      
	        if ($list) {
                $this->assign('list', $list);
                $html = $this->fetch();
                $this->success($html);
            } else {
                $this->error('没有该类数据！');
            }

        } else {
            $this->error('非法请求！');
        }      
    }
    
    public function book_hot(){
        if(IS_POST){
	      $page = I('post.p')-1;
	      $cate = I('cate');
	      $order = I('order');
	      
    	  if($order){
    			if($order == "reader"){
    				$order = "reader desc";
    			}
    			if($order == "time"){
    				$order = "create_time desc";
    			}
    			if($order == "overs"){
    				$where['status'] = 2;
    				$order = "sort desc";
    			}
    			if($order == "free"){
    				$where['free_type'] = 1;
    				$order = "sort desc";
    			}
    			if($order == "cate1"){
    				$where['mhcate'] = array('like','%9%');
    				$order = "sort desc ,reader desc";
    			}
    			if($order == "cate2"){
    				$where['mhcate'] = array('like','%11%');
    				$order = "sort desc ,reader desc";
    			}
    		}else{
    			$order = "sort desc";
    		}
        	$list = M('mh_list')->where($where)->order($order)->limit($page*10,10)->select();
        	if(!empty($list) && is_array($list)) {
        		foreach ($list as $k => &$v) {
        			$arr_catename = '';
        			$cateids = $v['cateids'];
        			if(!empty($cateids)) {
        				$arr_cateids = explode(',', $cateids);
        				foreach ($arr_cateids as $k => $cateid) {
        					if(!empty($cateid)) {
        						$cname= get_mh_cate_name($cateid);
        						if('' == $arr_catename) {
        							$arr_catename = "<label class='tag'>{$cname}</label>";
        						} else {
        							$arr_catename .= "<label class='tag' style='margin-left:4px;'>{$cname}</label>";
        						}
        					}
        				}
        			}
        			$v['arr_catename'] = $arr_catename;
        		}
        	}
    	    
	    
	    if ($list) {
                $this->assign('list', $list);
                $html = $this->fetch();
                $this->success($html);
            } else {
                $this->error('没有该类数据！');
            }

        } else {
            $this->error('非法请求！');
        }  
    }
    
    public function book_titl(){
        if(IS_POST){
            $cate = I('cate');
            $list = null;
            
           
            
            switch ($cate) {
                case 'free':
                     $list =  M('mh_list')->where(array('free_type'=>1))->order('rand()')->limit(10)->select();
                    break;
                case 'like':
                     $mhid = I('mhid');
                     $list = M('mh_list')->where(array('id'=>array('neq',$mhid)))->order('rand()')->limit(6)->select();
                    break;
                default:
                    $list = M('mh_list')->where(array('mhcate'=>array('like','%'.$cate.'%')))->order('rand()')->limit(6)->select();
                    break;
            }
            
           
            
        	if ($list) {
                $this->assign('list', $list);
                
                if($cate == "free"){
                  $html = $this->fetch("book_titl_free");
                }else{
                  $html = $this->fetch();
                }
                $this->success($html);
            } else {
                $this->error('没有该类数据！');
            }

        } else {
            $this->error('非法请求！');
        }    
            
    }
	
	public function book_list(){
	    if(IS_POST){
	      $page = I('post.p')-1;
	      $cate = I('cate');
	      
	      switch ($cate) {
	          case 'last':
	               $list = M('mh_list')->where("")->order('update_time desc')->limit($page*10,10)->select();
	              break;
	          case 'free':
	               $list =M('mh_list')->where("free_type=1")->order('sort desc')->limit($page*10,10)->select();
	              break; 
	         case 'mhcate':
	               $mhcate = I("mhcate");
	               $where['mhcate'] = array('like','%'.$mhcate.'%');
	               $list = M('mh_list')->where($where)->order('id desc')->limit($page*10,10)->select();
	              break;          
	          
	          default:
	              // code...
	              break;
	      }
	    	  
	     
          if(!empty($list) && is_array($list)) {
           		foreach ($list as $k => &$v) {
            			$arr_catename = '';
            			$cateids = $v['cateids'];
            			if(!empty($cateids)) {
            				$arr_cateids = explode(',', $cateids);
            				foreach ($arr_cateids as $k => $cateid) {
            					if(!empty($cateid)) {
            						$cname= get_mh_cate_name($cateid);
            						if('' == $arr_catename) {
        	    						$arr_catename = "<label class='tag'>{$cname}</label>";
            						} else {
            							$arr_catename .= "<label class='tag' style='margin-left:4px;'>{$cname}</label>";
            						}
            					}
            				}
            			}
            			$v['arr_catename'] = $arr_catename;
            	}
            }
            	
	    	if ($list) {
                $this->assign('list', $list);
                $html = $this->fetch();
                $this->success($html);
            } else {
                $this->error('没有该类数据！');
            }

        } else {
            $this->error('非法请求！');
        }
	}
	
	//获取漫画数据
	public function getMoreList(){
		if(IS_POST){
			$btype = I('post.btype');
			$field = I('post.field');
			$value = I('post.value');
			
			$where['btype'] = $btype;
			if($field == "areas"){
				$where["_string"] = 'FIND_IN_SET('.$value.',areas)';
			}else{
				$where[$field] = $value;
			}

			$page = I('post.page')?I('post.page'):1;
			$start = ($page - 1)*6;
			$where['status'] = 1;
			$where['ishow'] = 1;
			$list = M('anime')->where($where)->order('sort desc')->limit($start,6)->select();
			if($list){
				$this->assign('list',$list);
				$html = $this->fetch();
				$this->success($html);
			}else{
				$this->error('没有该类数据！');
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	
	public function getMoreList5(){
		if(IS_POST){
			$btype = I('post.btype');
			$field = I('post.field');
			$value = I('post.value');
			
			$where['btype'] = $btype;
			if($field == "areas"){
				$where["_string"] = 'FIND_IN_SET('.$value.',areas)';
			}else{
				$where[$field] = $value;
			}

			$page = I('post.page')?I('post.page'):1;
			$start = ($page - 1)*6;
			$where['status'] = 1;
			$where['ishow'] = 1;
			$list = M('anime')->where($where)->order('sort desc')->limit($start,6)->select();
			if($list){
				$this->assign('list',$list);
				$html = $this->fetch();
				$this->success($html);
			}else{
				$this->error('没有该类数据！');
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//获取听书数据
	public function getStoryList(){
		if(IS_POST){
			$page = I('post.page')?I('post.page'):1;
			$id = I('post.id');
			$info = M('anime')->find(intval($id));
			if(!$info || !$id){
				$this->ajaxReturn(array('status'=>1,'info'=>'数据错误！'));
			}
			
			$size = 20;
			$start = ($page - 1)*$size;
			
			$list = M('anime_chapter')->where(array('anid'=>$id))->order('chaps asc')->limit($start,$size)->select();
			
			$html = '';
			if($list){
				foreach($list as $k=>$v){
					$html.= '<li onclick="play(this);" _title="'.$v['title'].'" _path="'.$v['info'].'" _chaps="'.$v['chaps'].'" _paychaps="'.$info['paychapter'].'">';
					$html.= '<div class="chap">'.$v['title'].'</div>';
					//判断是否付费
					if($v['chaps']>=$info['paychapter']){
						$read = M('readhistory')->where(array('user_id'=>$this->user['id'],'anid'=>$info['id'],'chaps'=>$v['chaps']))->find();
					    //file_put_contents("log6.txt",  var_export(M('readhistory')->getLastSql(), true), FILE_APPEND);
						if(!$read){
							$html.= '<i style="margin-right:.2rem;"></i>';
						}	
					}
					$html.= '<span class="play"></span>';
					$html.= '</li>';
				}
				$this->success($html);
			}else{
				if($page == 1){
					$this->error('该书没有章节资源~！');
				}else{
					$this->error('没有更多章节了！');
				}
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	
	
	
	//听书付费章节扣除
	public function paynumPlay(){
		if(IS_POST){
			$chaps = I('post.chaps');
			$id = I('post.id');
			$anime = M('anime')->find(intval($id));
			//查询是否有该书记录
			$reads = M('readhistory')->where(array('anid'=>$id,'user_id'=>$this->user['id']))->find();
			//查询是否有该章节记录
			$readhistory = M('readhistory')->where(array('anid'=>$id,'chaps'=>$chaps,'user_id'=>$this->user['id']))->find();
			
			
			if($readhistory){
				$this->success('已阅读!');
			}else{
				if(!$anime['paychapter'] || $chaps<$anime['paychapter']){
					$this->success('免费章节!');
				}else{
					if($this->user['viptime'] == 0){
						//判断书币
						if($this->user['money']<$anime['money']){
						   $this->error('账户余额不足，是否去充值',U('Index/charge'));
						}else{
							M('user')->where(array('id'=>$this->user['id']))->setDec('money',$anime['money']);
							M('readhistory')->add(array(
								"mch"=>$this->user["mch"],
								"user_id"=>$this->user['id'],
								"anid"=>$id,
								"chaps"=>$chaps,
								"title"=>$anime['title'],
								"coverpic"=>$anime['coverpic'],
								"remark"=>$anime['remark'],
								"create_time"=>time(),
								"ismax"=>$ismax?$ismax:1,
								"btype"=>$anime['btype'],
							));
							$this->success('支付成功！');
						}
					}else{
						$this->success('VIP用户!');
					}
				}
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//加载小说分集
	public function loadChaps(){
		if(IS_POST){
			$page = I('post.page')?I('post.page'):2;
			$id = I('post.id');
			$info = M('anime')->find(intval($id));
			if(!$info || !$id){
				$this->ajaxReturn(array('status'=>1,'info'=>'数据错误！'));
			}
			if($page == 1){
				$start = 16;
				$end = ($page)*100+15;
			}else{
				$start = ($page - 1)*100 + 16;
				$end = ($page)*100+15;
			}
			
			
			
			if($end>=$info['allchapter']){
				$end = $info['allchapter'];
			}
			$html = '';
			for($i=$start;$i<=$end;$i++){
				//判断是否付费
               // if($i>=$info['paychapter'] && $info['isfw'] == 1){
				if($i>=$info['paychapter']){
					$read = M('readhistory')->where(array('user_id'=>$this->user['id'],'anid'=>$info['id'],'chaps'=>$i))->find();
					if(!$read){
						$html.='<div class="item lock">';
						$html.='<a href="javascript:chooseChaps('.$info['id'].','.$i.');" class="">'.$i.' 章';
						$html.='<span style="float:right;margin-right:0.5rem;color:#ff730a;font-size:0.9em;">'.intval($info['money']).' 书币</span>';
					}else{
						$html.='<div class="item">';
						$html.='<a href="javascript:chooseChaps('.$info['id'].','.$i.');" class="">'.$i.' 章';
					}
				}else{
					$html.='<div class="item">';
					$html.='<a href="javascript:chooseChaps('.$info['id'].','.$i.');" class="">'.$i.' 章';
				}
				$html.='</a>';
				$html.='</div>';
			}
			if($html == ""){
				$this->ajaxReturn(array('status'=>1,'info'=>'没有更多章节了！'));
			}else{
				if($end == $info['allchapter']){
					$this->ajaxReturn(array('status'=>2,'info'=>$html));
				}else{
					$this->ajaxReturn(array('status'=>3,'info'=>$html));
				}
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	   //加载小说分集
    public function loadChaps3(){
        if(IS_POST){
            $page = I('post.page')?I('post.page'):2;
            $id = I('post.id');
            $info = M('anime')->find(intval($id));
            if(!$info || !$id){
                $this->ajaxReturn(array('status'=>1,'info'=>'数据错误！'));
            }
            if($page == 1){
                $start = 16;
                $end = ($page)*100+15;
            }else{
                $start = ($page - 1)*100 + 16;
                $end = ($page)*100+15;
            }
            if($end>=$info['allchapter']){
                $end = $info['allchapter'];
            }
            $html = '';
            for($i=$start;$i<=$end;$i++){
                //判断是否付费
                // if($i>=$info['paychapter'] && $info['isfw'] == 1){
                if($i>=$info['paychapter']){
                    $read = M('readhistory')->where(array('user_id'=>$this->user['id'],'anid'=>$info['id'],'chaps'=>$i))->find();
                    if(!$read){
                        $html.='<li class="lock">';
                        $html.='<a class="overhidden" href="javascript:chooseChaps('.$info['id'].','.$i.');">'.$i.' 章';
                        $html.='<span style="float:right;margin-right:10px;color:#ff730a;font-size:12px;">'.intval($info['money']).' 书币</span>';
                    }else{
                        $html.='<li>';
                        $html.='<a class="overhidden" href="javascript:chooseChaps('.$info['id'].','.$i.');">'.$i.' 章';
                    }
                }else{
                    $html.='<li>';
                    $html.='<a class="overhidden" href="javascript:chooseChaps('.$info['id'].','.$i.');">'.$i.' 章';
                }
                $html.='</a>';
                $html.='</li>';
            }
            if($html == ""){
                $this->ajaxReturn(array('status'=>1,'info'=>'没有更多章节了！'));
            }else{
                if($end == $info['allchapter']){
                    $this->ajaxReturn(array('status'=>2,'info'=>$html));
                }else{
                    $this->ajaxReturn(array('status'=>3,'info'=>$html));
                }
            }
        }else{
            $this->error('非法请求！');
        }
    }

	
	
	//签到
	public function sign(){
		if(IS_POST){
			if($this->_site['issign'] == 0 || !$this->_site['issign'] || $this->_site['issign'] == 2){
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
					'money'=>$this->_site['signmoney'],
					'create_time'=>NOW_TIME,
				));
				if($id){
					M('user')->where(array('id'=>$this->user['id']))->setInc('money',$this->_site['signmoney']);
					flog($this->user['id'], 'money', $this->_site['signmoney'], 2);
										
					//浏览记录
					$read = M('readhistory')->where(array('user_id'=>$this->user['id'],'ismax'=>2))->order('create_time desc')->find();
					
					if($read){
						$url = U('Index/readAnime',array('anid'=>$read['anid'],'chaps'=>$read['chaps']));
						$url = complete_url($url);
						$a = "\n\n".'<a href="'.$url.'">点击我继续上次阅读</a>'."\n\n";
						
						//历史阅读记录
						$li = "历史阅读记录\n\n";
						$lishi = M('readhistory')->distinct(true)->field('anid')->where(array('anid'=>array('neq',$read['anid']),'user_id'=>$this->user['id']))->limit(5)->select();
						if($lishi){
							foreach($lishi as $v){
								$max = M('readhistory')->where(array('ismax'=>2,'anid'=>$v['anid']))->find();
								$url = U('Index/readAnime',array('anid'=>$max['anid'],'chaps'=>$max['chaps']));
								$url = complete_url($url);
								$li .= '<a href="'.$url.'">>'.$max['title'].'</a>'."\n\n";
							}
						}else{
							$li ="";
						}
					}
					$html = '本次签到成功，赠送'.$this->_site['signmoney'].'书币，请明天继续签到哦!'.$a.$li.'为方便下次阅读，请置顶公众号';
					send_msg($this->_mp,$this->user['openid'],$html);
					$this->ajaxReturn(array('status'=>1,'info'=>'签到成功','smoney'=>$this->_site['signmoney']));
				}else{
					$this->error('签到失败');
				}
		   }
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//获取个人账单明细
	public function getReport(){
		if(IS_POST){
			$type = I('post.type')?I('post.type'):1;
			$page = I('post.page')?I('post.page'):1;
			$start = ($page - 1)*10;
			$where['user_id'] = $this->user['id'];
			if($type == 1){
				$where['status'] = 2;
				$list = M('charge')->where($where)->order('create_time desc')->limit($start,10)->select();
			}elseif($type == 2){
				$list = M('sign')->where($where)->order('create_time desc')->limit($start,10)->select();
			}else{
				$where['action'] = 5;
				$list = M('share')->where($where)->order('create_time desc')->limit($start,10)->select();
			}
			if($list){
				$this->assign('type',$type);
				$this->assign('list',$list);
				$html = $this->fetch();
				$this->success($html,M()->getLastSql());
			}else{
				$this->error('没有该类数据！',M()->getLastSql());
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	
	//加载漫画分集
	public function loadMoreChaps(){
		if(IS_POST){
			$page = I('post.page')?I('post.page'):2;
			$id = I('post.id');
			$info = M('anime')->find(intval($id));
			if(!$info || !$id){
				$this->error('数据错误！');
			}
			
			$start = ($page - 1)*15 + 1;
			$end = ($page)*15;
			
			if($end>=$info['allchapter']){
				$end = $info['allchapter'];
			}
			$html = '';
			for($i=$start;$i<=$end;$i++){
				$chaps = M('anime_chapter')->where(array('anid'=>$info['id'],'chaps'=>$i))->find();
				if($chaps['coverpic']){
					$imgs[0] = $chaps['coverpic'];
				}else{
					$imgs = explode(",",$chaps['info']);
				}
				
				//判断是否付费
               // if($i>=$info['paychapter'] && $info['isfw'] == 1){
				if($i>=$info['paychapter']){
					$read = M('readhistory')->where(array('user_id'=>$this->user['id'],'anid'=>$info['id'],'chaps'=>$i))->find();
					$html.='<li onclick="chooseChaps('.$id.','.$i.');">';
					$html.='<img class="coverimg" src="'.$imgs[0].'" />';
					$html.='<div class="txts">';
					$html.='<h1>'.$chaps['title'].'</h1>';
					if(!$read){
						$html.='<p><img class="doll" src="./Public/home/images/doll.png" />'.intval($info['money']).' 书币</p>';
					}
					$html.='<span>'.date('Y-m-d',$chaps['create_time']).'</span>';
					$html.='</div>';
					$html.='</li>';
				}else{
					$html.='<li>';
					$html.='<img class="coverimg" src="'.$imgs[0].'" />';
					$html.='<div class="txts">';
					$html.='<h1>'.$chaps['title'].'</h1>';
					$html.='<span>'.date('Y-m-d',$chaps['create_time']).'</span>';
					$html.='</div>';
					$html.='</li>';
				}
			}
			if($html!=""){
				$this->success($html,$start.'-'.$end);
			}else{
				$this->error("没有更多章节了！",$start.'-'.$end);
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//评论
	public function commentsAdd(){
		if(IS_POST){
			$anid = I('post.anid');
			$content = I('post.content');
			$cid = I('post.cid');
			//小说漫画信息
			$info = M('anime')->find(intval($anid));
			if(M('comments')->add(array(
				"user_id"=>$this->user['id'],
				"headimg"=>$this->user['headimg'],
				"nickname"=>$this->user['nickname'],
				"content"=>$content,
				"cid"=>$cid,
				"anid"=>$anid,
				"create_time"=>time(),
				"btype"=>$info['btype'],
				"title"=>$info['title'],
				"coverpic"=>$info['coverpic'],
			))){
				$this->success('评论成功！');
			}else{
				$this->error('评论失败！');
			}
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//购买视频
	public function buyVideo(){
		if(IS_POST){
			$vid = I('post.vid');
			$info = M('video')->find(intval($vid));
			
			if($this->user['money']<$info['money']){
				$this->error("您的阅读币不足，是否进行充值？",U('Index/charge'));
			}else{
				M('user_video')->add(array(
					"vid"=>$vid,
					"user_id"=>$this->user['id'],
					"create_time"=>time(),
				));
				M('user')->where(array('id'=>$this->user['id']))->setDec('money',$info['money']);
				//记录
				flog($this->user['id'], "money", 0-$info['money'], 6,0,0);
				$this->success('支付成功！');
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//购买名家经典
	public function buySeller(){
		if(IS_POST){
			$id = I('post.id');
			$nums = I('post.nums');
			$info = M('seller')->find(intval($id));
			
			$total = $nums * $info['money'];
			if($this->user['money']<$total){
				$this->error("您的阅读币不足，是否进行充值？",U('Index/charge'));
			}else{
				M('user_seller')->add(array(
					"sid"=>$id,
					"user_id"=>$this->user['id'],
					"nickname"=>$this->user['nickname'],
					"coverpic"=>$info['coverpic'],
					"title"=>$info['title'],
					"money"=>$info['money'],
					"total"=>$total,
					"nums"=>$nums,
					"create_time"=>time(),
				));
				M('user')->where(array('id'=>$this->user['id']))->setDec('money',$info['money']);
				//记录
				flog($this->user['id'], "money", 0-$info['money'], 7,0,0);
				$this->success('购买成功！');
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//建议反馈
	public function feedBack(){
		if(IS_POST){
			$content = I('post.content');
			$mobile = I('post.mobile');
			$data = array(
				'user_id'	=> $this->user['id'],
				'nickname'	=> $this->user['nickname'],
				'mobile'	=> $mobile,
				'content'	=> $content,
				'create_time'=>NOW_TIME,
			);

			M('feedback')->add($data);
			$this->success('反馈成功！');
		}else{
			$this->error('非法请求！');		
		}
	}
	
	
	//自动购买付费章节
	public function autoBuy(){
		if(IS_POST){
			$autoBuy = $this->user['autobuy']?0:1;
			M('user')->where(array('id'=>$this->user['id']))->save(array('autobuy'=>$autoBuy));
			$this->success('操作成功！');
		}else{
			$this->error('非法请求！');		
		}
	}
	
	
	//获取消息数据
	public function getUmsg(){
		if(IS_POST){
			$page = I('post.page')?I('post.page'):1;
			$start = ($page - 1)*10;
			$list = M('umsg')->where($where)->order('create_time desc')->limit($start,10)->select();
			if($list){
				$this->assign('list',$list);
				$html = $this->fetch();
				$this->success($html);
			}else{
				$this->error('没有该类数据！');
			}
			
		}else{
			$this->error('非法请求！');
		}
	}
	
	
	//同步更新微信资料
	// 同步个人资料
	public function sync_profile(){
		$dd = new \Common\Util\ddwechat;
		$dd -> setParam($this -> _mp);
		$user_info = $dd -> getuserinfo($this -> user['openid']);
		if(!$user_info){
			$msg = APP_DEBUG ? $dd -> errmsg : '同步失败';
			$this -> error($msg);
		}
		
		M('user') -> save(array(
			'id' => $this -> user['id'],
			'nickname' => $user_info['nickname'],
			'sex' => $user_info['sex'],
			'headimg' => $user_info['headimgurl']
		));
		$this -> success(array('nickname'=>$user_info['nickname'],'headimg'=>$user_info['headimgurl']));
	}
	
	
	
	
}