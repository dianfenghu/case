<?php
namespace Home\Controller;
use Think\Controller;
class MenuController extends SettingController {
    public function index(){
      	$menuInfo=M('menu')->where("Mid = {$_GET['Mid']} AND Status = 1")->find();
      	$this->assign('menuInfo',$menuInfo);
		//������з���
		if($menuInfo['Path']==0){
			$class=M('menu')->where("Path={$menuInfo['Mid']} and Status=1")->select();
		}else{
			$class=M('menu')->where("Path={$menuInfo['Path']} and Status=1")->select();
		}
		
		$this->assign('class',$class);
		//����
		$fatherMenu=M('menu')->where('Mid='.$menuInfo['Mid'])->getfield('Name');
		$this->assign('fatherMenu',$fatherMenu);
      	$this->display('index');
    } 

}