<?php
namespace Home\Widget;
use Think\Controller;
class CaseWidget extends Controller{
    public function header(){
        $this->assign('set',M('setting')->find('8'));
        $this->assign('header',M('setting')->find('8'));
        $fatherMenu=M('menu')->where('(Path = 0) AND (PhoneStatus=1)')->order('PhoneSequence desc')->select();
        $this->assign('fatherMenu',$fatherMenu);
        $this->display('Public/header');
    }

     //header
    public function header1(){
        $this->assign('header',M('setting')->find('8'));

        $fatherMenu=M('menu')->where('(Path = 0) AND (PhoneStatus=1)')->order('PhoneSequence desc')->select();
        $this->assign('fatherMenu',$fatherMenu);
        // //子栏目
        $childMenu=M('menu')->where('(Path != 0) AND (PhoneStatus=1)')->order('PhoneSequence desc')->select();
        $this->assign('childMenu',$childMenu);

        $menuCounts  =M('menu')->where("Path != 0 AND PhoneStatus=1")->count();
        $this->assign('menuCounts',$menuCounts);
      
        // // // //新闻类别
        $newsClass=M('news_class')->select();
        $this->assign('newsClass',$newsClass);
        // // // //产品类别
        $productClass=M('product_class')->select();
        $this->assign('productClass',$productClass);
        $this->display('Public/header1');
    }
    public function menu(){      
        //父栏目
        $fatherMenu=M('menu')->where('(Path = 0) AND (PhoneStatus=1)')->order('PhoneSequence desc')->select();
        $this->assign('fatherMenu',$fatherMenu);

        // //子栏目
        $childMenu=M('menu')->where('(Path != 0) AND (Status=1)')->order('Sequence desc')->select();
        $this->assign('childMenu',$childMenu);

        $menuCounts  =M('menu')->where("Path != 0 AND status=1")->count();
        $this->assign('menuCounts',$menuCounts);
        // dump($menuCounts);
        $banner=M('banner')->order('Bid desc')->where('Status=1')->select();
        $this->assign('banner',$banner);
      
        // // // //新闻类别
        $newsClass=M('news_class')->select();
        $this->assign('newsClass',$newsClass);
        // // // //产品类别
        $productClass=M('product_class')->select();
        $this->assign('productClass',$productClass);
        //logo
        $logo=M('setting')->where('Sid=8')->getfield('Logo');
        $this->assign('logo',$logo);
		//手机logo
		$this->assign('set',M('setting')->find('8'));
        //网站公告
        $notice=M('notice')->order('AddTime desc')->where('Status=1')->find();
        $this->assign('notice',$notice);
        $this->display('Public/menu');
    }   

	    //菜单2
        public function menu1(){      
        //父栏目
        $fatherMenu=M('menu')->where('(Path = 0) AND (PhoneStatus=1)')->order('PhoneSequence desc')->select();
        $this->assign('fatherMenu',$fatherMenu);

        // //子栏目
        $childMenu=M('menu')->where('(Path != 0) AND (PhoneStatus=1)')->order('PhoneSequence desc')->select();
        $this->assign('childMenu',$childMenu);

        $menuCounts  =M('menu')->where("Path != 0 AND Phonestatus=1")->count();
        $this->assign('menuCounts',$menuCounts);
        $banner=M('banner')->order('Bid desc')->where('PhoneStatus=1 and ')->select();
        $this->assign('banner',$banner);
      
        // // // //新闻类别
        $newsClass=M('news_class')->select();
        $this->assign('newsClass',$newsClass);
        // // // //产品类别
        $productClass=M('product_class')->select();
        $this->assign('productClass',$productClass);
        //logo
        $logo=M('setting')->where('Sid=8')->getfield('Logo');
        $this->assign('logo',$logo);
        //网站公告
        $notice=M('notice')->order('AddTime desc')->where('Status=1')->find();
        $this->assign('notice',$notice);
        $this->display('Public/menu1');
    } 

    // //网站底部
    public function footer(){
        $set=M('setting')->where('Sid=8')->find();
        $this->assign('set',$set);
        // //父栏目
        $fatherMenu=M('menu')->where('(Path = 0) AND (Status=1)')->order('Mid asc')->select();
        $this->assign('fatherMenu',$fatherMenu);
        // dump($fatherMenu);
        $footercode=file_get_contents('./web/Home/View/Public/footercode.html');
        $this->assign('footer',$footercode);
        $this->display('Public/footer');
    }


    //banner
    public function banner(){
        $banners=M('banner')->where('type=1 and Status=1')->select();
        $this->assign('banner',$banners);
        $this->display('Public/banner');
    }
    
    //新闻列表
    public function news_class(){
        $news_class=M('news_class')->select();
        $this->assign('news_class',$news_class);
        $this->display('Public/news_class');
    }

    //产品列表
    public function product_class(){
        $product_class=M('product_class')->select();
        $this->assign('product_class',$product_class);
        $this->display('Public/product_class');
    }

    //联系我们
    public function incontact(){
        $set=M('setting')->where("Sid=8")->find();
        $this->assign('set',$set);
        $this->display('Public/incontact');
    }

    //公告列表
    public function notice(){
        $list=M('notice')->order('rand()')->where('Status=1')->limit(5)->select();
        $this->assign('list',$list);
        $this->display('Public/notice');
    }
}