<?php
namespace Admin\Controller;
use Think\Controller;
class ReportController extends AllowController {
    //产品列表
    public function index(){
        $mod=M('report');
        $name=isset($_POST['Title'])?$_POST['Title']:'';
        if($name){
            $where="Title like '%$name%'";
        }else{
            $where='';
        }
        $report=$mod->where("$where")->select();
        $reportCount=M('report')->count();
        $this->assign('report',$report);
        $this->assign('reportCount',$reportCount);
        $this->display("Report/ReportList");
    }

     //添加产品页
    public function addReport(){
        // $ProductClass=M('product_class')->order('Cid desc')->select();
        // $this->assign('ProductClass',$ProductClass);
        $this->display("Report/AddProduct");
    }

    //添加产品
    public function insertReport(){
        $mod=M('report');
        $mod->create();
        $mod->AddTime=time();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/Report/'; // 设置附件上传目录    // 上传文件     
        $upload->autoSub   =     false;
        // 上传文件 
        $info   =   $upload->uploadOne($_FILES['Pic']);   
        if($_FILES['Pic']['name']){
            if(!$info) {
                // 上传错误提示错误信息        
                $this->error($upload->getError());    
            }else{
                // 上传成功 获取上传文件信息         
                $picName=$info['savename']; 
                $image = new \Think\Image(); 
                $thumbName="thumb_".$info['savename'];
                $image->open('./Public/Uploads/Report/'.$picName);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(200,200)->save('./Public/Uploads/Report/'.$thumbName);
                $mod->Pic=$picName;
                $row=$mod->add();
                if($row){
                    $this->success('添加成功！',U('Report/index'));
                }else{
                    $this->error('添加失败！');
                }   
            }
        }else{
            $row=$mod->add();
            if($row){
                $this->success('添加成功！',U('Report/index'));
            }else{
                $this->error('添加失败！');
            }
        }
        
    }

    //产品编辑页面
    public function editReport(){
        $Rid=$_GET['Rid'];
        $Report=M("report")->where("Rid=$Rid")->select();
        $this->assign('Report',$Report);
        $this->display("Report/EditReport");
    }

    //产品修改
    public function updataReport(){
        $Rid=$_POST['Rid'];
        $mod=M('report');
        $OldNewsPhoto=$mod->where("Rid=$Rid")->getField('Pic');
        $mod->create();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/Report/'; // 设置附件上传目录    // 上传文件     
        $upload->autoSub   =     false;

        // 上传文件 
        $info   =   $upload->uploadOne($_FILES['Pic']);   
        if($_FILES['Pic']['name']){
            if(!$info) {
                // 上传错误提示错误信息        
                $this->error($upload->getError());    
            }else{

                // 上传成功 获取上传文件信息         
                $picName=$info['savename']; 
                $image = new \Think\Image(); 
                $thumbName="thumb_".$info['savename'];
                $image->open('./Public/Uploads/Report/'.$picName);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(150, 150)->save('./Public/Uploads/Report/'.$thumbName);
                // echo $picName;
                $mod->Pic=$picName;
                $row=$mod->where("Rid=$Rid")->save();
                if($row){
                    if($OldNewsPhoto){
                        unlink('./Public/Uploads/Report/thumb_'.$OldNewsPhoto);
                        unlink('./Public/Uploads/Report/'.$OldNewsPhoto);
                    }
                    $this->success('修改成功！');
                }else{
                    $this->error("修改失败！");
                }   
            }
        }else{
            $row=$mod->where("Rid=$Rid")->save();
            if($row){
                 $this->success('修改成功！');
            }else{
                $this->error("修改失败！");
            }
        }
    }

    //修改产品状态
    public function setReportStatus(){
        $Rid=$_POST['Rid'];
        $status=M('report')->where("Rid=$Rid")->getField('Status');
        if($status){
            $row=M('report')->where("Rid=$Rid")->setField('Status',0);
        }else{
            $row=M('report')->where("Rid=$Rid")->setField('Status',1);
        }
        if($row){
            echo 1;
        }else{
            echo 0;
        }
    }

