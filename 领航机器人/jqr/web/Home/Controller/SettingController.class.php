<?php
namespace Home\Controller;
use Think\Controller;
class SettingController extends Controller {
    public function _initialize(){ 
	   if (ismobile()) {
            $s=phone_style();
            if($s!=0){
                $this->theme('Phone'.$s);
            }else{
                $this->theme('default');
            }
            
        }
     	//网站设置
        $setting=M('setting')->order('Sid desc')->where("Sid=8")->find();   
        $keyword        =   '';                             //网站关键字;
        $title          =   $setting['WebTitle'];           //网站标题;
        $description    =   $setting['Description'];     //网站描述;
        $qq             =   $setting['QQ'];              //客服QQ;
        $tel            =   $setting['Tel'];             //客服电话;
        $url            =   $setting['Url'];             //网址;
        $logo           =   $setting['Logo'];            //网站logo;
        $copyright      =   $setting['Copyright'];       //版权;
        $caseNumber     =   $setting['CaseNumber'];      //备案号;
        $introduction   =   $setting['Introduction'];    //公司简介;
        $contact        =   $setting['Contact'];         //联系方式;
        $QRcode         =   $setting['QRcode'];          //二维码;
        $status         =   $setting['Status'];          //网站状态;
        $phone          =   $setting['Phone'];           //手机号码;
        $email          =   $setting['Email'];           //电子邮箱;
        $address        =   $setting['Address'];         //公司地址;
        $copyright      =   $setting['Copyright'];       //版权信息;

        if(!$status){
            $this->error("网站正在维护中......！",U("Close/index"));
            exit();
        }
        session(array('name'=>'session_id','expire'=>3600));
        //分站
        $areaWeb=M('areaweb')->where('Status=1')->limit(10)->select();
        $this->assign('areaWeb',$areaWeb);
        //关键字
        $keywordsArray=explode(',',$setting['Keyword']);
        session('keywords',$setting['Keyword']);//头部用
        session('keyword',str_replace(',', '_',$setting['Keyword']));//标题用

        //单挑随机新闻
        $newsone=M('news')->order('rand()')->where('Class=7')->find();
        $this->assign('newsone',$newsone);
        $Aid=isset($_GET['Aid'])?$_GET['Aid']:0;
        
        if($Aid>0){
            session('AreaName',M('areaweb')->where("Aid=$Aid")->getField('AreaName'));	
        }
		// dump($_SESSION);
        $Bid=isset($_GET['Bid'])?$_GET['Bid']:'';
        if($Bid){
            $_SESSION['BrandName']=M('brand_promotion')->where("Bid=$Bid")->getField('BrandName');
        }

        if($_GET['Mid'] && $_GET['Mid']!=1){
            session('WebName',M('menu')->where("Mid={$_GET['Mid']}")->getfield('Name').'-');
            session('PhoneWebName',M('menu')->where("Mid={$_GET['Mid']}")->getfield('Name'));
        }else{
            session('WebName',null);
            session('PhoneWebName',null);
        }
        if($_GET['Mid']==1){
            session('AreaName',null);
        	session('WebName',null);
        }
        session('WebTitle',session('keyword').'-'.$title);//标题
        session('description',$_SESSION['AreaName'].$description);//描述

        // $this->assign('keyword',$keyword);
        $this->assign('title',$title);
        // $this->assign('description',$_SESSION['AreaName'].$_SESSION['BrandName'].$description);
        $this->assign('qq',$qq);
        $this->assign('WebTitle',$title);
        $this->assign('tel',$tel);
        $this->assign('url',$url);
        $this->assign('logo',$logo);
        $this->assign('copyright',$copyright);
        $this->assign('caseNumber',$caseNumber);
        $this->assign('introduction',$introduction);
        $this->assign('contact',$contact);
        $this->assign('QRcode',$QRcode);
        $this->assign('Phone',$Phone);
        $this->assign('Email',$email);
        $this->assign('Address',$address);
        //友情链接
        $links=M('links')->where("Status=1")->select();
        $Files=M('files')->where("Status=1")->select();
        // var_dump($File);
        // dump(M('files')->_sql());
        $this->assign('links',$links);
        $this->assign('files',$Files);

        //取数据
        $dataTable=M('display_data')->select();
        $arrayData=array();
        foreach ($dataTable as $dataTableKey => $dataTableValue) {
            $arrayData[$dataTableValue['VariableName']]=$this->dataList($dataTableValue['DataTable'],$dataTableValue['DataAmount'],$dataTableValue['VariableName'],$dataTableValue['Condition']);
            $this->assign($dataTableValue['VariableName'],$arrayData[$dataTableValue['VariableName']]);
        }

        // dump($newslist);
        $news=M('news')->where("Nid=2")->join('tx_news_class on tx_news_class.Cid=tx_news.Class')->select();
        foreach ($news[0] as $key => $value) {
            $this->assign($key,$value);
        }
		$fatherMenu=M('menu')->order('PhoneSequence desc')->where('Path=0 and PhoneStatus=1')->select();
		$this->assign('fatherMenu',$fatherMenu);
        // dump($dataTableValue);
        //公司介绍
        $Introduction=M('setting')->where('Sid=8')->getfield('Introduction');
        $this->assign('Introduction',$Introduction);
        //产品分类
        $product_class=M('product_class')->select();
        $this->assign('product_class',$product_class);
        //产品表
        $where=isset($_GET['Cid'])?"AND Class={$_GET['Cid']}":'';
        if($_GET['Cid']){
            session('WebName',M('product_class')->where("Cid={$_GET['Cid']}")->getField('ClassName').'-');
        }
        $product_list=M('product')->where("Status=1 $where")->limit(8)->select();
        // dump($product_list);
        $count=M('product')->where("Status=1 $where")->count();
        $count=M('news')->where("Class=7")->count();
        $this->assign('count',$count);
        $this->assign('productlist',$product_list);
       // dump(session());
	   //新闻
	   $news=M('news')->order('AddTime desc')->where('Status=1')->limit(6)->select();
	   $this->assign('newslist',$news);
    }

    //分条取数据
    public function dataList($table,$limit,$variableName,$where){
        $mod=M($table);
        $variableName=$mod->where($where)->limit($limit)->select();
        return $variableName;
        return $str;
    }

}