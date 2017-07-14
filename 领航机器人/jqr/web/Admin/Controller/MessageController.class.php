<?php
namespace Admin\Controller;
use Think\Controller;
class MessageController extends AllowController {
   public function index(){
   		$title=isset($_POST['Title'])?$_POST['Title']:'';
   		// dump($title);
   		if($title){
   			$where="Title like '%$title%'";
   		}else{
   			$where="";
   		}
   		// dump($where);

        $msgList=M('message')->where($where)->select();
        //统计条数
        $messageCount=M('message')->count();
    	$this->assign('messageCount',$messageCount);
        // var_dump($msgList);die();
        $this->assign('messageList',$msgList);
        $this->display('Message/MessageList');
   }
  	//加载添加页面
  	public function addMessage(){
  		$this->display('Message/AddMessage');
  	}
   	public function insertMessage(){
   		//获取表单数据
   		$mod=M('message');
   		$mod->create();
   		// dump($mod);
   		$mod->AddTime=time();
   		// dump($mod);die();
	   	$row=$mod->add();
   		if($row){
            $this->success('留言添加成功！',U('message/index'));
        }else{
            $this->error('添加留言失败！');
        } 
   }

   //删除
   public function delmessage(){
   		$Mid=$_POST['Mid'];
   		$mod=M('message');
   		$row=$mod->where("Mid=$Mid")->delete();
        if($row){
        	
            echo 1;
        }else{
            echo 0;
        }
   }

   //加载编辑页面
   public function messageEdit(){
   		$Mid=$_GET['Mid'];
   		$message=M('message')->where("Mid=$Mid")->select();
   		// dump($message);die();
    	$this->assign("message",$message);

    	
    	$this->display('Message/MessageEdit');
   }

   //修改
   public function updateMessage(){
   		$Mid=$_POST['Mid'];
   		$mod=M('message');
   		$mod->create();
   		//改时间
   		$mod->AddTime=date('Y-m-d H:i:s',time());
   		// dump($mod);die();

   		$row=$mod->where("Mid=$Mid")->save();
        if($row){
            $this->success('留言修改成功！',U('message/index'));
        }else{
            $this->error("留言修改失败！");
        }

   }
   //批量删除
   public function batchDeletemessage(){
   		$Mids=$_POST['Mids'];
   		// dump($Mids);die();
        $mod=M('message');
        foreach ($Mids as $key => $value) { 
            $mod->where("Mid=$value")->delete();
         //    if($row){
         //    	$this->success('留言删除成功！');
	        // }else{
	        //     $this->error("留言删除失败！");
	        // } 
        }
        $this->success('留言删除成功！');
   }
   //加载回复模板
   public function ReplyMessage(){
   		// $mod=M('message');
   		$this->assign('Mid',$_GET['Mid']);
   		$this->display('Message/ReplyMessage');
   }
   //处理回复
   public function doReply(){
   		// dump($_POST);die();
   		$Mid=$_POST['Mid'];
   		$mod=M('message');
   		$mod->create();//封装
   		$row=$mod->where("Mid=$Mid")->save();
        if($row){
             $this->success('回复成功!',U('message/index'));
        }else{
            $this->error("回复失败！");
        }

   }
}