    //修改产品推荐状态
    // public function setrecommend(){
    //     $Pid=$_POST['Pid'];
    //     $status=M('product')->where("Pid=$Pid")->getField('recommend');
    //     if($status){
    //         $row=M('product')->where("Pid=$Pid")->setField('recommend',0);
    //     }else{
    //         $row=M('product')->where("Pid=$Pid")->setField('recommend',1);
    //     }

    //     if($row){
    //         echo 1;
    //     }else{
    //         echo 0;
    //     }
    // }
    //删除产品
    public function delReport(){
        $Rid=$_POST['Rid'];
        $mod=M('report');
        $productPhoto=$mod->where("Rid=$Rid")->getField('Pic');
        $row=$mod->where("Rid=$Rid")->delete();
        if($row){
            unlink('./Public/Uploads/Report/thumb_'.$productPhoto);
            unlink('./Public/Uploads/Report/'.$productPhoto);
            echo 1;
        }else{
            echo 0;
        }
    }

    //批量删除
    public function batchDeleteRepor(){
        $Rids=$_POST['Rids'];
        $mod=M('report');
        foreach ($Pids as $key => $value) {
            $productPhoto=$mod->where("Rid=$value")->getField('Pic');
            $row=$mod->where("Rid=$value")->delete();
            if($row){
                unlink('./Public/Uploads/Report/thumb_'.$productPhoto);
                unlink('./Public/Uploads/Report/'.$productPhoto);
            }
        }
        $this->success('删除成功！');

    }

    //产品类别
    public function ProductClass(){
        $ProductClass=M('product_class')->order('Cid desc')->select();
        // $Product=M('product')->field('Class,count(Class) as ProductNumber')->group('Class')->select();
        // $ProductClassInfo=array();
        // foreach ($ProductClass as $key => $value) {
        //     foreach ($Product as $ProductKey => $ProductValue) {
        //         if($value['Cid']==$ProductValue['Class']){
        //             $value['ProductNumber']=$ProductValue['ProductNumber'];
        //         }else{
        //             $value['ProductNumber']=0;
        //         }
        //     }
        //     $ProductClassInfo[$key]=$value;
        // }
        $this->assign('ProductClass',$ProductClass);
        $this->display('Product/ProductClass');
    }

    //添加产品类别
    public function insertProductClass(){
        $mod=M('product_class');
        $mod->create();
        $mod->AddTime=time();
        $row=$mod->add();
        if($row){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }

    //编辑产品类别 
    public function editProductClass(){
        $Cid=$_GET['Cid'];
        $productClass=M('product_class')->where("Cid=$Cid")->select();
        $this->assign('productClass',$productClass);
        $this->display('Product/EditProductClass');
    }

    //修改产品类别 
    public function updateProductClass(){
        $Cid=$_POST['Cid'];
        $mod=M('product_class');
        $mod->create();
        $row=$mod->where("Cid=$Cid")->save();
        if($row){
            $this->success('修改成功！');
        }else{
            $this->error('修改失败！');
        }
    }

    //删除产品类别
    public function delProductClass(){
        $Cid=$_GET['Cid'];
        $mod=M('product_class');
        $row=$mod->where("Cid=$Cid")->delete();
        if($row){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }


 
    //删除产品案例
    public function delProducts(){
        $mod=M('product');
        $pid=$_GET['pid'];
        // var_dump($pid);
        if(is_array($pid)){
            foreach ($pid as $key => $value) {
                $row=$mod->where("id=$value")->delete();
                // echo $value;
            }
        }else{
            $row=$mod->where("id=$pid")->delete();
        }
        if($row){
            $this->success("删除成功!",U("Products/index"));
        }else{
            $this->error("删除失败！");
        }
    }


}