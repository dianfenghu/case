<?php
namespace Admin\Controller;
use Think\Controller;
class BannerController extends Controller {
    //Banner列表
    public function index(){
        $mod=M('Banner');
        $BannerCount=M('Banner')->count();
        $this->assign('BannerCount',$BannerCount);

        $Banner=$mod->order('Bid desc')->select();
        $this->assign("Banner",$Banner);
        $this->display("Banner/BannerList");
    }


    //添加Banner
    public function insertBanner(){
        if($_POST['type']==0){
            $this->error('请选择上传类型!');
            die();
        }
        $mod=M('Banner');
        $mod->create();
        $mod->AddTime=time();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/Banner/'; // 设置附件上传目录    // 上传文件     
        $upload->autoSub   =     false;
        // 上传文件 
        $info   =   $upload->uploadOne($_FILES['Photo']);   
        if($_FILES['Photo']['name']){
            if(!$info) {
                // 上传错误提示错误信息        
                $this->error($upload->getError());    
            }else{
                // 上传成功 获取上传文件信息         
                $picName=$info['savename']; 
                $image = new \Think\Image(); 
                $thumbName="thumb_".$info['savename'];
                $image->open('./Public/Uploads/Banner/'.$picName);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(414,184)->save('./Public/Uploads/Banner/'.$thumbName);
                $mod->Photo=$picName;
                $row=$mod->add();
                if($row){
                    $this->success('添加成功！',U('Banner/index'));
                }else{
                    $this->error('添加失败！');
                }   
            }
        }else{
            $row=$mod->add();
            if($row){
                $this->success('添加成功！',U('Banner/index'));
            }else{
                $this->error('添加失败！');
            }
        }
        
    }

    //Banner编辑页面
    public function editBanner(){
        $Bid=$_GET['Bid'];
        $Banner=M("Banner")->where("Bid=$Bid")->select();
        $this->assign('Banner',$Banner);
        $BannerClass=M('Banner_class')->order('Cid desc')->select();
        $this->assign('BannerClass',$BannerClass);
        $this->display("Banner/EditBanner");
    }

    //Banner修改
    public function updataBanner(){
        $Bid=$_POST['Bid'];
        $mod=M('Banner');
        $OldNewsPhoto=$mod->where("Bid=$Bid")->getField('Photo');
        $mod->create();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/Banner/'; // 设置附件上传目录    // 上传文件     
        $upload->autoSub   =     false;

        // 上传文件 
        $info   =   $upload->uploadOne($_FILES['Photo']);   
        if($_FILES['Photo']['name']){
            if(!$info) {
                // 上传错误提示错误信息        
                $this->error($upload->getError());    
            }else{

                // 上传成功 获取上传文件信息         
                $picName=$info['savename']; 
                $image = new \Think\Image(); 
                $thumbName="thumb_".$info['savename'];
                $image->open('./Public/Uploads/Banner/'.$picName);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(150, 150)->save('./Public/Uploads/Banner/'.$thumbName);
                // echo $picName;
                $mod->Photo=$picName;
                $row=$mod->where("Bid=$Bid")->save();
                if($row){
                    if($OldNewsPhoto){
                        unlink('./Public/Uploads/Banner/thumb_'.$OldNewsPhoto);
                        unlink('./Public/Uploads/Banner/'.$OldNewsPhoto);
                    }
                    $this->success('修改成功！');
                }else{
                    $this->error("修改失败！");
                }   
            }
        }else{
            $row=$mod->where("Bid=$Bid")->save();
            if($row){
                 $this->success('修改成功！');
            }else{
                $this->error("修改失败！");
            }
        }
    }

    //修改Banner状态
    public function setBannerStatus(){
        $Bid=$_POST['Bid'];
        $status=M('Banner')->where("Bid=$Bid")->getField('Status');
        if($status){
            $row=M('Banner')->where("Bid=$Bid")->setField('Status',0);
            echo 1;
        }else{
            $row=M('Banner')->where("Bid=$Bid")->setField('Status',1);
            echo 2;
        }

    }

    //删除Banner
    public function delBanner(){
        $Bid=$_GET['Bid'];
        $mod=M('Banner');
        $NewsPhoto=$mod->where("Bid=$Bid")->getField('Photo');
        $row=$mod->where("Bid=$Bid")->delete();
        if($row){
            unlink('./Public/Uploads/Banner/thumb_'.$NewsPhoto);
            unlink('./Public/Uploads/Banner/'.$NewsPhoto);
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }


}