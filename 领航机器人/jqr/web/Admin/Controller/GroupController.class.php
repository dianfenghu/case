<?php
namespace Admin\Controller;
use Think\Controller;
class NewsController extends AllowController {
    public function index(){
    	$list=M('auth_group')->select();
        $this->assign('group_list',$list);
        $this->display('grouplist');
    }

    //添加新闻表单
    public function addNews(){
    	$NewsClass=M('news_class')->order('Cid desc')->select();
    	$this->assign('NewsClass',$NewsClass);
    	$this->display('News/AddNews');
    }

    //修改新闻状态
    public function setNewsStatus(){
    	$Nid=$_POST['Nid'];
    	$status=M('news')->where("Nid=$Nid")->getField('Status');
    	if($status){
    		$row=M('news')->where("Nid=$Nid")->setField('Status',0);
    	}else{
    		$row=M('news')->where("Nid=$Nid")->setField('Status',1);
    	}

    	if($row){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }

     //添加新闻
    public function insertNews(){
        $mod=M('news');
        $mod->create();
        $mod->AddTime=time();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/News/'; // 设置附件上传目录    // 上传文件     
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
                $image->open('./Public/Uploads/News/'.$picName);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(200,200)->save('./Public/Uploads/News/'.$thumbName);
                $mod->Photo=$picName;
                $row=$mod->add();
                if($row){
                    $this->success('新闻添加成功！',U('News/index'));
                }else{
                    $this->error('添加新闻失败！');
                }   
            }
        }else{
            $row=$mod->add();
            if($row){

                $this->success('新闻添加成功！',U('News/index'));
            }else{
                $this->error('添加新闻失败！');
            }
        }
    }

    //新闻编辑
    public function newsEdit(){
    	$Nid=$_GET['Nid'];

    	$newsContent=M('news')->where("Nid=$Nid")->select();
    	$this->assign("newsContent",$newsContent);

    	$newsClass=M('news_class')->order('Cid desc')->select();
    	$this->assign('newsClass',$newsClass);
    	$this->display('News/NewsEdit');
    }

     //修改新闻
    public function updateNews(){
        $Nid=$_POST['Nid'];
        $mod=M('news');
        $OldNewsPhoto=$mod->where("Nid=$Nid")->getField('Photo');
        $mod->create();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/News/'; // 设置附件上传目录    // 上传文件     
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
                $image->open('./Public/Uploads/News/'.$picName);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(150, 150)->save('./Public/Uploads/News/'.$thumbName);
                // echo $picName;
                $mod->Photo=$picName;
                $row=$mod->where("Nid=$Nid")->save();
                if($row){
                	if($OldNewsPhoto){
		                unlink('./Public/Uploads/News/thumb_'.$OldNewsPhoto);
		                unlink('./Public/Uploads/News/'.$OldNewsPhoto);
	                }
                    $this->success('修改成功！');
                }else{
                    $this->error("资料修改失败！");
                }   
            }
        }else{
            $row=$mod->where("Nid=$Nid")->save();
            if($row){
                 $this->success('修改成功！');
            }else{
                $this->error("资料修改失败！");
            }
        }
    }

    //删除新闻
    public function delNews(){
        $Nid=$_POST['Nid'];
        $mod=M('news');
        $NewsPhoto=$mod->where("Nid=$Nid")->getField('Photo');
        $row=$mod->where("Nid=$Nid")->delete();
        if($row){
        	unlink('./Public/Uploads/News/thumb_'.$NewsPhoto);
            unlink('./Public/Uploads/News/'.$NewsPhoto);
            echo 1;
        }else{
            echo 0;
        }
    }

    //批量删除
    public function batchDeleteNews(){
        $Nids=$_POST['Nids'];
        $mod=M('News');
        foreach ($Nids as $key => $value) {
            $NewsPhoto=$mod->where("Nid=$value")->getField('Photo');
            $row=$mod->where("Nid=$value")->delete();
            if($row){
                unlink('./Public/Uploads/News/thumb_'.$NewsPhoto);
                unlink('./Public/Uploads/News/'.$NewsPhoto);
            }
        }
        $this->success('删除成功！');

    }

    //新闻类别
    public function newsClass(){
    	$newsClass=M('news_class')->order('Cid desc')->select();
    	$this->assign('newsClass',$newsClass);
    	$this->display('News/NewsClass');
    }

    //添加新闻类别
    public function insertNewsClass(){
    	$mod=M('news_class');
    	if($mod->where("ClassName='{$_POST['ClassName']}'")->select()){
    		$this->error('添加失败，此类已经存在');
    	}else{
    		$mod->create();
	    	$mod->AddTime=time();
	    	$row=$mod->add();
	    	if($row){
	    		$this->success('添加成功！');
	    	}else{
	    		$this->error('添加失败！');
	    	}
    	}
    	
    }

    //编辑产品类别 
    public function editNewsClass(){
        $Cid=$_GET['Cid'];
        $newsClass=M('news_class')->where("Cid=$Cid")->select();
        $this->assign('newsClass',$newsClass);
        $this->display('News/EditNewsClass');
    }

    //修改类别名称
    public function updateNewsClass(){
        $Cid=$_POST['Cid'];
        $mod=M('news_class');
        $mod->create();
        $row=$mod->where("Cid=$Cid")->save();
        if($row){
            $this->success('修改成功',U('News/newsClass'));
        }else{
            $this->error('修改失败');
        }
    }

    //删除新闻类别
    public function delNewsClass(){
        $Cid=$_GET['Cid'];
        $row=M('news_class')->where("Cid = $Cid")->delete($Cid);
        if($row){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败');
        }
    }
}