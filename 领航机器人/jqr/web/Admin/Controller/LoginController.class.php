<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        $this->display("Login/login");
    }
    //加载验证码
	public function verify(){
		$Verify = new\Think\Verify();
		$Verify->fontSize=60;
		$Verify->length=3;
        $Verify->fontttf = '5.ttf';
		$Verify->useNoise=false;
		$Verify->entry();
	}
    public function code(){
        //验证码的验证
        $Verify = new\Think\Verify();
        $fcode=$_POST['fcode'];
        if(!$Verify->check($fcode,'')){
            $this->error("验证码错误！");
        }
    }
    public function login(){
    	//验证码的验证
        // dump($_POST);exit;
    	$Verify = new\Think\Verify();
		$fcode=$_POST['fcode'];
		if(!$Verify->check($fcode,'')){
			$this->error("验证码错误！");
		}
        
		dir();

		//用户名和密码的验证
    	$mod=M("admin");
    	$name=$_POST['adminName'];
    	$pwd=md5($_POST['password']);
        // dump($pwd);
        $row=$mod->where("UserName='{$name}' and Password='{$pwd}'")->select(); 
        // dump($row);
        // dump($mod->getLastSql());
        // die();
    	if($row){
    		$_SESSION['admin']=$row;
            $mod1=M('admin_log');
            $data['loginTime']=time();
            $data['loginIp']="\"".$_SERVER['REMOTE_ADDR']."\"";
            $Ip = new \Org\Net\IpLocation('UTFWry.dat');// 实例化类 参数表示IP地址库文件
            $area = $Ip->getlocation($_SERVER["REMOTE_ADDR"]); // 获取某个IP地址所在的位置
            $data['address']=$area['country'].$area['area'];
            $data['aid']=$row[0]['id'];

            $mod1->where("name = '{$name}'")->data($data)->add();
    		$this->success("登录成功！",U("Index/index"));
    	}else{
    		$this->error("管理员账号或密码错误！");
    	}
    }
}