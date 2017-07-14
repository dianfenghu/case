<?php
namespace Admin\Controller;
use Think\Controller;
class SettingController extends Controller {
    public function index(){
    	$Setting=M('setting')->order('Sid desc')->select();
    	$this->assign('Setting',$Setting);
    	$footerCode=file_get_contents("./web/Home/View/Public/footerCode.html");
    	$this->assign('footerCode',$footerCode);
        $this->display('Setting/WebSetting');
    }

    //修改网站设置
    public function updateWebSetting(){
        $mod=M('setting');
        $Sid=$_POST['Sid'];
        $mod->create();
        // dump($mod->getLastsql());
        // die();
        if(session('Level')==1){
            $row=$mod->where("Sid=$Sid")->field('QQ,Email,Tel,Address,Url,Copyright,CaseNumber,Introduction,Contact')->save();
        }else{
            $row=$mod->where("Sid=$Sid")->save();
        }
        if($row){
            $this->success("修改成功！",U("Setting/index"));
        }else{
            $this->error("修改失败！");
        }
    }

    //修改LOGO
    public function updateLogo(){
    	$Sid=$_POST['Sid'];
    	$mod=M('setting');
    	// $LogoPhoto=$mod->where("Sid=$Sid")->getField('Logo');
    	$mod->create();

        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/Logo/'; // 设置附件上传目录    // 上传文件     
        $upload->autoSub   =     false;

        // 上传文件 
        $info   =   $upload->uploadOne($_FILES['Logo']);   
        if(!$info) {
            // 上传错误提示错误信息        
            $this->error($upload->getError());    
        }else{
            // 上传成功 获取上传文件信息         
            $picName=$info['savename'];  
            $mod->Logo=$picName;
            $row=$mod->save();
            if($row){
            	if($LogoPhoto){
            		unlink('./Public/Uploads/Logo/'.$LogoPhoto);
            	}
                $this->success("上传成功");
            }else{
                $this->error("上传失败");
            }   
        }
    }

    //添加代码
    public function addCode(){
        file_put_contents('./web/Home/View/Public/footerCode.html',$_POST['footer']);
        $this->success('修改成功');
    }


    //公司简介
    public function  introduction(){
        $Introduction=M('setting')->order("Sid desc")->select();
        $this->assign('Introduction',$Introduction);
        $this->display('Setting/Introduction');
    }

    //修改公司简介
    public function updateIntroduction(){
        $Sid=$_POST['Sid'];
        $mod=M('setting');
        $mod->create();
        $row=$mod->where("Sid=$Sid")->save();
        if($row){
            $this->success('修改成功！');
        }else{
            $this->error('修改失败！');
        }
    }

    //联系方式
    public function  Contact(){
        $Contact=M('setting')->order("Sid desc")->select();
        $this->assign('Contact',$Contact);
        $this->display('Setting/Contact');
    }

    //修改联系方式
    public function updateContact(){
        $Sid=$_POST['Sid'];
        $mod=M('setting');
        $mod->create();
        $row=$mod->where("Sid=$Sid")->save();
        if($row){
            $this->success('修改成功！');
        }else{
            $this->error('修改失败！');
        }
    }

    //联系方式
    public function  QRcode(){
        $QRcode=M('setting')->order("Sid desc")->select();
        $this->assign('QRcode',$QRcode);
        $this->display('Setting/QRcode');
    }

    //上传二维码
    public function updateQRcode(){
        $Sid=$_POST['Sid'];
        $mod=M('setting');
        $QRcodePhoto=$mod->where("Sid=$Sid")->getField('QRcode');
        $mod->create();

        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/QRcode/'; // 设置附件上传目录    // 上传文件     
        $upload->autoSub   =     false;

        // 上传文件 
        $info   =   $upload->uploadOne($_FILES['QRcode']);   
        if(!$info) {
            // 上传错误提示错误信息        
            $this->error($upload->getError());    
        }else{
            // 上传成功 获取上传文件信息         
            $picName=$info['savename']; 
            $image = new \Think\Image(); 
            $thumbName="thumb_".$info['savename'];
            $mod->QRcode=$picName;
            $row=$mod->save();
            if($row){
                if($QRcodePhoto){
                 unlink('./Public/Uploads/Logo/'.$QRcodePhoto);
                }
                $this->success("上传成功");
            }else{
                $this->error("上传失败");
            }   
        }
    }

    //手机logo 上传
    public function update_mLogo(){
        $upload = new \Think\Upload();
        $upload->maxSize = 3000000 ;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); 
        $upload->rootPath = './Public/Uploads/Logo/';  
        $info = $upload->uploadOne($_FILES['m_logo']); 
        if(!$info) {
            $this->error($upload->getError()); 
        }else{
            $mod=M('setting');
            $old=$mod->where("Sid={$_POST['Sid']}")->getfield('m_logo');
            $mod->create();
            $mod->m_logo=$info['savename'];
            $image = new \Think\Image();
            $image->open('./Public/Uploads/Logo/'.$info['savename']);
            $image->thumb(150,150)->save('./Public/Uploads/Logo/thumb_'.$info['savename']);
            if($mod->save()){
                unlink('./Public/Uploads/Logo/thumb_'.$old);
                unlink('./Public/Uploads/Logo/'.$old);
                $this->success('保存成功');
            } else{
                $this->error('保存失败');
            }
        }
    }

    //获取图片
    public function getimg(){
        if($_POST['type']=='mobile'){
            $img=M('setting')->where("Sid={$_POST['Sid']}")->getfield('m_logo');
            echo $img;
        }elseif($_POST['type']=='pc'){
            $img=M('setting')->where("Sid={$_POST['Sid']}")->getfield('Logo');
            echo $img;
        }
    }

    //手机风格更换
    public function style_update(){
        $mod=M('setting');
        $mod->create();
        if($mod->where('Sid=8')->save()){
            $this->success('更新成功!');
        }else{
            $this->error('更新失败');
        }
    }
}