<?php
namespace Admin\Controller;
use Think\Controller;
class AllowController extends Controller {
    public function _initialize(){
    	// $_SESSION['admin']="admin123";
    
		if(!$_SESSION['admin']){
	       	$this->error("请您先登录！",U("Login/index"));
		}else{
			$setting=M('setting')->order('Sid desc')->limit(1)->select();   
	        $keyword        =   $setting[0]['Keyword'];                             //网站关键字;
	        $title          =   $setting[0]['Title'];           //网站标题;
	        $description    =   $setting[0]['Description'];     //网站描述;
	        $qq             =   $setting[0]['QQ'];              //客服QQ;
	        $tel            =   $setting[0]['Tel'];             //客服电话;
	        $url            =   $setting[0]['Url'];             //网址;
	        $logo           =   $setting[0]['Logo'];            //网站logo;
	        $copyright      =   $setting[0]['Copyright'];       //版权;
	        $caseNumber     =   $setting[0]['CaseNumber'];      //备案号;
	        $introduction   =   $setting[0]['Introduction'];    //公司简介;
	        $contact        =   $setting[0]['Contact'];         //联系方式;
	        $QRcode         =   $setting[0]['QRcode'];          //二维码;
	        $status         =   $setting[0]['Status'];          //网站状态;

	        $this->assign('keyword',$keyword);
	        $this->assign('title',$title);
	        $this->assign('description',$description);
	        $this->assign('qq',$qq);
	        $this->assign('tel',$tel);
	        $this->assign('url',$url);
	        $this->assign('logo',$logo);
	        $this->assign('copyright',$copyright);
	        $this->assign('caseNumber',$caseNumber);
	        $this->assign('introduction',$introduction);
	        $this->assign('contact',$contact);
	        $this->assign('QRcode',$QRcode);
		}
    }
}