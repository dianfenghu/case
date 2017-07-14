<?php
namespace Home\Controller;
use Think\Controller;
class ReportController extends SettingController {

    //产品类别列表
    public function report_list($id=0){
        $mod=M('report');
        $count=$mod->where('Status=1')->count();
        $Page = new \Think\Page($count,9);
        $show = $Page->show();
        $list=$mod->order('Sequence desc')->where("Status=1")->limit($Page->firstRow,$Page->listRows)->select();
        // $report_list=M('product_class')->where("Cid={$id}")->find();
        // dump($product_class);
        if($_GET['mid']){
            $title=M('menu')->where("Mid={$_GET['mid']}")->getfield('Name');
            session('title',$title.'-');
        }else{
            session('title','工程案例.'-'');
        }
        $this->assign('show',$show);
        $this->assign('list',$list); 
        $this->display('report_list');
    }

    //产品详情
    public function detail($id=0){
        $mod=M('report');
        $info=$mod->where("Rid =$id")->find();
        $prev=M('report')->where("Rid<$id")->find();
        //下一条
        $next=M('report')->where("Rid>$id")->find();
        //分类
        //地区产品
        if($_GET['mid']){
            $title=M('menu')->where("Mid={$_GET['mid']}")->getfield('Name');
            session('title',$title.'-');
        }else{
            session('title',$info['Title']);
            session('keyword',$info['Keyword']);
        }
        // $areaweb=M('areaweb')->select();
        // $this->assign('areaweb',$areaweb);
        // $this->assign('product_class',$product_class);
        $this->assign('prev',$prev);
        $this->assign('next',$next);
        $this->assign('info',$info);
        $this->display('detail');
        // $this->assign('next',$arrayName['next']);
        // $this->assign('prev',$arrayName['prev']);
        // $this->display('Product/details');
    }
}