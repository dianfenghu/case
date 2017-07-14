<?php
namespace Home\Controller;
// use Think\Controller;
class IndexController extends SettingController {
    public function index(){
		       // $links=M('links')->find();
           // var_dump($links);
          // $this->assign('links',$links);
      		$this->display('Index/index');

    }

    //联系我们
    public function contact(){
      $content=M('menu')->where("Mid={$_GET['Mid']}")->find();
      $news=M("news")->order('rand()')->where("Class=7 AND Status=1")->select();
     $this->assign('news',$news);
      $this->assign('content',$content);
      $this->display('About/about');
    }


    //公司简介
    public function introduction(){
      $path=M('menu')->where("Mid={$_GET['Mid']}")->getfield("Path");
      $list=M("menu")->where("Path={$path} AND Status=1")->select();
      $introduction=M('menu')->where("Mid={$_GET['Mid']}")->find();
      $this->assign('introduction',$introduction);
      $this->assign('list',$list);
      $this->display('About/introduction');
    }

    //留言
    public function message(){
      $path=M('menu')->where("Mid={$_GET['Mid']}")->find();
      $news=M("news")->order('rand()')->where("Class=7 AND Status=1")->select();
      $this->assign('classname',$path);
      $this->assign('news',$news);
      $this->display('About/message');
    }

    //验证码
    public function selfverify(){
      $Verify = new \Think\Verify();
      $Verify->useImgBg = true;
      $Verify->entry();
    }
  
    //开始留言
    public function messageinsert(){
      $rules = array( 
      // array('Name','require','请填写验证码！'),
      array('Code','require','请填写姓名！'),
      array('Phone','require','请填写手机,方便我们联系您!'),
      array('Email','require','请填写邮箱,方便我们联系您！'),
      array('Content','require','请填写你的宝贵意见！'),
      array('Name','require','请填写姓名！'),
         );
      $mod=M('message');
      if(!$mod->validate($rules)->create()){
        $this->error($mod->getError());
      }else{
        $mod->AddTime=time();
        if($mod->add()){
          $this->success('留言成功!感谢你的反馈');
        }else{
          $this->error('留言失败');
        }
      }
    }
}