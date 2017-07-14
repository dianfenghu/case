<?php
namespace Admin\Controller;
use Think\Controller;
class ServiceController extends AllowController {
    public function add(){
        $this->display('Service/add');
    }
     //添加新闻
    public function insert(){
        // var_dump($_POST);exit;
        $mod=M('service');
        $rules=array(
            array('title','','文章标题已经存在',0,'unique',1), 
            array('title','require','文章标题不能为空'), 
            
        );
       if(!$mod->validate($rules)->create()){
            $this->error($mod->getError());
       }
       $row=$mod->where("class = {$_POST['class']}")->select();
       if($row){
            $this->error('该栏目已经添加过内容');
       }
       if($_POST['class'] == 'str'){
            $this->error('至少选择一个栏目');
       }  
       if($_POST['content'] == ''){
            $this->error('文章内容不能为空');
       }     
       // var_dump($data);exit;
        $upload=new \Think\Upload();
        //设置参数
        $upload->maxSize=314566779889;//大小
        $upload->exts=array("jpg","png","gif","jpeg");//类型
        $upload->rootPath="./Public/Uploads/";//根目录
        $upload->autoSub=false;//不生成的子目录
        //执行上传
        $info=$upload->upload();
        foreach($info as $file){
            $url="/Public/Uploads/".$file['savepath'].$file['savename']; 
        }  
        $data=$mod->create();
        $data['photo']=$url;
        $data['addtime']=time(); 
        //var_dump($data);exit;
        if($mod->add($data)){
            $this->success('添加成功',U('service/index'),1);
        }else{
            $this->error('添加失败');       
    }
}
    public function index(){
        $list=M('service')       
        ->join('tx_service_class on tx_service_class.cid = tx_service.class')
        ->select();
        // var_dump($list);
        $this->assign('list',$list);
        $NewsCount=M('service')->count();
        $this->assign('NewsCount',$NewsCount);
        $this->display('service/index');
    }
    public function class_service(){
        $list=M('service_class')->select();
        $this->assign('list',$list);
        $this->display('service/class');
    }

      public function class_insert(){
        $mod=M('service_class');
        $rules=array(
            array('class_name','','栏目已经存在',0,'unique',1), 
            array('class_name','require','栏目名称不能为空'), 
            
        );
       if(!$mod->validate($rules)->create()){
            $this->error($mod->getError());
       }
       $data=$mod->create();
       $data['class_time']=time();
       if($mod->add($data)){
            $this->success('添加成功',U('service/class_service'));
        }else{
            $this->error('添加失败');
        }
    }
    public function class_del(){
        $mod=M('service_class');
        $row=M('service')->where("class = {$_GET['id']}")->select();
        if($row){
              $this->error('该栏目下有内容不能删除');
        }else{
            if($mod->where("cid = {$_GET['id']}")->delete()){
                $this->success('删除成功',U('service/class_service'));
            }else{
                $this->error('删除失败');
            }

        }
      
    }
    public function class_edit(){
        $mod=M('service_class');
        $row=$mod->where("cid = {$_GET['id']}")->select();
        $this->assign('list',$row[0]);
        // var_dump($row);
        $this->display('Service/class_edit');
    }
      public function class_update(){
        $mod=M('service_class');
        $rules=array(
            array('class_name','','栏目已经存在',0,'unique',1), 
            array('class_name','require','栏目名称不能为空'), 
            
        );
       if(!$mod->validate($rules)->create()){
            $this->error($mod->getError());
       }
       $data=$mod->create();
       if($mod->where("cid = {$_POST['id']}")->save($data)){
            $this->success('修改成功',U('service/class_service'));
        }else{
            $this->error('修改失败');
        }
    }
     //新闻编辑
    public function service_edit(){
        $list=M('service')->where("sid = {$_GET['id']}")->select();
        $this->assign('list',$list[0]);
        $class=M('service_class')->select();
        $this->assign('class',$class);
        $this->display('Service/service_edit');
    }
   

     //修改新闻
    public function update(){
        $id=$_POST['id'];
        $mod=M('service');
        $data=$mod->create();
        $upload=new \Think\Upload();
        //设置参数
        $upload->maxSize=314566779889;//大小
        $upload->exts=array("jpg","png","gif","jpeg");//类型
        $upload->rootPath="./Public/Uploads/";//根目录
        $upload->autoSub=false;//不生成的子目录
        //执行上传
        $info=$upload->upload();
        if($info){
            foreach($info as $file){
                $url="/Public/Uploads/".$file['savepath'].$file['savename']; 
            } 
            $data['photo']=$url;
        } 
        $data['addtime']=time(); 
        if($mod->where(" sid = {$id}")->save($data)){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

    public function service_del(){
        $id=$_GET['id'];
        // var_dump($_GET);exit;
        $mod=M('service');
        $path=$mod->where(" sid = {$id}")->getField('photo');
        if($mod->where(" sid = {$id}")->delete()){
            unlink('.'.$path);
            $this->success('删除成功',U('service/index'));
        }else{
             $this->error('删除失败');
        }
    }
}