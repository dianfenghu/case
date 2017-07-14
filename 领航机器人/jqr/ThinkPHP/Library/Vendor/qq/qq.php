<?php 
/******************************************************************************************** 
     发送QQ信息PHP接口         
     2016-10-18 作者：顺便牵手一下（1306162647@.com） 
     构造：   new QQ('QQ号','QQ密码'[,会话ID]); 
     属性：   username QQ号   
     passowrd QQ密码   ssid     
     会话ID   error    Array([错误时的服务返回数据]) 
     方法：   send('目标QQ号','信息')     
     成功返回：true     
     失败返回：false   
     login()     成功返回：ssid     
     失败返回：false 
**********************************************************************************************/ 
class QQ {   
    $data = array(  
    'qq'            => $qq,  
    'pwd'           => $pwd,  
    'bid_code'      => '3GQQ',  
    'toQQchat'      => true,  
    'login_url'     => 'http://pt.3g.qq.com/s?aid=nLoginnew&q_from=3GQQ',  
    'q_from'        => '',  
    'modifySKey'    => 0,  
    'loginType:'    => 1,  
    'aid'           => 'nLoginHandle',  
    'i_p_w'         => 'qq|pwd|',  
    );  
    //开始CURL模拟登录  
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,'http://pt.3g.qq.com/psw3gqqLogin');  
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch,CURLOPT_POST,true);  
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($data));  
    $file = curl_exec($ch);  
    curl_close($ch);  
    //分析登录是否成功  
    preg_match('%sid=(.*?)&%si',$file,$sid);  
    $sid = $sid[1];  
    if($sid){  
        echo '登陆成功！';  
    }else{  
        echo '登陆失败！请检查用户名和密码是否正确！';  
        exit();  
    }  
    //填写上一步中获取的sid，你也可以改成$_GET来传递sid  
    $sid  = '';  
    //接收方的QQ和要发送的内容  
    $qq   = '';  
    $text = '';  
    //准备要POST的数据  
    $data = array(  
        'u'         => $qq,  
        'saveUrl'   => 0,  
        'do'        => 'send',  
        'on'        => 1,  
        'aid'       => '发送',  
        'msg'       => $text,  
    );  
    //开始CURL模拟发送  
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,'http://q16.3g.qq.com/g/s?sid=' . $sid);  
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch,CURLOPT_POST,true);  
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($data));  
    $file = curl_exec($ch);  
    curl_close($ch);  
    //分析发送是否成功  
    preg_match('%<p align="left">(.*?)<br/>%si',$file,$callback);  
    $callback = $callback[1];  
    echo $callback;  

   //  public $id='3219751346';  
   //  public $password='qq1306162647';   
   //  public $error=array();   
   //  public $ssid;   
   //  private $cache;   
   //  public function QQ($id,$password,$ssid=null){     
   //      $this->id=$id;     
   //      $this->password=$password;     
   //      touch($this->cache=sys_get_temp_dir().'qq.php.'.md5($id));     
   //      $ssid and file_put_contents($this->cache,$ssid);     
   //      $this->ssid=file_get_contents($this->cache) or $this->login();   
   //  }   
   //  public function login(){     
   //      $r=QQ::ajax(       
   //          'http://pt.3g.qq.com/psw3gqqLogin',       
   //          array(         
   //              qq=>$this->id,pwd=>$this->password,         
   //              loginType=>1,i_p_w=>'qq|pwd|',         
   //              toQQchat=>'true',bid_code=>'3GQQ',         
   //              aid=>'nLoginHandle'       
   //              )     
   //          );     
   //      if(preg_match('/成功[\s\S]+sid=([^&]+)/',$r,$m)){       
   //          file_put_contents($this->cache,$m[1]);       
   //          return $this->ssid=$m[1];     
   //      }else{       
   //          $this->error[]=$r;       
   //          return false;     
   //      };   
   //  }   
   //  public function send($qq,$message){     
   //      $retry=3;     
   //      while($retry--){       
   //          $r=QQ::ajax(         
   //              'http://q16.3g.qq.com/g/s?sid='.$this->ssid,         
   //              array(          
   //                  msg=>$message,
   //                  num=>$qq,
   //                  'do'=>'send',
   //                  u=>$qq,           
   //                  'saveURL'=>'0',
   //                  aid=>'发送QQ消息',
   //                  on=>1         
   //                  )       
   //              );       
   //          if(preg_match('/消息发送成功/',$r))return true;       
   //          $this->error[]=$r;       
   //          $this->login();     
   //      };     
   //      return false;  
   //  }   
   // private static function ajax($url,$data=null){     curl_setopt($c=curl_init($url),CURLOPT_RETURNTRANSFER,1);     $data and $data=http_build_query($data)           and curl_setopt($c,CURLOPT_POSTFIELDS,$data);     $s=curl_exec($c);     curl_close($c);     return $s;   } 
};
