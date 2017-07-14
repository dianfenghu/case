<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends AllowController {
    public function index(){
    	
    	$this->assign('webUrl','http://'.$_SERVER['SERVER_NAME']);
        $this->display();
    }

    //欢迎界面
    public function welcome(){
        //分站
        $areaWeb=M('areaweb')->select();
        // dump($areaWeb);
        $this->assign('areaWeb',$areaWeb);
        
    	$setting=M('setting')->order("Sid desc")->limit('1')->select();
    	$this->assign('setting',$setting);
    	$this->display('Index/welcome');
    }
}