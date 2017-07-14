<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends SettingController {
    //新闻资讯详情页
    public function detail(){
        if(!$_GET['Nid']){
            $this->error('非法请求!');
            exit;
        }
        M('news')->where("Nid={$_GET['Nid']}")->setInc('BrowseAmount');
        //详情
        $info=M('news')->where("Nid={$_GET['Nid']}")->find();
        if($_GET['Nid']){
            $a=session('WebName',$info['Title'].'-');
            $a=session('PhoneWebName',$info['Title']);
        }
        // dump($a);
        //分类
        $newsclass=M('news_class')->where("Cid={$info['Class']}")->find();
        //上 下一条
        $prev=M('news')->where("Nid<{$_GET['Nid']} AND Class={$info['Class']}")->find();
        $next=M('news')->where("Nid>{$_GET['Nid']} AND Class={$info['Class']}")->find();
        //推荐新闻
        $tj=M('news')->order('rand()')->where("Class={$info['Class']}")->limit(5)->select();

        $this->assign('tuijian',$tj);
        $this->assign('newsclass',$newsclass);
        $this->assign('info',$info);
        $this->assign('prev',$prev);
        $this->assign('next',$next);
        $this->display('news_article');

    }
    
    //新闻列表
    public function newslist(){
        //标题
        if($_GET['Cid']){
            session('WebName',M("news_class")->where("Cid={$_GET['Cid']}")->getfield('ClassName').'-');
            session('PhoneWebName',M("news_class")->where("Cid={$_GET['Cid']}")->getfield('ClassName'));
        }
        $mod = M('news');
        $where=isset($_GET['Cid'])?"and Class={$_GET['Cid']}":'';
        $count = $mod->where("Status=1 $where")->count();
        $Page = new \Think\Page($count,12);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $newslist = $mod->where("Status=1 $where")->order('AddTime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $ye=ceil($count/12);
         $show = $Page->show();
       //分类
        $newsclass=M('news_class')->where("Cid={$_GET['Cid']}")->find();
        //手机页 风格5 随机新闻
        $this->assign('rand_news',M('news')->order('rand()')->where('Status=1')->find());
        //手机随机新闻 风格2
        $rand=M('news')->order('rand()')->where('Status=1')->limit(4)->select();
        //手机公司新闻
        $news_gs=M('news')->order('AddTime desc')->where('Class=7 and Status=1')->select();
        //手机 咨询
        $news_zx=M('news')->order('AddTime desc')->where('Class=8 and Status=1')->select();
        $this->assign('news_gs',$news_gs);
        $this->assign('news_zx',$news_zx);
        $this->assign('rand',$rand);
        $this->assign('newsclass',$newsclass);
        $this->assign('ye',$ye);
        $this->assign('count',$count);
        $this->assign('page',$show);
        $this->assign('newslist',$newslist);
        $this->display('newslist');
    }   
    
}