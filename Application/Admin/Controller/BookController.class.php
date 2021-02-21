<?php
namespace Admin\Controller;
use Think\Controller;
class BookController extends AdminController {
    // 列表
	public function index(){
		if($_POST['title']){
			$_GET['p'] = 1; //如果是post的话回到第一页
			$_GET['title'] = $_POST['title'];
			$where['title'] = array('like','%'.$_POST['title'].'%');
		}
		$order = "update_time desc";
		// 组合排序方式
		if(in_array($_GET['order'], array('id','readnum','chargenum', 'chargemoney'))){
			$type = $_GET['type'] == 'asc' ? 'asc' : 'desc';
			$order = $_GET['order'].' '.$type;
		}
		$this -> _list('book',$where, $order);
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
	public function chaptsort(){
	    $bid = I('get.id');
	    
	   
	    //查询小说最大章节
		$maxjino = M('book_episodes')->where(array('bid'=>$bid))->max('ji_no'); 
		
		//die("/book/".$bid.'/'.$maxjino.".html");
    	redirect("/Book/".$bid.'/'.$maxjino.".html");
		exit;
		
	    
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
	    if(!$filename) $ext = ".jpg";
	    
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
	
	public function getChapContent($bid,$ji_no){
	    $no =intval ($bid/1000) ;
	    $fileName = $this->_site['txtdir'].$no."/".$bid."/".$ji_no.".txt";
	    
	   if(file_exists($fileName)){
				$content = @file_get_contents($fileName);
				$content = @str_replace("\r\n","<br/>",$content);
				$content = @str_replace(" ","&nbsp;",$content);
				return $content;
		}
			else{
				return "章节TXT文件不存在，请检查！";
				//die();
		}
	    
	    return $cont;
	    
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
	      if(!$find)
	      {
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
	      else{//只增加不更新，避免覆盖掉人工的编辑成果。
	         // M('book')->where('id='.$bid)->save($_POST); 
	         return true;
	      }
	      
	    
	   }
	   //echo ("OK");
	   return  false;
	}
	
	//临时的工具函数，把数据库中的info转存到文件中。
	protected function _rtChapt(){
	    die("这个工具已经停用，需要使用请联系超级管理员");
	    $clist = M('book_episodes')->where("1")->select();
	    
	    foreach ($clist as $t){
	        $bid = $t['bid'];
	        $ji_no = $t['ji_no'];
	        $this->saveChap2File($bid,$ji_no,$t['info']);
	        
	    }
	    die("OK");
	    
	}
	
	// 手工编辑、添加小说
	public function edit(){
		if(IS_POST){
			$cateids = implode(',', $_POST['arrcateids']);
			unset($_POST['arrcateids']);
			$_POST['cateids'] = $cateids;
			
			$bookcate = implode(',', $_POST['bookcate']);
			unset($_POST['bookcate']);
			$_POST['bookcate'] = $bookcate;
			
			// 修改
			if(isset($_GET['id'])){
				$_POST['update_time'] = NOW_TIME;
				$rs = M('book') -> where('id='.intval($_GET['id'])) -> save($_POST);
		
				$product_id = intval($_GET['id']);
				//$this->success('操作成功！');
			}else{
			    //新建
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
				$_POST['create_time'] = NOW_TIME;
				$_POST['update_time'] = NOW_TIME;
				$_POST['reader']  =$reads_book;
	            $_POST['likes']   =$dz_book;
	            $_POST['collect']=$sc_book;
	            
				$rs = M('book') -> add($_POST);
				$des = $this -> saveCoverPic($rs,$_POST['cover_pic']);
    	      
    	        $_POST['cover_pic']=$des;
    	        $_POST['detail_pic']=$_POST['cover_pic'];
    	        $_POST['share_pic']=$_POST['cover_pic'];
    	     
				$product_id = $rs;
				$_GET['id'] = $rs;
				
				M('book') -> where('id='.$rs) -> save(array(
	                'cover_pic'=>$_POST['cover_pic'],
	                'detail_pic'=>$_POST['cover_pic'],
	                'share_title'=>$_POST['title'],
	                'share_pic'=>$_POST['cover_pic'],
	                'share_desc'=>$_POST['summary']
				     
				     ));
			}
			
			if(!$product_id){
			    $this->error("小说参数错误，没有相应的小说ID");
			}
			//若上传了分集压缩包
			//(每一章单独一个小文件，文件名用章节id，文件内容是“章节标题###章节内容”,然后所有文件打包成一个zip。
			//zip文件不带根目录，这个zip文件解压后，是把所有章节文件放在与zip文件相同的目录下。
			if(!empty($_FILES['cert']["name"])){
			    
			    $this -> error('不要用\"分集压缩包\"，章节多的时候非常容易出错!');
			    die();
			    
			         $config = array(
                        'maxSize' => 100*1024*1024 ,
                        'exts' => array('zip','rar','jpg','png','gif','jpeg'),
                        'rootPath' => './Public/file/zip/',
                        'savePath' => $product_id.'/',
                        'saveName' => '',
                        'autoSub' => true,
                        'subName' => array('date','Ymd'),
                     );
                     $upload = new \Think\Upload($config);

					 
					 $info   =   $upload->upload();
					
    				 if($info){
						$info = $info['cert'];
						// 解压
						$path = $upload->rootPath . $info['savepath'];
						$file = $path . $info['savename'];
						if(file_exists($file)){
							// 打开压缩文件
							$zip = new \ZipArchive();
							$rs = $zip -> open($file);
							if($rs && $zip -> extractTo($path)){
								$zip -> close();
								//解压完成之后删除
								unlink($file);
								$_POST['cert'] = $path;
							}else{
								$this -> error('解压失败!');
							}
						}else{
							$this -> error($upload->getError());
						}

					    $this->addEpisodes($path,$product_id);
					    $this -> success('上传章节文件操作成功！');
					
					}
					// $this -> success('操作成功！', U('index'));
				
				}
			
			
		//	exit;
		}
		
		if(intval($_GET['id'])>0) {
			$info = M('book') -> find($_GET['id']);
			$cateids = $info['cateids'];
			$arrcateids = explode(',', $cateids);
			$bookcate = explode(",",$info['bookcate']);
			$asdata = array(
					'info'			=> $info,
					'arrcateids'	=> $arrcateids,
					'bookcate'		=> $bookcate,
			);
			$this -> assign($asdata);
		}
		$this -> display();
	}
	
	public function addEpisodes($path,$bid){
		$temp = array();
		if (is_dir($path)) {

			$temp = array();
			if ($handle = opendir($path)) {
				$i = 1;
				while (false !== ($fp = readdir($handle))) {
					if ($fp != "." && $fp != "..") {
						$temp[] = $fp;
					}
				}
				closedir($handle);
				sort ($temp,SORT_NUMERIC);
				reset ($temp);
				foreach ($temp as $v) {
					$str = file_get_contents($path.$v);
					
					$info = explode('###',$str);
					$title =trim(substr($info[0],0,64));//章节标题最长64，过长的部分会被截断。
					
					$str = "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$info[1];

					$str = preg_replace('/\n|\r\n/','</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$str);

					$before = $i-1;
					$next = $i+1;
					
					$ji_no=pathinfo($path.$v, PATHINFO_FILENAME);
					
					// var_dump(iconv('GBK','UTF-8',$v));
					$str = iconv('GBK','UTF-8',$str);
					$title = iconv('GBK','UTF-8',$title);

					$ds = array(
						"bid"=>$bid,
						"title"=>$title,
						"ji_no"=>$ji_no,
						"info"=>"",
						"like"=>0,
						"before"=>0,
						"next"=>0,
						"money"=>0,
						"create_time"=>NOW_TIME,
						"update_time"=>NOW_TIME,
					);
					M('book_episodes')->add($ds);
					$this->saveChap2File($bid,$i,$str);
					$cnt = M('book_episodes')->where("bid={$bid}")->count();
			        M('book')->where("id={$bid}")->setField(array('episodes'=>$cnt,'update_time'=>NOW_TIME));
					$i++;
				}	
			}
		}
	}
	

	
	public function episodes() {
		$bid = I('bid', 0, 'intval');
		if(empty($bid)) {
			$this->error('ID不存在！', $_SERVER['HTTP_REFERER']);
		}
		$info = M('book')->where("id={$bid}")->find();
		$this->assign('info', $info);
		$this->assign('bid', $bid);
		$cond = array('bid'=>$bid);
		$this -> _list('book_episodes',$cond, 'id desc');
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
	
		if(intval($_GET['id'])>0) {
			$info = M('book_episodes') -> find($_GET['id']);
			
			$info['info'] = $this->getChapContent($info['bid'],$info['ji_no']);
			
			$asdata = array(
					'info'			=> $info,
			);
			$this -> assign('info',$info);
		}
		$book = M('book')->where("id={$bid}")->find();
		$this->assign('book', $book);
		$this->assign('bid', $bid);
		$this -> display();
	}
	
	
	// 删除小说
	public function del(){
		$this -> _del('book', $_GET['id']);
		$this -> success('操作成功！', $_SERVER['HTTP_REFERER']);
	}
	
	// 删除小说分集
	public function episodesdel(){
		$this -> _del('book_episodes', $_GET['id']);
		$this -> success('操作成功！', $_SERVER['HTTP_REFERER']);
	}
	
	//评论列表
	public function comments(){
		$cid = I('get.id');
		$this->_list("comment",array('cid'=>$cid,'type'=>"xs"),"create_time desc");
	}
		
	public function delComment(){
		$this -> _del('comment', $_GET['id']);
		$this -> success('操作成功！', $_SERVER['HTTP_REFERER']);
	}	
	
	public function addComment(){
		$cid = I('get.cid');
		if(IS_POST){
			$user = M('user')->order('rand()')->find();
			M('comment')->add(array(
				'headimg'=>$user['headimg'],
				'nickname'=>$user['nickname'],
				'user_id'=>$user['id'],
				'cid'=>$cid,
				'content'=>I('post.content'),
				'type'=>'xs',
				'create_time'=>time(),
			)); 
			$this->success('添加成功',U('comments',array('id'=>$cid)));
			exit;
		}
		$this->display();
		
	}
	
	
	//打赏列表
	public function sends(){
		$mxid = I('get.id');
		$this->_list("mxsend",array('mxid'=>$mxid,'type'=>"xs"),"create_time desc");
	}

}