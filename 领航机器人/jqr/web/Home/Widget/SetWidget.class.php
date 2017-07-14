<?php
namespace Home\Widget;
use Think\Controller;
class SetWidget extends Controller{
    public function header(){
        $header=M('setting')->find('8');
        $this->display('Public/header');
    }

    public function menu(){      
        //父栏目
        $fatherMenu=M('menu')->where('(Path = 0) AND (Status=1)')->order('Sequence desc')->select();
        $this->assign('fatherMenu',$fatherMenu);

        // $menuCount  =M('menu')->where("(Path = 0) and (status=1)")->count();
        // $this->assign('menuCount',$menuCount);

        // //子栏目
        $childMenu=M('menu')->where('(Path != 0) AND (Status=1)')->order('Sequence desc')->select();
        $this->assign('childMenu',$childMenu);

        $menuCounts  =M('menu')->where("Path != 0 AND status=1")->count();
        $this->assign('menuCounts',$menuCounts);
        // dump($menuCounts);
        
        // foreach ($fatherMenu as $key => $value) {
        //     foreach ($childMenu as $keys => $values) {
        //         if($values['Path']==$value['Mid']){
        //             // echo $values['Name']."<br />";
        //             $fatherMenu[$key]['menuPage']=$values['Name'];

        //         }
                
        //     }
        // }
        // // echo "<pre>";
        // dump($fatherMenu);
        $banner=M('banner')->order('Bid desc')->where('Status=1')->select();
        $this->assign('banner',$banner);
      
        // // // //新闻类别
        $newsClass=M('news_class')->select();
        $this->assign('newsClass',$newsClass);
        // // // //产品类别
        $productClass=M('product_class')->select();
        $this->assign('productClass',$productClass);
        //logo
        $set=M('setting')->where('Sid=8')->find();
        $this->assign('set',$set);
        //网站公告
        // $notice=M('notice')->order('AddTime desc')->where('Status=1')->find();
        // $this->assign('notice',$notice);

        //热门搜索
        $remen=M('product')->order('click desc')->where("Status=1")->limit(3)->select();
        $this->assign('remen',$remen);
        $this->display('Public/menu');
    }   


    // //网站底部
    public function footer(){
        $set=M('setting')->where('Sid=8')->find();
        $this->assign('set',$set);
        //友情链接
        $links=M('links')->where("Status=1")->select();
        $this->assign('links',$links);
        // //父栏目
        $fatherMenu=M('menu')->where('(Path = 0) AND (Status=1)')->order('Mid asc')->select();
        $this->assign('fatherMenu',$fatherMenu);
        $footerCode=file_get_contents("./web/Home/View/Public/footercode.html");
        $this->assign('footerCode',$footerCode);
        // dump($fatherMenu);
        $this->display('Public/footer');
    }


    //banner
    public function banner(){
        $banners=M('banner')->where('Status=1 and type=2')->select();
        $this->assign('banner',$banners);
        $this->display('Public/banner');
    }
    
    //新闻列表
    public function news_class(){
        $news_class=M('news_class')->order('Sequence desc')->select();
        $this->assign('news_class',$news_class);
        $this->display('Public/news_class');
    }

    //产品列表
    public function product_class(){

        $product_class=M('product_class')->order('Sequence desc')->select();
        $this->assign('product_class',$product_class);
        $this->display('Public/product_class');
    }

    //联系我们
    public function contact(){
        $set=M('setting')->where("Sid=8")->find();
        $this->assign('set',$set);
        $this->display('Public/contact');
    }

    //公告列表
    // public function notice(){
    //     $list=M('notice')->order('rand()')->where('Status=1')->limit(5)->select();
    //     $this->assign('list',$list);
    //     $this->display('Public/notice');
    // }

    //关于我们
    public function about(){
        $about=M('menu')->where('Path=14 and Status=1')->select();
        $this->assign('about',$about);
        $this->display('Public/about');
    }
}