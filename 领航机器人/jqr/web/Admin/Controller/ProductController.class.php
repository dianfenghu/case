<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends AllowController {
    //产品列表
    public function index(){
        $mod=M('product');
        $name=isset($_POST['Name'])?$_POST['Name']:'';
        if($name){
            $where="Name like '%$name%'";
        }else{
            $where='';
        }
        $ProductCount=M('product')->count();
        $this->assign('ProductCount',$ProductCount);

        $product=$mod->where($where)
        ->order('Pid desc')
        ->join('tx_product_class on tx_product_class.Cid=tx_product.Class')
        ->field('tx_product_class.ClassName,tx_product.*')
        ->select();
        $this->assign("product",$product);
        $this->display("Product/ProductList");
    }

     //添加产品页
    public function addProduct(){
        $ProductClass=M('product_class')->order('Cid desc')->select();
        $this->assign('ProductClass',$ProductClass);
        $this->display("Product/AddProduct");
    }

    //添加产品
    public function insertProduct(){
        $mod=M('product');
        $mod->create();
        $mod->AddTime=time();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/Product/'; // 设置附件上传目录    // 上传文件     
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
                $image->open('./Public/Uploads/Product/'.$picName);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(188,150)->save('./Public/Uploads/Product/'.$thumbName);
                $mod->Photo=$picName;
                $row=$mod->add();
                if($row){
                    $this->success('添加成功！',U('Product/index'));
                }else{
                    $this->error('添加失败！');
                }   
            }
        }else{
            $row=$mod->add();
            if($row){
                $this->success('添加成功！',U('Product/index'));
            }else{
                $this->error('添加失败！');
            }
        }
        
    }

    //产品编辑页面
    public function editProduct(){
        $Pid=$_GET['Pid'];
        $Product=M("product")->where("Pid=$Pid")->select();
        $this->assign('Product',$Product);
        $ProductClass=M('product_class')->order('Cid desc')->select();
        $this->assign('ProductClass',$ProductClass);
        $this->display("Product/EditProduct");
    }

    //产品修改
    public function updataProduct(){
        $Pid=$_POST['Pid'];
        $mod=M('product');
        $OldNewsPhoto=$mod->where("Pid=$Pid")->getField('Photo');
        $mod->create();
        //图片上传
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3000000;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public/Uploads/Product/'; // 设置附件上传目录    // 上传文件     
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
                $image->open('./Public/Uploads/Product/'.$picName);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(188,150)->save('./Public/Uploads/Product/'.$thumbName);
                // echo $picName;
                $mod->Photo=$picName;
                $row=$mod->where("Pid=$Pid")->save();
                if($row){
                    if($OldNewsPhoto){
                        unlink('./Public/Uploads/Product/thumb_'.$OldNewsPhoto);
                        unlink('./Public/Uploads/Product/'.$OldNewsPhoto);
                    }
                    $this->success('修改成功！');
                }else{
                    $this->error("修改失败！");
                }   
            }
        }else{
            $row=$mod->where("Pid=$Pid")->save();
            if($row){
                 $this->success('修改成功！');
            }else{
                $this->error("修改失败！");
            }
        }
    }

    //修改产品状态
    public function setProductStatus(){
        $Pid=$_POST['Pid'];
        $status=M('product')->where("Pid=$Pid")->getField('Status');
        if($status){
            $row=M('product')->where("Pid=$Pid")->setField('Status',0);
        }else{
            $row=M('product')->where("Pid=$Pid")->setField('Status',1);
        }

        if($row){
            echo 1;
        }else{
            echo 0;
        }
    }

    //修改产品推荐状态
    public function setProductrecommend(){
        $Pid=$_POST['Pid'];
        $status=M('product')->where("Pid=$Pid")->getField('recommend');
        if($status){
            $row=M('product')->where("Pid=$Pid")->setField('recommend',0);
            echo 1;
        }else{
            $row=M('product')->where("Pid=$Pid")->setField('recommend',1);
            echo 2;
        }
    }

    //修改产品推荐状态
    public function setrecommend(){
        $Pid=$_POST['Pid'];
        $status=M('product')->where("Pid=$Pid")->getField('recommend');
        if($status){
            $row=M('product')->where("Pid=$Pid")->setField('recommend',0);
        }else{
            $row=M('product')->where("Pid=$Pid")->setField('recommend',1);
        }

        if($row){
            echo 1;
        }else{
            echo 0;
        }
    }
    //删除产品
    public function delProduct(){
        $Pid=$_POST['Pid'];
        $mod=M('product');
        $productPhoto=$mod->where("Pid=$Pid")->getField('Photo');
        $row=$mod->where("Pid=$Pid")->delete();
        if($row){
            unlink('./Public/Uploads/Product/thumb_'.$productPhoto);
            unlink('./Public/Uploads/Product/'.$productPhoto);
            echo 1;
        }else{
            echo 0;
        }
    }

    //批量删除
    public function batchDeleteProduct(){
        $Pids=$_POST['Pids'];
        $mod=M('product');
        foreach ($Pids as $key => $value) {
            $productPhoto=$mod->where("Pid=$value")->getField('Photo');
            $row=$mod->where("Pid=$value")->delete();
            if($row){
                unlink('./Public/Uploads/Product/thumb_'.$productPhoto);
                unlink('./Public/Uploads/Product/'.$productPhoto);
            }
        }
        $this->success('删除成功！');

    }

    //产品类别
    public function ProductClass(){
        $ProductClass=M('product_class')->order('Cid desc')->select();
        $class=M('product_class')->order('AddTime desc')->select();
        $level=M('product_class')->where('Level=1')->select();

        foreach($class as &$v){
            if($v['Path']!=0){
                $v['ClassName']='---|'.$v['ClassName'];
            }
        }
        $menu=array();
        foreach($level as $v){
            $menu[$v['Cid']]=$v['ClassName'];
        }
        $this->assign('menu',$menu);
        $this->assign('class',$class);
        $this->assign('ProductClass',$ProductClass);
        $this->display('Product/ProductClass');
    }

    //添加产品类别
    public function insertProductClass(){
        $mod=M('product_class');
        $mod->create();
        if($_POST['Level']==0){
            $mod->Level=1;
            $mod->Path=0;
        }else{
            $mod->Level=2;
            $mod->Path=$_POST['Level'];
        }

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
        $class=M('product_class')->select();
        $this->assign('class',$class);
        $this->assign('productClass',$productClass);
        $this->display('Product/EditProductClass');
    }

    //修改产品类别 
    public function updateProductClass(){
        $mod=M('product_class');
        $mod->create();
        if($_POST['Level']==0){
            $mod->Level=1;
            $mod->Path=0;
        }else{
            $mod->Level=2;
            $mod->Path=$_POST['Level'];
        }

        $row=$mod->save();
        if($row){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

    //删除产品类别
    public function delProductClass(){
        $Cid=$_GET['Cid'];
        $mod=M('product_class');

        $count=$mod->where("Path=$Cid")->count();
        if($count){
            $this->error('请先删除子类');
            exit;
        }

        $ProductCount=M('product')->where("Class=$Cid")->count();
        if($ProductCount > 0){
            $this->error('请先删除类别下产品');
            exit;
        }

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

    //产品图片管理
    public  function addPhoto(){
        $product_list=M('product')->select();
        $this->assign('product_list',$product_list);
        $this->display('AddPhoto');
    }

    //获取产品图片
    public function photolist(){
        $mod=M('product')->where("Pid={$_POST['Pid']}")->getfield('Ad_Photo');
        $list=explode('/',$mod);
        array_pop($list);
        echo json_encode($list);
    }

    //执行图片添加
    public function insertProductPhoto(){
        if(!$_POST['Pid']){
            $this->error('请选择产品');
            exit();
        }
        $mod=M('product');
        //原图片
        $old=M('product')->where("Pid={$_POST['Pid']}")->getfield('Ad_Photo');
        $mod->create();
        $upload = new \Think\Upload();
        $upload->maxSize = 3000000000000 ;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath = './Public/Uploads/Product/Ad_Photo/'; 
        $upload->savePath = ''; 
        $info = $upload->upload();
        if(!$info) {
            $this->error($upload->getError());
        }else{
             //删除原图片
            if($old){
                $oldphoto=explode('/',$old);
                array_pop($oldphoto);
                foreach($oldphoto as $v){
                    unlink('./Public/Uploads/Product/Ad_Photo/thumb_'.$v);
                    unlink('./Public/Uploads/Product/Ad_Photo/'.$v);
                }
            }
            foreach($info as $file){ 
                $image = new \Think\Image();
                $image->open('./Public/Uploads/Product/Ad_Photo/'.$file['savename']);
                $image->thumb(150,150)->save('./Public/Uploads/Product/Ad_Photo/thumb_'.$file['savename']);
                $arr.=$file['savename'].'/';  
            }
            $mod->Ad_Photo=$arr;
            if($mod->save()){
                $this->success('保存成功');
            }else{
                $this->error('保存失败');
            }
        }
    }

    //分类排序
    public function Sequence(){
        $row=A('Menu')->_Sequence('product_class','Cid',$_POST);
        if($row){
            $this->success('排序成功');
        }else{
            $this->error('排序失败');
        }
    }

    //产品排序
    public function ProductSequence(){
        // dump($_POST);
        $row=A('Menu')->_Sequence('product','Pid',$_POST);
        if($row){
            $this->success('排序成功');
        }else{
            $this->error('排序失败');
        }
    }
}