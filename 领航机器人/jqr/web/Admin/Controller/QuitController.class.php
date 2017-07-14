<?php
namespace Admin\Controller;
use Think\Controller;
class QuitController extends AllowController{
    //退出
    public function index(){
        setcookie(session_name($_SESSION['admin']),'',time()-1,'/');
        $_SESSION['admin']=array();
        session_destroy($_SESSION['admin']);
        $this->success("退出成功！",U("Login/index"));
    }
}