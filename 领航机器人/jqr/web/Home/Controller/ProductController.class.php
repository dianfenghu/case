<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends SettingController {

    //产品类别列表
    public function productlist(){
        //标题
        if($_GET['Cid']){
            session('WebName',M("product_class")->where("Cid={$_GET['Cid']}")->getfield('ClassName').'-');
            session('PhoneWebName',M("product_class")->where("Cid={$_GET['Cid']}")->getfield('ClassName'));
        }
        //搜索
        if($_GET['keywords']){
            $so="Title like '%{$_GET['keywords']}%' and";
        }else{
            $so='';
        }
        //产品表
        $mod = M('product');
        $where=isset($_GET['Cid'])?"and Class={$_GET['Cid']}":'';
        $count = $mod->where("$so Status=1 $where")->count();
        $Page = new \Think\Page($count,12);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();
        $productlist = $mod->where("$so Status=1 $where")->order('AddTime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $ye=ceil($count/12);
        //分类
        // dump($mod->_sql());
        $productclass=M('product_class')->where("Cid={$_GET['Cid']}")->find();
        $this->assign('productclass',$productclass);
        $this->assign('ye',$ye);
        $this->assign('count',$count);
        $this->assign('page',$show);
        $this->assign('productlist',$productlist);
        $this->display('productlist');
    }

    //产品详情
    public function detail(){
        if(!$_GET['Pid']){
            $this->error('非法请求!');
            exit;
        }
        M('product')->where("Pid={$_GET['Pid']}")->setInc('click');
        //详情
        $info=M('product')->where("Pid={$_GET['Pid']}")->find();
        //标题
        if($_GET['Pid']){
            $a=session('WebName',$info['Title'].'-');
            $a=session('PhoneWebName',$info['Title']);
        }
        //分类
        $productclass=M('product_class')->where("Cid={$info['Class']}")->find();
        //上 下一条
        $prev=M('product')->where("Pid<{$_GET['Pid']} AND Class={$info['Class']}")->find();
        $next=M('product')->where("Pid>{$_GET['Pid']} AND Class={$info['Class']}")->find();
        $this->assign('productclass',$productclass);
        //推荐
        $tuijian=M('product')->order('rand()')->where("Class={$info['Class']}")->limit(3)->select();
        $this->assign('tuijian',$tuijian);
        $this->assign('info',$info);
        $this->assign('prev',$prev);
        $this->assign('next',$next);
        $this->display('pro_article');
    }

    //工程案例
    public function productcase(){
        $mod=M('product');
        $count=$mod->where('Class=16 and Status=1')->count();
        $Page = new \Think\Page($count,12);
        $show = $Page->show();
        $productlist=M('product')->order('AddTime desc')->where('Class=16 and Status=1')->limit($Page->firstRow,$Page->listRows)->select();
        session('title','工程案例-');
        session('PhoneName','工程案例');
        $ye=ceil($count/12);
        $this->assign('ye',$ye);
        $this->assign('productlist',$productlist);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->display('productlist');
    }

	
	//魔板4 调用
	 public function product_list(){
        
        if($_POST['Pid']){
            $list1=M('product')->order('AddTime desc')->where("Class={$_POST['Pid']}")->limit(8)->select();
        }else{
            $list1=M('product')->order('rand()')->limit(8)->select();
        }
        
        echo json_encode($list1);
    }
}