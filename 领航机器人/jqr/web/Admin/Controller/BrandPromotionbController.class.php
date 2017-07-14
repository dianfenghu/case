<?php
namespace Admin\Controller;
use Think\Controller;
class BrandPromotionbController extends Controller {
    //BrandPromotionb列表
    public function index(){
        $mod=M('brand_promotion');
        $BrandPromotionbCount=$mod->count();
        $this->assign('BrandPromotionbCount',$BrandPromotionbCount);
        $BrandPromotionb=$mod->order('Bid desc')->select();
        $this->assign("BrandPromotionb",$BrandPromotionb);
        $this->display("BrandPromotionb/BrandPromotionbList");
    }


    //添加BrandPromotionb
    public function insertBrandPromotionb(){
        $mod=M('brand_promotion');
        $mod->create();
        $mod->AddTime=time();
        $row=$mod->add();
        if($row){
            $this->success('添加成功！',U('BrandPromotionb/index'));
        }else{
            $this->error('添加失败！');
        }
  
    }

    //BrandPromotionb修改
    public function updataBrandPromotionb(){
        $Bid=$_POST['Bid'];
        $mod=M('BrandPromotionb');
        $row=$mod->where("Bid=$Bid")->save();
        if($row){
             $this->success('修改成功！');
        }else{
            $this->error("修改失败！");
        }
        
    }

    //修改BrandPromotionb状态
    public function setBrandPromotionbStatus(){
        $Bid=$_POST['Bid'];
        $status=M('brand_promotion')->where("Bid=$Bid")->getField('Status');
        if($status){
            $row=M('brand_promotion')->where("Bid=$Bid")->setField('Status',0);
        }else{
            $row=M('brand_promotion')->where("Bid=$Bid")->setField('Status',1);
        }

        if($row){
            echo 1;
        }else{
            echo 0;
        }
    }

    //删除BrandPromotionb
    public function delBrandPromotionb(){
        $Bid=$_POST['Bid'];
        $mod=M('brand_promotion');
        $row=$mod->where("Bid=$Bid")->delete();
        if($row){
         
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }


}