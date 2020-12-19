<?php

namespace Admin\Controller;

use Think\Controller;
class AdminController extends Controller
{
    private function getGrant()
    {
        return;
        $url = "http://119.29.21.81/grant/grant.php?c=" . C('auth');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        if ($data == 1) {
            header('Content-Type: text/html; charset=utf-8');
            echo $data;
            exit;
        }
    }
    public function _initialize()
    {
        $this->getGrant();
        if (CONTROLLER_NAME != 'Index' && !session('?admin')) {
            $this->error('请登陆后操作!', U('Index/login'));
            exit;
        }
        if (substr(ACTION_NAME, 0, 1) == '_') {
            $this->error('访问地址错误！', U('Index/index'));
        }
        $config = M('config')->select();
        foreach ($config as $v) {
            $key = '_' . $v['name'];
            $this->{$key} = unserialize($v['value']);
            $_CFG[$v['name']] = $this->{$key};
        }
        $this->assign('_CFG', $_CFG);
        $GLOBALS['_CFG'] = $_CFG;
        $this->assign('murl', "http://" . $_SERVER['HTTP_HOST'] . __ROOT__ . "/index.php?m=");
    }
    public function welcome()
    {
        /**
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
		$where['mch'] = $this->mch['id'];
		
		
		//今日充值
		$this->assign('dcharge',M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-d'))),'status'=>2,'mch'=>$this->mch['id'],'separate'=>1))->sum('money'));
		//本月充值
		$this->assign('ycharge',M('charge')->where(array('create_time'=>array('egt',strtotime(date('Y-m-01'))),'status'=>2,'mch'=>$this->mch['id'],'separate'=>1))->sum('money'));
		//累计充值
		$acharge = M('charge')->where(array('status'=>2,'mch'=>$this->mch['id'],'separate'=>1))->sum('money');
		$this->assign('acharge',$acharge);
		//已提现金额
		$this->assign('ymoney',M('withdraw')->where(array('status'=>2,'mch'=>$this->mch['id']))->sum('money'));
		//未结算金额
		$this->assign('wmoney',M('withdraw')->where(array('status'=>1,'mch'=>$this->mch['id']))->sum('money'));
		
		//累计成本
		$cben = M('chapter')->where(array('mch'=>$this->mch['id']))->sum('cost');
		$this->assign('cben',$cben);
		*/
		
		//累计利润
		$this->assign('lirun',$acharge-$cben);
        
        $this->assign('info', $info);
        $this->display();
    }
    public function set_col($table = null)
    {
        $id = intval($_REQUEST['id']);
        $col = $_REQUEST['col'];
        $value = $_REQUEST['value'];
        if (!$table) {
            $table = CONTROLLER_NAME;
        }
        M($table)->where('id=' . $id)->setField($col, $value);
        $this->success('操作成功', $_SERVER['HTTP_REFERER']);
    }
    protected function _list($table, $where = null, $order = null)
    {
        $list = $this->_get_list($table, $where, $order);
        $this->assign('list', $list);
        $this->assign('page', $this->data['page']);
        $this->display();
    }
    protected function _get_list($table, $where = null, $order = null)
    {
        $model = M($table);
        $count = $model->where($where)->count();
        $page = new \Think\Page($count, 25);
        if (!$order) {
            $order = "id desc";
        }
        $list = $model->where($where)->limit($page->firstRow . ',' . $page->listRows)->order($order)->select();
        $this->data = array('list' => $list, 'page' => $page->show(), 'count' => $count);
        return $list;
    }
    protected function _edit($table, $url = null)
    {
        $model = M($table);
        $id = intval($_GET['id']);
        if ($id > 0) {
            $info = $model->find($id);
            if (!$info) {
                $_var_0('信息不存在');
            }
            $this->assign('info', $info);
        }
        if (IS_POST) {
            if (!$url) {
                $url = U('index');
            }
            if ($id > 0) {
                $_POST['id'] = $id;
                $model->save($_POST);
                $this->success('操作成功！', $url);
                exit;
            } else {
                $model->add($_POST);
                $this->success('添加成功！', $url);
                exit;
            }
        }
        $this->display();
    }
    protected function _del($table, $id)
    {
        if ($id > 0 && !empty($table)) {
            M($table)->delete($id);
        }
    }
    public function upload()
    {
        if (!empty($_GET['url'])) {
            $this->assign('url', $_GET['url']);
        }
        if (IS_POST) {
            if ($_GET['field']) {
                $field = $_GET['field'];
            }
            if (empty($field)) {
                $field = 'file';
            }
            if ($_FILES[$field]['size'] < 1 && $_FILES[$field]['size'] > 0) {
                $this->assign('errmsg', '上传错误！');
            } else {
                $ext = $this->_get_ext($_FILES[$field]['name']);
                if (!in_array(strtolower($ext), array('gif', 'jpg', 'png'))) {
                    $this->error('upload error');
                }
                $new_name = $this->_get_new_name($ext, 'images');
                if (move_uploaded_file($_FILES[$field]['tmp_name'], $new_name['fullname'])) {
                    $this->assign('url', $new_name['urlname']);
                } else {
                    $this->assign('errmsg', '文件保存错误！');
                }
            }
        }
        C('LAYOUT_ON', false);
        $this->display('Admin/upload');
    }
    private function _get_ext($file_name)
    {
        return substr(strtolower(strrchr($file_name, '.')), 1);
    }
    private function _get_new_name($ext, $dir = 'default')
    {
        $name = date('His') . substr(microtime(), 2, 8) . rand(1000, 9999) . '.' . $ext;
        //$path是相对服务器文件系统的目录名   实际位置是：硬盘中的安装位置+$path
        //$urlpath 是相对于web服务器寻址系统的目录名。 实际位置是：http://host/ +当前页面位置+ $urlpath 直接用/可以避免当前页面位置的影响。
        
        $path     = './Public/upload/' . $dir . date('/ym/d') . '/';
        $url_path = '/Public/upload/' . $dir . date('/ym/d') . '/';
        if (!is_dir($path)) {
            mkdir($path, 0777, 1);
        }
        return array('name' => $name, 'fullname' => $path . $name,'urlname'=>$url_path.$name);
    }
    public function setField()
    {
        $id = I('get.id');
        $table = I('get.table');
        $field = I('get.field');
        $info = M($table)->find(intval($id));
        $status = $info[$field] ? 0 : 1;
        M($table)->where(array("id" => $id))->save(array($field => intval($status)));
        $this->success('操作成功！');
    }
}