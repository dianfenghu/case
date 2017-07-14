<?php
namespace Admin\Controller;
use Think\Controller;
class CaidanController extends AllowController {
    public function index(){    	
    	// $this->assign('webUrl','http://'.$_SERVER['SERVER_NAME']);
        $mod=M('caidan');
        $list=$mod->where('pid = 0')->select();
        $this->assign('list',$list);

        $row=$mod->where('pid != 0')->select();
        $this->assign('row',$row);
        $this->display('Caidan/index');

    }
    //欢迎界面
    public function insert(){
       // var_dump($_POST);
       $data['name']=$_POST['name'];
       $data['biaoshi']=$_POST['biaoshi'];
       $data['pid']=$_POST['pid'];
       $data['time']=time();
       $mod=M('caidan');
       if($mod->add($data)){
            $this->success('新增成功',U('caidan/index'));
       }else{
             $this->error('新增失败');
       }
    }
}