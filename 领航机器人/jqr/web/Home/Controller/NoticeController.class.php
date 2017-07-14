<?php
namespace Home\Controller;
use Think\Controller;
class NoticeController extends SettingController {

    // //产品类别列表
    // public function productlist(){
    //     //标题
    //     if($_GET['Cid']){
    //         session('WebName',M("product_class")->where("Cid={$_GET['Cid']}")->getfield('ClassName').'-');
    //     }
    //     //公告品表
    //     $mod = M('notice');
    //     $where=isset($_GET['Nid'])?"and Class={$_GET['Nid']}":'';
    //     $count = $mod->where("Status=1 $where")->count();
    //     $Page = new \Think\Page($count,12);
    //     $show = $Page->show();
    //     $noticelist = $mod->where("Status=1 $where")->order('AddTime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    //     $ye=ceil($count/12);
    //     //分类
    //     // dump($mod->_sql());
    //     // $productclass=M('product_class')->where("Cid={$_GET['Cid']}")->find();
    //     // $this->assign('productclass',$productclass);
    //     $this->assign('ye',$ye);
    //     $this->assign('count',$count);
    //     $this->assign('page',$show);
    //     $this->assign('noticelist',$noticelist);
    //     $this->display('noticelist');
    // }

    //产品详情
    public function detail(){
        if(!$_GET['Nid']){
            $this->error('非法请求!');
            exit;
        }
        //详情
        $info=M('notice')->where("Nid={$_GET['Nid']}")->find();
        //标题
        if($_GET['Nid']){
            $a=session('WebName',$info['Title'].'-');
        }
        //分类
        $productclass=M('product_class')->where("Cid={$info['Class']}")->find();
        //上 下一条
        $prev=M('product')->where("Pid<{$_GET['Pid']} AND Class={$info['Class']}")->find();
        $next=M('product')->where("Pid>{$_GET['Pid']} AND Class={$info['Class']}")->find();
        $this->assign('productclass',$productclass);
        $this->assign('info',$info);
        $this->assign('prev',$prev);
        $this->assign('next',$next);
        $this->display('notice_article');
    }

    //工程案例
    public function productcase(){
        $mod=M('product');
        $count=$mod->where('recommend=1 AND Status=1')->count();
        $Page = new \Think\Page($count,9);
        $show = $Page->show();
        $productlist=M('product')->where('recommend=1')->limit($Page->firstRow,$Page->listRows)->select();
        session('title','工程案例-');
        $ye=ceil($count/12);
        $this->assign('ye',$ye);
        $this->assign('productlist',$productlist);
        $this->assign('show',$show);
        $this->assign('count',$count);
        $this->display('productlist');
    }
}