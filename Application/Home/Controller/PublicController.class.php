<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
	public function _initialize(){
		// 加载配置
		$config = M('config') -> select();
		if(!is_array($config)){
			die('请先在后台设置好各参数');
		}
		foreach($config as $v){
			$key = '_'.$v['name'];
			$this -> $key = unserialize($v['value']);
			$_CFG[$v['name']] = $this -> $key;
		}
		$this -> assign('_CFG', $_CFG);
		$GLOBALS['_CFG'] = $_CFG;
	}
	
	public function regist(){
		if(IS_POST){
			$post = I('post.');
			$find = M('member')->where(array('mobile'=>$post['mobile']))->find();
			if($find){
				$this->error('该手机号已被注册！');
			}
			//判断验证码
			if(session('code.value') != $post['code']){
				$this->error('短信验证码错误！');
			}
			
			$post['salt'] = Salt();
			$post['imei'] = xmd5($post['salt']);
			$post['create_time'] = NOW_TIME;
			
			$qrcode = $this->qrcode($post['imei']);
			$post['url'] = $qrcode['url'];
			$post['qrcode'] = $qrcode['qrcode'];
			$post['password'] = xmd5($post['tpassword']);
			$id = M('member')->add($post);
			if($id){
				$this->success("注册成功，请登录PC代理端后台进行登录！");
			}else{
				$this->error("注册失败!");
			}
			exit;
		}
		$this->display();
	}
	
	//生成二维码
	public function qrcode($imei){
		//获取推广码信息

		$path_info = getAgentQrcode($imei);		
		$url = "http://".$_SERVER['HTTP_HOST'].__ROOT__."/index.php?imei=".$imei;
		if(!is_file($path_info['qrcode'])){
			include COMMON_PATH.'Util/phpqrcode/phpqrcode.php';
			// 目录不存在则创建
			if(!is_dir($path_info['path'])){
				mkdir($path_info['path'], 0777,1);
			}
			$errorCorrectionLevel = 'L';
			$matrixPointSize = 6;
			\QRcode::png($url, $path_info['qrcode'], $errorCorrectionLevel, $matrixPointSize, 2);	
		}
		return array(
			'url'=>$url,
			'qrcode'=>$path_info['qrcode'],
		);
	}
	
	//发送短信验证码
	public function SendSms(){
		if(IS_POST){
			$mobile = I('post.mobile');
			$code = rand(100000,999999);
			session('code',array('value'=>$code,'expire'=>1800));
			$content = '您的短信码为：'.$code.',请在三十分钟内及时认证!';
			$return = sms($mobile,$content);
			if($return!=1){
				$this->error($return);
			}else{
				$this->success('发送成功,请注意手机查收！');
			}
		}else{
			$this->error('非法请求');
		}
	}
	
	public function test(){
		sms("18679176380","测试短信发送");
	}
	
	//给指定类型的漫画pay_num赋值
	public function setPaynum(){
	    die("此工具函数已经停用，需要启用联系管理员");
	    //选出要处理的书，目前的条件是类型为8，韩漫。
	    $where['mhcate']= array('like',"%8%");
	    $find = M('mh_list')->field('id')->where($where)->select();
       
        $kt = 1;
        $num = 10;
        $res = array();
	    foreach ($find as $k=>$v){
	      //找出对应的章节，按从小到大排序
	      $efind = M('mh_episodes')->field("id,mhid,ji_no,title")->where(array('mhid'=>$v['id']))->order('ji_no ASC')->limit(0,$num+2) ->select();
	      
	      $paynum = "0";
	      if(isset($efind[$num]['ji_no']))
	        $paynum = $efind[$num]['ji_no'] ;
	      
	      //把pay_num设置成第四章的ji_no
	      M('mh_list')->where(array('id'=>$v['id']))->save(array(
	           'pay_num' =>$paynum
	          ));
	      $kt =   $kt +1;
	      $res[$v['id']]=$paynum;
	    }
	    var_dump($res);
	    die("停住,共处理：".$kt);
	    
	}
	
	// 阅读文章
	public function read(){
		$id = intval($_GET['id']);
		$info = M('arclist')-> find($id);
		$this -> assign('info', $info);
		$this -> display();		
	}
	
	//推荐系统，广告系统
	public function ad(){
	   if(IS_GET){
	       $pid = I('get.pid',0); //默认是0 
	    }
	    die("pid=".$pid);
	    
	}
	
	
	//G:\www\bxs\api 主动向百度推送更新 
	public function baidu_push(){
	    
	}
	
	//G:\www\bxs\api 生成sitmap，方便搜索引擎 
	public function  site_map(){
	        $root = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
	        $list = array();
	        
	        $list[]=array(
	            'url'=>$root.'/Mh/index.html',
	            'title'=>'漫画主页',
	            'update_time'=>date(DATE_ATOM,time()),
	            'changefreq'=>'always',
	            'priority'=>1.0
	            );
	        
	       $list[]= array(
	            'url'=>$root.'/Book/index.html',
	            'title'=>'小说主页',
	            'update_time'=>date(DATE_ATOM,time()),
	            'changefreq'=>'always',
	            'priority'=>1.0
	            );
	         
	         
	    $mhlist = M('mh_list')->order('update_time desc')->field('id,title,update_time')->select();      
        foreach ($mhlist as $k=>$v){
            
            $list[]= array(
	            'url'=>$root.'/Mh/'.$v['id'].'.html',
	            'title'=>$v['title'],
	            'update_time'=>date(DATE_ATOM,$v['update_time']),
	            'changefreq'=>'weekly',
	            'priority'=>0.8
	        );
            
        }
        
        $bklist = M('book')->order('update_time desc')->field('id,title,update_time')->select();  
        foreach ($bklist as $k=>$v){
            
            $list[]= array(
	            'url'=>$root.'/Book/'.$v['id'].'.html',
	            'title'=>$v['title'],
	            'update_time'=>date(DATE_ATOM,$v['update_time']),
	            'changefreq'=>'weekly',
	            'priority'=>0.8
	        );
            
        }
        
        /*
        $fp = fopen("/sitemap.xml", "w");
        if ($fp) {
				if (@fwrite($fp, $this->fetch())) {
					fclose($fp);
				}
        }
        */
	    $this->assign('list',$list);
	    $this->display();
	    
	    /* //谷歌sitemap标准
	    <urlset xmlns=“网页列表地址”>
        <url>
            <loc>网址</loc>
            <lastmod>2005-06-03T04:20-08:00</lastmod>
            <changefreq>always</changefreq>
            <priority>1.0</priority>
        </url>
        <url>
            <loc>网址</loc>
            <lastmod>2005-06-02T20:20:36Z</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
        </urlset>
	    */
	    
	    /*  //百度sitemap标准
        <?xml version="1.0" encoding="UTF-8"?>
        <urlset>
            <url>
                <loc>网页地址</loc>
                <lastmod>2010-01-01</lastmod>
                <changefreq>daily</changefreq>
                <priority>1.0</priority>
            </url>
        </urlset>	    
	    
	    */
	}
	
}