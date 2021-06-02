<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends AdminController {
    // 漫画列表
	public function index(){
		if($_POST['title']){
			$_GET['p'] = 1; //如果是post的话回到第一页
			$_GET['title'] = $_POST['title'];
			$where['title'] = array('like','%'.$_POST['title'].'%');
		}
		$order = "sort desc,update_time desc";
		// 组合排序方式
		if(in_array($_GET['order'], array('id','readnum','chargenum', 'chargemoney','update_time'))){
			$type = $_GET['type'] == 'asc' ? 'asc' : 'desc';
			$order = $_GET['order'].' '.$type;
		}
		$this -> _list('mh_list',$where, $order);
	}
	
	public function chaptsort(){
	    $bid = I('get.id');
	    
	   
	    //查询小说最大章节
		$maxjino = M('mh_episodes')->where(array('mhid'=>$bid))->max('ji_no'); 
		
		//die("/book/".$bid.'/'.$maxjino.".html");
    	redirect("/Mh/".$bid.'/'.$maxjino.".html");
		exit;
		
	    
	}
	
	//改成按章节的名称来查找章节。为了适应换源带来的问题。
	//可能同一个章节，在不同的源中，有不同的ji_no。解决的办法是：用书名确定书，书id和章节名共同确定章节。
	public function addchapt()
	{
	    $binfo = $this->findComic();
	    if(!$binfo){
	        die('错误，没有书的信息，无法添加章节');
	    }
	    
	    if(IS_POST){
	        $bookname=$_POST['bookname'];//书名
            $author=$_POST['author'];//作者

    	    $bookid = $binfo['mhid'];//书id
    	    $chapid = $_POST['cid'];//章节id
    	    
    	    if(intval($chapid)<=0)
    	    {
    	    //    die('操作成功ok,没有章节ID，不增加新的章节');
    	    }
          
            $ctitle=$_POST['ctitle'];//漫画标题
            //$jino=$_POST['jino'];//漫画编号
            $mhbody=$_POST['content'];//漫画内容

      	    //$minfo = M('mh_episodes')->where(array('mhid'=>$bookid,'ji_no'=>$chapid))->find();
			$minfo = M('mh_episodes')->where(array('mhid'=>$bookid,'title'=>$ctitle))->find();
      	    
      	    if($minfo){
      	         M('mh_episodes')->where(array('mhid'=>$bookid,'title'=>$ctitle))
      	         ->save(array( 'title'=>$ctitle, 'pics'=>$mhbody,'update_time' => NOW_TIME )  );
      	         
      	    }else{
				//为了保证正常的章节顺序，避免错乱，新增的chapid必须是本书最大的ji_no+1 
				$chapid = M('mh_episodes')where(array('mhid'=>$bookid))->max('ji_no');
				$chapid = $chapid + 1;

      	        M('mh_episodes')->add( array(
      	               'mhid'=>$bookid,
      	               'ji_no'=>$chapid,
      	               'title'=>$ctitle,
      	               'pics'=>$mhbody,
      	               'create_time' => NOW_TIME,
				       'update_time' => NOW_TIME
      	              )); 
      	    }
      	    
      	  
	    
	      $cnt = M('mh_episodes')->where(array('mhid'=>$bookid))->count();
	      M('mh_list')->where(array('id'=>$bookid))->save(array('episodes'=>$cnt,'update_time' => NOW_TIME));  
	        
	    }
	    
	    die('操作成功OK');
	    
	}
	
	//根据情况修改。如果有bid书的id，就根据id找书，并不做过多处理。如果没有给bid，那么根据bookname找书，同名的书看做是同一本书。
	//（有可能不同的作者写了同名的一本书，这其实是两本书。或者同一本书被起了不同的名字，这些都不考虑了。）
	//这种情况能适应换采集源带来的书同名但是bid不同的问题，但是也能解决在同一个采集源之下，我自己换了改了书名，但是bid没有改变的问题。
	//要求是，上传书的时候，一定要上传方记住上传后真实的bid(mhid)，并且在下一次上传的时候使用。
	//漏洞：新源的bid可能在旧源已经使用，但是代表的是不同的书。
	public function findComic(){
	    if(IS_POST){
            $bookid = $_POST['bid'];//书id        	    
			$bookname=$_POST['bookname'];//书名
			$author=$_POST['author'];//作者
			$check =$_POST['check'];//仅检查，不创建新书

			if(!$bookname&&!$bookid){
			
				die("错误，没有漫画id，也没有漫画的名字和作者名字，没法搞")

			}

			$binfo = null;
	        if($bookid)
	        {
				$binfo = M('mh_list')->where(array('id'=>$bookid))->find();
	        }

			if(null==$binfo&&$bookname) //如果用id找书没有成功，那么按书名找书。
			{
				//根据书名找书
				$binfo = M('mh_list')->where(array('title'=>$bookname))->find();
			}
	        
			if($check) {
				if($binfo == null) 
				   die("没有找到 title='".$bookname."' 或者 mhid='".$bookid."'的漫画");

				return $binfo ;
			}
	        
	        if(!$binfo){//没有找到书，那么新建一本吧。

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
                
        	    $bookid = $_POST['bid'];//书id
        	    $chapid = $_POST['cid'];//章节id
                $des=$_POST['des'];//简介
                $tstype=$_POST['tstype'];//漫画首页分类
                $sstype=$_POST['sstype'];//所属分类
                //$zishu=$_POST['zishu'];//简介
                $litpic=$_POST['litpic'];//封面图
                //$time=$_POST['time'];//发布时间
                //$sharetitle=$_POST['sharetitle'];//发布时间
                //$mhtitle=$_POST['title'];//漫画标题
                //$jino=$_POST['jino'];//漫画编号
                //$mhbody=$_POST['content'];//漫画内容
                //$jine=$_POST['jine'];//阅读金额
                
                $sex=$_POST['sex'];//男生女生
                
                $send=$_POST['send'];//打赏金额
                $status=$_POST['status'];//小说状态(连载1/完结2)
                $free_type=$_POST['free_type'];//属性(免费1/收费2)
                $pay_num=$_POST['pay_num'];//第n话开始需要付费	   
                
              
	           $result = M('mh_list')->add(array(
	                //'id'=>$bookid,
	                'title'=>$bookname,
	                'mhcate'=>$tstype,//猜你喜欢
	                'send'=>$send,
	                'cateids'=>$sstype,//1总裁2穿越等等
	                'author'=>$author,
	                'summary'=>$des,
	                'notes'=>"",
	                'actors'=>"",
	                
	                'cover_pic'=>$litpic,
	                'detail_pic'=>$litpic,
	                'sort'=>1,
	                'status'=>$status,
	                'free_type'=>$free_type,
	                'episodes'=>0,
	                'pay_num'=>$pay_num,
	                'reader'=>$reads_book,
	                'likes'=>$dz_mh,
	                'collect'=>$sc_mh,
	                'is_new'=>1,
	                'is_recomm'=>1,
	                'readnum'=>$reads_book,
	                'chargenum'=>0,
	                'chargemoney'=>0,
	                
	                'share_title'=>$bookname,
	                'share_pic'=>$litpic,
	                'share_desc'=>$des,
	                'create_time' => NOW_TIME,
				    'update_time' => NOW_TIME
	                ));
	           //die("增加书名成功,返回值 ".$result);
	           $binfo = M('mh_list')->where(array('id'=>$result))->find();     
	          
	        }
	        
        
	         return $binfo;
	        
	    }
	    
	    return null;
	    
	}
	
	// 编辑、添加漫画
	public function edit(){
		if(IS_POST){	
			$mhcate = implode(',', $_POST['mhcate']);
			unset($_POST['mhcate']);
			$_POST['mhcate'] = $mhcate;
			$cateids = implode(',', $_POST['arrcateids']);
			unset($_POST['arrcateids']);
			$_POST['cateids'] = $cateids;
			// 修改
			if(isset($_GET['id'])){
				$_POST['update_time'] = NOW_TIME;
				$rs = M('mh_list') -> where('id='.intval($_GET['id'])) -> save($_POST);
		
				$product_id = intval($_GET['id']);
				$this->success('操作成功！');
			}
			// 添加
			else{
				$_POST['create_time'] = NOW_TIME;
				$_POST['update_time'] = NOW_TIME;
				$rs = M('mh_list') -> add($_POST);
				$product_id = $rs;
				
				//若上传了分集压缩包
				if(!empty($_FILES['cert'])){
					 $upload = new \Think\Upload();
					 $upload->maxSize   =     200*1024*1024 ;
					 $upload->exts      =     array('zip','rar');
					 $upload->rootPath  =     './Public/xiaoshuo/';
					 $upload->savePath  =     xmd5(time().rand()).'/';
					 $upload ->autoSub = false;
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
							$this -> error('系统没找到上传的文件');
						}
					}else {
						$this -> error('上传错误');
					}
					$this->addEpisodes($path,$product_id);
					$this -> success('操作成功！', U('index'));
					exit;
				}
			}
			
			

			$this -> success('操作成功！', U('index'));
			exit;
		}
		
		if(intval($_GET['id'])>0) {
			$info = M('mh_list') -> find($_GET['id']);
			$cateids = $info['cateids'];
			$arrcateids = explode(',', $cateids);
			$mhcate = explode(",",$info['mhcate']);
			$asdata = array(
					'info'			=> $info,
					'arrcateids'	=> $arrcateids,
					'mhcate'		=> $mhcate,
			);
			$this -> assign($asdata);
		}
		$this -> display();
	}
	
	public function addEpisodes($path,$mhid){
		$temp = array();
		if (is_dir($path)) {
			var_dump($path);
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
					$str = trim($str);
					$str = explode("\r\n", $str);
					//krsort($str);		
					$str = implode(",",$str);
					$before = $i-1;
					$next = $i+1;
					$title = trim(substr($v,0,-4));

					$str = iconv('GBK','utf-8',$str);
					$title = iconv('GBK','utf-8',$title);
					$ds = array(
						"mhid"=>$mhid,
						"title"=>$title,
						"ji_no"=>$i,
						"pics"=>$str,
						"like"=>0,
						"before"=>$before,
						"next"=>$next,
						"money"=>0,
						"create_time"=>time(),
						"update_time"=>0,
					);
					M('mh_list')->where(array('id'=>$mhid))->save(array('episodes'=>$i));
					M('mh_episodes')->add($ds);
					$i++;
				}	
			}
		}
	}
	
	public function episodes() {
		$mhid = I('mhid', 0, 'intval');
		if(empty($mhid)) {
			$this->error('漫画ID不存在！', $_SERVER['HTTP_REFERER']);
		}
		$mhinfo = M('mh_list')->where("id={$mhid}")->find();
		$this->assign('mhinfo', $mhinfo);
		$this->assign('mhid', $mhid);
		$cond = array('mhid'=>$mhid);
		$this -> _list('mh_episodes',$cond, 'id desc');
	}
	
	// 编辑、添加漫画分集
	public function episodesedit(){
		$mhid = I('mhid', 0, 'intval');
		
		if(IS_POST){
			/* $mhid = I('mhid', 0, 'intval');
			if(empty($mhid)) {
				$this->error('漫画ID错误！', $_SERVER['HTTP_REFERER']);
			} */

			if(isset($_GET['id'])) { // 修改
				$_POST['update_time'] = NOW_TIME;
				$rs = M('mh_episodes') -> where('id='.intval($_GET['id'])) -> save($_POST);
			} else { // 添加
				$_POST['create_time'] = NOW_TIME;
				$_POST['update_time'] = NOW_TIME;
				$rs = M('mh_episodes') -> add($_POST);
			}
			
			$cnt = M('mh_episodes')->where("mhid={$mhid}")->count();
			M('mh_list')->where("id={$mhid}")->setField('episodes', $cnt);
			
			$this -> success('操作成功！', U('episodes')."&mhid={$mhid}");
			exit;
		}
	
		if(intval($_GET['id'])>0) {
			$info = M('mh_episodes') -> find($_GET['id']);
			
			$asdata = array(
					'info'			=> $info,
			);
			$this -> assign($asdata);
		}
		$mhinfo = M('mh_list')->where("id={$mhid}")->find();
		$this->assign('mhinfo', $mhinfo);
		$this->assign('mhid', $mhid);
		$this -> display();
	}
	
	// 编辑漫画分集图片
	public function episodeseditpic() {
		$mhid = I('mhid', 0, 'intval');
		$id = I('id', 0, 'intval');
		$mhinfo = M('mh_list')->where("id={$mhid}")->find();
		$episodesinfo = M('mh_episodes')->where("id={$id}")->find();
		
		if(IS_POST){
			$pics = trim($_POST['body']);
			$pics = explode("\r\n", $pics);
			krsort($pics);		
			$pics = implode(",",$pics);
			M('mh_episodes')->where("id={$id}")->setField('pics', $pics);
			$this -> success('操作成功！', U('episodes')."&mhid={$mhid}");
			exit;
		}
		
		$arrpics = str_replace(",","\r\n",$episodesinfo['pics']);
		$asdata = array(
				'mhid'			=> $mhid,
				'mhinfo'		=> $mhinfo,
				'episodesinfo'	=> $episodesinfo,
				'arrpics'		=> $arrpics,
				'id'			=> $id,
		);
		
		$this -> assign($asdata);
		$this -> display();
	}
	
	// 根据attr_table格式化数据
	private function format($attr_table){
		if(!is_array($attr_table)){
			$attr_table = unserialize($attr_table);
		}
		// 属性种类数
		$attr_count = count($attr_table['attr']) / count($attr_table['price']);
		// 最后的结果
		$rows = array();
		foreach($attr_table['price'] as $key => $val){
			$attr_tmp = array();
			for($i=0; $i<$attr_count;$i++){
				$attr_tmp[] = $attr_table['attr'][$key*$attr_count+$i];
			}
			$rows[] = array(
				'attr' => implode(',', $attr_tmp),
				'price' => $attr_table['price'][$key],
				'stock' => $attr_table['stock'][$key],
				'code' => $attr_table['code'][$key]
			);
		}
		return $rows;
		
	}
	
	//评论列表
	public function comments(){
		$cid = I('get.id');
		$this->_list("comment",array('cid'=>$cid,'type'=>"mh"),"create_time desc");
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
				'type'=>'mh',
				'create_time'=>time(),
			)); 
			$this->success('添加成功',U('comments',array('id'=>$cid)));
			exit;
		}
		$this->display();
		
	}
	
	// 删除漫画
	public function del(){
		$this -> _del('mh_list', $_GET['id']);
		// 删除相关的属性
		//M('product_attr') -> where(array('product_id'=>intval($_GET['id']))) -> delete();
		$this -> success('操作成功！', $_SERVER['HTTP_REFERER']);
	}
	
	// 删除漫画分集
	public function episodesdel(){
		$this -> _del('mh_episodes', $_GET['id']);
		$this -> success('操作成功！', $_SERVER['HTTP_REFERER']);
	}
	
	/***以下是分类管理***/
	
	// 列表
	public function cate(){
		$list = M('product_cate') -> order('sort desc') -> select();
		$this -> assign('list', $list);
		$this -> display();
	}
	
	// 编辑
	public function cate_edit(){
		S('all_cate', null);
		$this -> _edit('product_cate',U('cate'));
	}
	
	// 删除
	public function cate_del(){
		S('all_cate', null);
		$this -> _del('product_cate', $_GET['id']);
		$this -> success('操作成功！', U('cate'));
	}
	
	
	//打赏列表
	public function sends(){
		$mxid = I('get.id');
		$this->_list("mxsend",array('mxid'=>$mxid,'type'=>"mh"),"create_time desc");
	}
}