<?php

/*
 * 功能：安装模块
 * Author:资料空白
 * Date:20180626
 */

class SetptwoController extends BasicController
{

	public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
		if(file_exists(APP_PATH.'/conf/install.lock')){
			$this->redirect("/product/");
			return FALSE;
		}else{
			$data = array();
			$this->getView()->assign($data);
		}
    }
	
	public function ajaxAction()
	{
		$host = $this->getPost('host',false);
		$port = $this->getPost('port',false);
		$user = $this->getPost('user', false);
		$password = $this->getPost('password', false);
		
		$data = array();
		
		if($host AND $port AND $user AND $password){
			$mysqlurl = $host.":".$port;
			$con = mysql_connect($mysqlurl,$user,$password);
			if (!$con){
			   $data = array('code' => 1001, 'msg' => mysql_error());
			}else{
				mysql_close($con);
			}
		}else{
			$data = array('code' => 1000, 'msg' => '丢失参数');
		}
		Helper::response($data);
	}
}