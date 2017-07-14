<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends AllowController {
    public function index(){
    	$this->assign('webUrl','http://'.$_SERVER['SERVER_NAME']);
        $this->display();
    }

    //欢迎界面
    public function welcome(){
    	$setting=M('setting')->order("Sid desc")->limit('1')->select();
    	$this->assign('setting',$setting);
    	$this->display('Index/welcome');
    }
    public function see(){
        $mod=M('user');
        $tot=$mod->Count();
        //实例化分页类
        $page=new\Think\Page($tot,10);
        //设置分页信息
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $list=$mod->order('time asc')->limit($page->firstRow,$page->listRows)->select();
        //分配变量
        $this->assign('list',$list);
        $this->assign('pageinfo',$page->show());
        $arr=array('<font color="green">正常</font>','<font color="red">禁用</font>');
        $this->assign('arr',$arr);
        $this->display('Register/see');
    }
    public function stu(){
        $mod=M('user');
        $row=$mod->where(" id = {$_GET['id']}")->getField('status');
        if($row == 0){
             $st=$mod->where(" id = {$_GET['id']}")->setField('status',1);
        }else{
             $st=$mod->where(" id = {$_GET['id']}")->setField('status',0);
        }
        if($st){
            $this->success('设置成功',U('user/see'),1);              
        }else{
            $this->error('设置失败');
        }
    }
}