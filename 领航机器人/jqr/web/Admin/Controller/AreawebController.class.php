<?php
namespace Admin\Controller;
use Think\Controller;
class AreawebController extends Controller {
    //Areaweb列表
    public function index(){
        $mod=M('Areaweb');
        $AreawebCount=M('Areaweb')->count();
        $this->assign('AreawebCount',$AreawebCount);
        $Areaweb=$mod->order('Aid desc')->select();
        $this->assign("Areaweb",$Areaweb);
        $this->display("Areaweb/AreawebList");
    }


    //添加Areaweb
    public function insertAreaweb(){
        $mod=M('Areaweb');
        $mod->create();
        $mod->AddTime=time();
        $row=$mod->add();
        if($row){
            $this->success('添加成功！',U('Areaweb/index'));
        }else{
            $this->error('添加失败！');
        }
  
    }

    //Areaweb修改
    public function updataAreaweb(){
        $Aid=$_POST['Aid'];
        $mod=M('Areaweb');
        $row=$mod->where("Aid=$Aid")->save();
        if($row){
             $this->success('修改成功！');
        }else{
            $this->error("修改失败！");
        }
        
    }

    //修改Areaweb状态
    public function setAreawebStatus(){
        $Aid=$_POST['Aid'];
        $status=M('Areaweb')->where("Aid=$Aid")->getField('Status');
        if($status){
            $row=M('Areaweb')->where("Aid=$Aid")->setField('Status',0);
        }else{
            $row=M('Areaweb')->where("Aid=$Aid")->setField('Status',1);
        }

        if($row){
            echo 1;
        }else{
            echo 0;
        }
    }

    //删除Areaweb
    public function delAreaweb(){
        $Aid=$_POST['Aid'];
        $mod=M('Areaweb');
        $row=$mod->where("Aid=$Aid")->delete();
        if($row){
         
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }


}