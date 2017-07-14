<?php
namespace Admin\Controller;
use Think\Controller;
class LinksController extends Controller {
    //Links列表
    public function index(){
        $mod=M('Links');
        $LinksCount=M('Links')->count();
        $this->assign('LinksCount',$LinksCount);

        $Links=$mod->order('Lid desc')->select();
        $this->assign("Links",$Links);
        $this->display("Links/LinksList");
    }


    //添加Links
    public function insertLinks(){
        $mod=M('Links');
        $mod->create();
        $mod->AddTime=time();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/Links/'; // 设置附件上传目录    // 上传文件     
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
                $image->open('./Public/Uploads/Links/'.$picName);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(720,300)->save('./Public/Uploads/Links/'.$thumbName);
                $mod->Photo=$picName;
                $row=$mod->add();
                if($row){
                    $this->success('添加成功！',U('Links/index'));
                }else{
                    $this->error('添加失败！');
                }   
            }
        }else{
            $row=$mod->add();
            if($row){
                $this->success('添加成功！',U('Links/index'));
            }else{
                $this->error('添加失败！');
            }
        }
        
    }

    //Links编辑页面
    public function editLinks(){
        $Lid=$_GET['Lid'];
        $Links=M("Links")->where("Lid=$Lid")->select();
        $this->assign('Links',$Links);
        $LinksClass=M('Links_class')->order('Cid desc')->select();
        $this->assign('LinksClass',$LinksClass);
        $this->display("Links/EditLinks");
    }

    //Links修改
    public function updataLinks(){
        $Lid=$_POST['Lid'];
        $mod=M('Links');
        $OldNewsPhoto=$mod->where("Lid=$Lid")->getField('Photo');
        $mod->create();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/Links/'; // 设置附件上传目录    // 上传文件     
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
                $image->open('./Public/Uploads/Links/'.$picName);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(150, 150)->save('./Public/Uploads/Links/'.$thumbName);
                // echo $picName;
                $mod->Photo=$picName;
                $row=$mod->where("Lid=$Lid")->save();
                if($row){
                    if($OldNewsPhoto){
                        unlink('./Public/Uploads/Links/thumb_'.$OldNewsPhoto);
                        unlink('./Public/Uploads/Links/'.$OldNewsPhoto);
                    }
                    $this->success('修改成功！');
                }else{
                    $this->error("修改失败！");
                }   
            }
        }else{
            $row=$mod->where("Lid=$Lid")->save();
            if($row){
                 $this->success('修改成功！');
            }else{
                $this->error("修改失败！");
            }
        }
    }

    //修改Links状态
    public function setLinksStatus(){
        $Lid=$_POST['Lid'];
        $status=M('Links')->where("Lid=$Lid")->getField('Status');
        if($status){
            $row=M('Links')->where("Lid=$Lid")->setField('Status',0);
        }else{
            $row=M('Links')->where("Lid=$Lid")->setField('Status',1);
        }

        if($row){
            echo 1;
        }else{
            echo 0;
        }
    }

    //删除Links
    public function delLinks(){
        $Lid=$_GET['Lid'];
        $mod=M('Links');
        $NewsPhoto=$mod->where("Lid=$Lid")->getField('Photo');
        $row=$mod->where("Lid=$Lid")->delete();
        if($row){
            unlink('./Public/Uploads/Links/thumb_'.$NewsPhoto);
            unlink('./Public/Uploads/Links/'.$NewsPhoto);
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }


}