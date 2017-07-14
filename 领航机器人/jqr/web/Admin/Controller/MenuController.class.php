<?php
namespace Admin\Controller;
use Think\Controller;
class MenuController extends Controller {
    //Menu列表
    public function index(){
        $mod=M('Menu');
        $MenuCount=M('Menu')->count();
        $this->assign('MenuCount',$MenuCount);
        $Menu=$mod->order('Mid desc')->select();
        $this->assign("Menu",$Menu);

        $Menus=$mod->where('level=1')->select();
        $this->assign('Menus',$Menus);

        $MenuName=$mod->where('level=1')->select();
        $MenuNameValue=array();
        foreach ($MenuName as $key => $value) {
            $MenuNameValue[$value['Mid']]=$value['Name'];
        }
        $this->assign('MenuNameValue',$MenuNameValue);
        $this->display("Menu/MenuList");
    }


    //添加Menu
    public function insertMenu(){
        $mod=M('Menu');
        $mod->create();
        if($_POST['Level']==0){
            $mod->Level=1;
            $mod->Path=0;
        }else{
            $mod->Level=2;
            $mod->Path=$_POST['Level'];
        }
       
        $row=$mod->add();
        if($row){
            $this->success('添加成功！');
        }else{
            $this->error('添加失败！');
        }
  
    }

    //编辑Menu
    Public function editMenu(){
        $Mid=$_GET['Mid'];
        $mod=M('menu');
        $Menu=$mod->where("Mid=$Mid")->select();
        $this->assign('Menu',$Menu);

        $Menus=$mod->where('level=1')->select();
        $this->assign('Menus',$Menus);

        $this->display('Menu/EditMenu');
    }

    //Menu修改
    public function updataMenu(){
        $Mid=$_POST['Mid'];
        $mod=M('Menu');
        $mod->create();
        if($_POST['Level']==1){
            $mod->Level=1;
            $mod->Path=0;
        }else{
            $mod->Level=2;
            $mod->Path=$_POST['Level'];
        }
        $row=$mod->where("Mid=$Mid")->save();
        if($row){
             $this->success('修改成功！');
        }else{
            $this->error("修改失败！");
        }
        
    }

    //修改Menu状态
    public function setMenuStatus(){
        $Mid=$_POST['Mid'];
        $status=M('Menu')->where("Mid=$Mid")->getField('Status');
        if($status){
            $row=M('Menu')->where("Mid=$Mid")->setField('Status',0);
        }else{
            $row=M('Menu')->where("Mid=$Mid")->setField('Status',1);
        }

        if($row){
            echo 1;
        }else{
            echo 0;
        }
    }

    //删除Menu
    public function delMenu(){
        $Mid=$_POST['Mid'];
        $mod=M('Menu');
        $row=$mod->where("Mid=$Mid")->delete();
        if($row){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }

    //修改手机状态
    public function setPhoneStatus(){
        $Mid=$_POST['Mid'];
        $status=M('Menu')->where("Mid=$Mid")->getField('PhoneStatus');
        if($status){
            $row=M('Menu')->where("Mid=$Mid")->setField('PhoneStatus',0);
        }else{
            $row=M('Menu')->where("Mid=$Mid")->setField('PhoneStatus',1);
        }

        if($row){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function Sequence($key='Mid',$arr=''){
        $row=$this->_Sequence('menu','Mid',$_POST);
        if($row){
            $this->success('排序成功');
        }else{
            $this->error('排序失败');
        }
    }

    public function _Sequence($list='',$key='Mid',$arr=''){
        $mod=M($list);
        foreach($arr as $k=>$v){
            $row=$mod->where("$key={$k}")->save(array('Sequence'=>$v));
        }
        if($row!==false){
            return true;
        }else{
            return false;
        }
    }
}