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
		//sms("18679176380","测试短信发送");
		
        $ok = array(
            "/Public/file/iix/45/20016/448256.jpg",
            "/Public/file/iix/45/20016/448257.jpg",
            "/Public/file/iix/45/20016/448258.jpg",
            "/Public/file/iix/45/20016/448259.jpg"
        );
        
        //if($this->user['vip']>0)
        $ok = str_replace("/Public/file","https://oss.biquyx.com",$ok);
        print_r($ok);
        echo("<div>user_vip=".intval($this->user['vip']) .  "<img width=600 src=".$ok[1]." /></div>");
        echo("<div>user_vip=".intval($this->user['vip']) .  "<img width = 600 src=".$ok[1]."?x-oss-process=image/resize,p_30 /></div>");
        echo("<div>user_vip=".intval($this->user['vip']) .  "<img width = 100 src=".$ok[1]."?x-oss-process=image/indexcrop,y_100,i_2/resize,w_100 /></div>");
        echo("<div>user_vip=".intval($this->user['vip']) .  "<img width = 100 src=".$ok[1]."?x-oss-process=image/resize,w_100 /></div>");
		
	}
	
	public function cate(){
	   $this->success("<sss><p><id>1</id><t>类别1</t></p><p><id>2</id><t>类别2</t></p><p><id>3</id><t>类别3</t></p></sss>");
	}
	
	/**
	 * 保存文件
	 *
	 * @param string $fileName 文件名（含相对路径）
	 * @param string $text 文件内容
	 * @return boolean
	 */
	protected function saveFile($fileName, $text) {
	    
		if (!$fileName || !$text)
			return false;
		if ($this -> makeDir(dirname($fileName))) {
			if ($fp = fopen($fileName, "w")) {
				if (@fwrite($fp, $text)) {
					fclose($fp);
				
					return true;
				} else {
					fclose($fp);
					return false;
				}
			}
		}
		return false;
	}

	/**
	 * 连续创建目录
	 *
	 * @param string $dir 目录字符串
	 * @param int $mode 权限数字
	 * @return boolean
	 */
	protected function makeDir($dir, $mode=0777) {
		 /*function makeDir($dir, $mode="0777") { 此外0777不能加单引号和双引号，
	 加了以后，"0400" = 600权限，处以为会这样，我也想不通*/
		if (!dir) return false;
		if(!file_exists($dir)) {
		    
			$x= mkdir($dir,$mode,true);
			return $x;
		} else {
			return true;
		}
	}
	
	public function saveChap2File($bid,$ji_no,$info){
	    $no =intval ($bid/1000) ;
	    $fileName = $this->_site['txtdir'].$no."/".$bid."/".$ji_no.".txt";
	    $this -> saveFile($fileName,$info);
	}
	
	public function saveCoverPic($bid,$filename){
	    $no  =intval ($bid/1000) ;
	    $ext =pathinfo($filename,PATHINFO_EXTENSION); 
	    
	    //$desname=trim($this->_site['txtdir'].$no."/".$bid."/".$bid."s.".$ext);
	    $desname=trim("/Public/file/cover/".$bid."s.".$ext);
	    /*$dirok=$this->makeDir(dirname($desname));
	    
	    
	    //$content = @curl_file_get_contents($filename);
	    
	    //if($dirok&&$content)
	    {
	    //    @file_put_contents($desname, $content);
	    }
	    
	    $opts = array(
          "http"=>array(
          "method"=>"GET",
          "header"=>"",
          "timeout"=>30)
        );
        $context = stream_context_create($opts);
        
        if(@copy($filename, $desname, $context)) {
          //$http_response_header
          //return $file;
        }
        
	    die("这里".$desname."那里".$filename);*/
	    return $desname;
	    //return "/Public/file/txt/".$no."/".$bid."/".$bid."s.".$ext;;
	    
	    //$this->success("OK");
	    
	}
	
	//采集上传增加书的接口，必须保证bid的唯一性。
	public function addBook(){
	   if(IS_POST){
	      if(!$_POST['bid'])
	      {
	           die("Book info have mistakes: 书号：".$_POST['bid']." 封面图： ".$_POST['cover_pic']);
	      }
	      
	      $bid =intval( $_POST['bid']);
	      //die(var_dump($_POST));     
	           
		  $find = M('book')->where('id='.$bid)->find();
	      if($find)
	      {//只增加不更新，避免覆盖掉人工的编辑成果。
	         // M('book')->where('id='.$bid)->save($_POST); 
	         return true;
	      }
	      
	      {//如果找不到，是新增的，到这里来。
	         $_POST['id'] = $bid;
	         // unset($_POST['bid']);
    	      //封面图送进来一个有效url就行，会自动转储到本地。
    	     $des = $this -> saveCoverPic($bid,$_POST['cover_pic']);
    	      
    	     $_POST['cover_pic']=$des;
    	   
    	     $_POST['detail_pic']=$_POST['cover_pic'];
    	     $_POST['share_pic']=$_POST['cover_pic'];
    	     $_POST['share_desc']= $_POST['summary'];
    	     $_POST['update_time'] = NOW_TIME;
	         $_POST['create_time'] = NOW_TIME;
             // 漫画阅读数（3万-70万之间）
             $reads_mh=mt_rand(30000, 700000);
             // 漫画点赞数（1万-2万之间）
             $dz_mh=mt_rand(10000, 20000);
             // 章节点赞数（1万-2万之间）
             $dzzj_mh=mt_rand(10000, 20000);
             // 收藏数（5000-9000之间）
             $sc_mh=mt_rand(5000, 9000);
             // 打赏数（1000-5000之间）
             $ds_mh=mt_rand(1000, 5000);
             // 小说阅读数（1万-10万之间）
             $reads_book=mt_rand(10000, 100000);
             // 小说点赞数（3000-1万之间）
             $dz_book=mt_rand(3000, 10000);
             // 章节点赞数（3000-1万之间）
             $dzzj_book=$dz_book;
             // 收藏数（3000-5000之间）
             $sc_book=mt_rand(3000, 5000);
             // 打赏数（1000-3000之间）
             $ds_book=mt_rand(1000, 3000);
                
	         M('book')->add(array(
	             'id'=>$bid,
	             'title'=>$_POST['booktitle'],
	             'author'=>$_POST['author'],
	             'summary'=>$_POST['summary'],
	             'cover_pic'=>$_POST['cover_pic'],
	             'detail_pic'=>$_POST['cover_pic'],
	             
	             'cateids'=>$_POST['cateids'],
	             'bookcate'=>$_POST['bookcate'],
	             'send'=>$sc_mh,
	             'sort'=>1,
	             'status'=>$_POST['status'],
	             'free_type'=>$_POST['free_type'],
	             
	             'episodes'=>0,
	             'pay_num'=>0,
	             'reader'=>$reads_book,
	             'likes'=>$dz_book,
	             'collect'=>$sc_book,
	             
	             'is_new'=>0,
	             'is_recomm'=>0,
	             
	             'create_time'=>NOW_TIME,
	             'update_time'=>NOW_TIME,
	             'readnum'=>0,
	             'chargenum'=>0,
	             'chargemoney'=>0,
	             
	             'share_title'=>$_POST['booktitle'],
	             'share_pic'=>$_POST['cover_pic'],
	             'share_desc'=>$_POST['summary']
	         
	         )); 
	         
	         return true;
	      }
	      
	      
	    
	   }
	   //echo ("OK");
	   return  false;
	}	
	
	// 编辑、添加小说分集
	public function episodesedit(){
	    
	    $this->addBook();
	    
		$bid = I('bid', 0, 'intval');
		if(IS_POST){
			$bid   = I('post.bid');
			$ji_no = I('post.ji_no', 0, 'intval');
		    $cont  = I('post.info', "", 'string');
		    $this->saveChap2File($bid,$ji_no,$cont);
		    $_POST['info']=""; //存储到文件中，不存储到数据库中。
		    
		    $rs = M('book_episodes') -> where(array('bid'=>intval($bid),'ji_no'=>intval($ji_no))) ->find();
		    
			if($rs) { // 修改
			    //unset($_POST['id']);
				$_POST['update_time'] = NOW_TIME;
				$rs = M('book_episodes') -> where('id='.intval($rs['id'])) -> save(array(
				    'title'=>$_POST['title'],
				    'info'=>$_POST['info'],
				    ));
			} else { // 添加
				$_POST['create_time'] = NOW_TIME;
				$_POST['update_time'] = NOW_TIME;
				$_POST['bid'] = $bid;
				$rs = M('book_episodes') -> add(array(
				    'title'=>$_POST['title'],
				    'info'=>$_POST['info'],
				    'bid'=>$bid,
				    'ji_no'=>$ji_no
				    ));
			}
			
			$cnt = M('book_episodes')->where("bid={$bid}")->count();
			M('book')->where("id={$bid}")->setField(array('episodes'=>$cnt,'update_time'=>NOW_TIME));
			
			$this -> success('操作成功！', U('episodes')."&bid={$bid}");
			exit;
		}
	

	}	
	
	//给指定类型的漫画pay_num赋值
	public function setPaynum(){
	    //die("此工具函数已经停用，需要启用联系管理员");
	    //选出要处理的书，目前的条件是类型为8，韩漫。
	    $where['mhcate']= array('like',"%8%");
	    $find = M('mh_list')->field('id')->where($where)->select();
       
        $kt = 1;
        $num = 6;
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
	
	
	private function push_article($urls){
	    
	 $tokens=array (
	     'www.biquyx.com'=>'kE0yTYA79GDby5hZ',
         'm.biquyx.com'=>'kE0yTYA79GDby5hZ',
         'xxs.haogame98.com'=>'kE0yTYA79GDby5hZ'
     );
     
     $token = $tokens[$_SERVER['HTTP_HOST']];
     $root  = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
    	
     $api = "http://data.zz.baidu.com/urls?site=".$root."&token=".$token;
     $ch = curl_init();
     $options =  array(
     CURLOPT_URL => $api,
     CURLOPT_POST => true,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_POSTFIELDS => implode("\n", $urls),
     CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
     );
     curl_setopt_array($ch, $options);
     $result = curl_exec($ch);
     $result= $result."\n";
    
     //print_r($urls);
     //echo($result);
     return $result;	
    }
	
	//G:\www\bxs\api 主动向百度推送更新 
	public function baidu_push(){
	    $root = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
	    $list = array();
	    
	    $list[]= $root.'/Mh/index.html';
	    $list[]= $root.'/Book/index.html';
	    $list[]= $root."/Mh/mhlist/cate/5.html";
	    $list[]= $root."/Mh/mhlist/cate/6.html";
	    $list[]= $root."/Mh/mhlist/cate/7.html";
	    $list[]= $root."/Mh/mhlist/cate/8.html";
	    $list[]= $root."/Mh/book_free.html";
	    $list[]= $root."/Mh/book_last.html";
	    $list[]= $root."/Mh/book_hot.html ";
	    $list[]= $root."/Mh/book_hot/order/time.html";
	    $list[]= $root."/Mh/book_hot/order/overs.html";
	    $list[]= $root."/Mh/book_hot/order/free.html";
	    $list[]= $root."/Mh/book_hot/order/cate1.html";
	    $list[]= $root."/Mh/book_hot/order/cate2.html";


	    
	    $mhlist = M('mh_list')->order('update_time desc')->field('id,title,update_time')->select();      
        foreach ($mhlist as $k=>$v){
            $list[]= $root.'/Mh/'.$v['id'].'.html' ;
        }
        $bklist = M('book')->order('update_time desc')->field('id,title,update_time')->select();  
        foreach ($bklist as $k=>$v){
            $list[]= $root.'/Book/'.$v['id'].'.html';
        }
	    
	    

	    echo $this->push_article($list);
	}
	
	//G:\www\bxs\api 生成sitmap，方便搜索引擎 
	public function  site_map(){
	        $root = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
	        $list = array();
	        
	        //首页
	        $list[]=array(
	            'url'=>$root.'/Mh/index.html',
	            'title'=>'漫画主页',
	            'update_time'=>date(DATE_ATOM,NOW_TIME),
	            'changefreq'=>'always',
	            'priority'=>1.0
	            );
	       
	       $list[]= array(
	            'url'=>$root.'/Book/index.html',
	            'title'=>'小说主页',
	            'update_time'=>date(DATE_ATOM,NOW_TIME),
	            'changefreq'=>'always',
	            'priority'=>1.0
	            );
	       
	       //几个主题页     
	       $some =array(     
	           array( $root."/Mh/mhlist/cate/5.html", "大家都在看漫画全集"),
	           array( $root."/Mh/mhlist/cate/6.html", " 热门推荐漫画全集"),
	           array( $root."/Mh/mhlist/cate/7.html", " 国漫精粹漫画全集"),
	           array( $root."/Mh/mhlist/cate/8.html", " 韩国漫画漫画全集"),
	           array( $root."/Mh/book_free.html", "    2021年度十大免费漫画全集"),
	           array( $root."/Mh/book_last.html", "    2021年度最新十大漫画排行榜"),
	           array( $root."/Mh/book_hot.html ", "    2021年度十大热门人气漫画排行榜"),
	           array( $root."/Mh/book_hot.html?order=time", " 2021年度十大热门最新上架漫画排行榜"),
	           array( $root."/Mh/book_hot.html?order=overs", " 2021年度十大热门完结漫画排行榜"),
	           array( $root."/Mh/book_hot.html?order=free", " 2021年度十大免费漫画排行榜"),
	           array( $root."/Mh/book_hot.html?order=cate1", " 2021年度十大男性向漫画排行榜"),
	           array( $root."/Mh/book_hot.html?order=cate2", " 2021年度十大女性向漫画排行榜")
	        );
	        
	       foreach ($some as $k=>$v){
	           $list[] = array(
	                'url'=>$v[0],
	                'title'=>$v[1],
	                'update_time'=>date(DATE_ATOM,NOW_TIME),
	                'changefreq'=>'weekly',
	                'priority'=>0.9
	               );
	       }
	         
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