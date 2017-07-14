<?php
namespace Admin\Controller;
use Think\Controller;
class DataManagementController extends Controller {
    //DataManagement列表
    public function index(){
        $mod=M('display_data');
        $DataManagementCount=$mod->count();
        $this->assign('DataManagementCount',$DataManagementCount);
        $DataManagement=$mod->order('Did desc')->select();
        
        $this->assign("DataManagement",$DataManagement);
        $this->display("DataManagement/DataManagementList");
    }

    //添加数据页面
    public function addDataManagement(){
        $this->display('DataManagement/AddDataManagement');
    }


    //添加DataManagement
    public function insertDataManagement(){
        $mod=M('display_data');
        $mod->create();
        $row=$mod->add();
        if($row){
            $this->success('添加成功！',U('DataManagement/index'));
        }else{
            $this->error('添加失败！');
        }
    }

    //AJAX查找数据类别
    public function dataClass(){
        $mod=M($_POST['DataTable']."_class");
        $dataClass=$mod->select();
        if($dataClass){
            echo json_encode($dataClass);

        }else{
            echo 0;
        }

   

    }


    //DataManagement修改
    public function updataDataManagement(){
        $Did=$_POST['Did'];
        $mod=M('display_data');
        $row=$mod->where("Did=$Did")->save();
        if($row){
             $this->success('修改成功！');
        }else{
            $this->error("修改失败！");
        }
        
    }



    //删除DataManagement
    public function delDataManagement(){
        $Did=$_POST['Did'];
        $mod=M('display_data');
        $row=$mod->where("Did=$Did")->delete();
        if($row){
         
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }


}