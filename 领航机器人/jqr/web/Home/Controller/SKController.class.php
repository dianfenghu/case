<?php
// +----------------------------------------------------------------------
// | 查词系统
// +----------------------------------------------------------------------
// | Time：2017-1-19
// +----------------------------------------------------------------------
// | Author: 刘伟超 <liuweichao_2005@126.com>
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;
class SKController extends SettingController {
    public function index(){
        $searchArray=array();
        //关键词
        $setting=M('setting')->order('Sid desc')->where("Sid=8")->find(); 
        $keywordsArray=explode(',',$setting['Keyword']);


        //产品名称
        $productName=M('product')->field('Name')->select();
        foreach ($productName as $productNamekey => $productNamevalue) {
            Array_push($keywordsArray,$productNamevalue['Name']);
        }
        $KeywordNumber=0;
        foreach ($keywordsArray as $keywordsArraykey => $keywordsArrayvalue) {
            $searchArray[]=$keywordsArrayvalue;
            $KeywordNumber++;
        }

        //分站
        $areaWeb=M('areaweb')->where('Status=1')->limit(10)->select();
        $this->assign('areaWeb',$areaWeb);

        foreach ($areaWeb as $areaWebkey => $areaWebvalue){
            if($KeywordNumber>=1500){
                break;
            }
            foreach ($keywordsArray as $key => $value) {
                $searchArray[]=$areaWebvalue['AreaName'].$value;
                $KeywordNumber++;
                if($KeywordNumber>=1500){
                    break;
                }
            }

        }
        $this->assign('keyNumber',count($searchArray));
        $this->assign('searchArray',$searchArray);
        $this->display('SK/index');

    }



    public function searchFunction(){
        $returnData=array();
        for ($i=0; $i < 2; $i++) { 
            $Result=$this->baiduSearch($_POST['text'], $_SERVER['SERVER_NAME'],$i*10);
            if($Result['ShowNumber']>=1){
                $returnData[$i]['keyword']=$Result['Keywords'];
                $returnData[$i]['showNumber']=$Result['ShowNumber'];
                $returnData[$i]['website']=$Result['Website'];
                $returnData[$i]['searchTime']=date('Y-m-d H:i:s',$Result['AddTime']);
                $returnData[$i]['pageSize']=$Result['PageSize'];
            }
           
        }
        if($returnData){
            $this->ajaxReturn($returnData);
        }else{
            echo 0;
        }
        
    }

    public function searchScript(){
        //关键词
        $setting=M('setting')->order('Sid desc')->where("Sid=8")->find(); 
        $keywordsArray=explode(',',$setting['Keyword']);


        //产品名称
        $productName=M('product')->field('Name')->select();
        foreach ($productName as $productNamekey => $productNamevalue) {
            Array_push($keywordsArray,$productNamevalue['Name']);
        }
        $KeywordNumber=0;
        foreach ($keywordsArray as $keywordsArraykey => $keywordsArrayvalue) {
            $searchArray[]=$keywordsArrayvalue;
            $KeywordNumber++;
        }

        //分站
        $areaWeb=M('areaweb')->where('Status=1')->limit(10)->select();
        $this->assign('areaWeb',$areaWeb);
        foreach ($areaWeb as $areaWebkey => $areaWebvalue){
            if($KeywordNumber>=1500){
                break;
            }
            foreach ($keywordsArray as $key => $value) {
                $searchArray[]=$areaWebvalue['AreaName'].$value;
                $KeywordNumber++;
                if($KeywordNumber>=1500){
                    break;
                }
            }
        }

        foreach ($searchArray as $searchArraykey => $searchArrayvalue) {
            for ($i=0; $i < 2; $i++) { 
                $Result=$this->baiduSearch($searchArrayvalue, $_SERVER['SERVER_NAME'],$i*10);
                if($Result['ShowNumber']>=1){
                    $returnData[$i]['keyword']      =   $Result['Keywords'];
                    $returnData[$i]['showNumber']   =   $Result['ShowNumber'];
                    $returnData[$i]['website']      =   $Result['Website'];
                    $returnData[$i]['searchTime']   =   date('Y-m-d H:i:s',$Result['AddTime']);
                    $returnData[$i]['pageSize']     =   $Result['PageSize'];
                }
            }

        }
        echo '<script type="text/javascript">window.opener=null;window.open("","_self");window.close();</script>';
    }


    public function baiduSearch($wordkey,$website,$pageSize){
        $contents = $this->curl_file_get_contents("http://www.baidu.com/s?wd={$wordkey}&&pn={$pageSize}");
        $showNumber = substr_count($contents,'>'.$website);
        $data['Keywords'] =  $wordkey;
        $data['Website']  =  $website;
        $data['PageSize'] =  $pageSize/10+1;
        $data['AddTime']  =  time();
        $data['SearchEngines'] = '百度';
        $data['SearchHref'] = "http://www.baidu.com/s?wd={$wordkey}&&pn={$pageSize}";
        $data['ShowNumber'] = $showNumber;
        $data['UserKey'] = USER_KEY;
        if($showNumber>=1){
            $this->curl_post(SYSTEM_ADDRESS."Home/Receive/index", $data);
        }
        return $data;
    }

    public function curl_post($url, $post){
        $options = array(
        CURLOPT_RETURNTRANSFER =>true,
        CURLOPT_HEADER =>false,
        CURLOPT_POST =>true,
        CURLOPT_POSTFIELDS => $post,
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function curl_file_get_contents($durl){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $durl);
      curl_setopt($ch, CURLOPT_TIMEOUT, 5);
      curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
      curl_setopt($ch, CURLOPT_REFERER,_REFERER_);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $r = curl_exec($ch);
      curl_close($ch);
       return $r;
    }

}