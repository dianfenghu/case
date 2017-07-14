<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends AllowController {
    //Admin列表
    public function index(){
        $mod=M('Admin');
        // $AdminCount=M('Admin')->count();
        // $this->assign('AdminCount',$AdminCount);
        // $Admin=$mod->order('Aid desc')->select();
        // $this->assign("Admin",$Admin);
        // dump(session('admin.Level'));
        $this->display("Admin/AdminList");
    }

    // 管理员列表
    public function AdminList(){
        $mod=M('admin');
        $count = $mod->count();
        $Page = new \Think\Page($count,10);
        $show = $Page->show();
        $list = $mod->order('level desc')->limit($Page->firstRow.','.$Page->listRows)->select();$this->assign('list',$list);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display('Admin/Admin_List');
    }
    //添加管理员
    public function addAdmin(){
        $this->display('addAdmin');
    }

    //添加Admin
    public function insertAdmin(){
        $mod=M('Admin');
        $rules = array( 
            array('UserName','require','请填写用户名！'), 
            array('Password','require','请填写密码！'), 
            array('UserName','','该用户已经存在！',0,'unique',1),  
            array('RePassword','Password','两次密码不一样',0,'confirm'),  
        ); 
        
        if(!$mod->validate($rules)->create()){
            $this->error($mod->getError());
        }else{
            $mod->Password=md5(I('Password'));
            $mod->AddTime=time();
            $mod->Status=1;
            if($mod->add()){
                $this->success('添加成功',U('Admin/AdminList'),2);
            }else{
                $this->error('添加失败');
            }
        }
       
    }

    //Admin修改
    public function updataAdmin(){
        $Aid=$_POST['Aid'];
        $mod=M('Admin');
        $row=$mod->where("Aid=$Aid")->save();
        if($row){
             $this->success('修改成功！');
        }else{
            $this->error("修改失败！");
        }
        
    }

    //修改Admin状态
    public function setAdminStatus(){
        $Aid=$_POST['Aid'];
        $status=M('Admin')->where("Aid=$Aid")->getField('Status');
        if($status){
            $row=M('Admin')->where("Aid=$Aid")->setField('Status',0);
        }else{
            $row=M('Admin')->where("Aid=$Aid")->setField('Status',1);
        }

        if($row){
            echo 1;
        }else{
            echo 0;
        }
    }

    //删除Admin
    public function delAdmin(){
        $Aid=$_POST['Aid'];
        $mod=M('Admin');
        $row=$mod->where("Aid=$Aid")->delete();
        if($row){
         
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }

    //修改密码
    public function updatePassword(){
        $UserName=$_SESSION['admin'][0]['UserName'];
        $Password=md5($_POST['Password']);
        if($_POST['Password'] =='' or $_POST['newPassword']=='' or $_POST['newPassword2']==''){
            $this->error("请输入密码项！");
        }else if(md5($_POST['newPassword'])!=md5($_POST['newPassword2'])){
            $this->error('对不起两次密码输入不相同！',U('Root/index'));
        }else{
            $mod=M('admin');
            $Passwords=$mod->where("UserName='{$UserName}' and Password='{$Password}'")->select();
            if($Passwords){
                $data['Password']=md5($_POST['newPassword']);
                $row=$mod->where("UserName='{$UserName}'")->data($data)->save();
                if($row){
                    $this->success("修改成功！");
                }else{
                    $this->error("修改失败！");
                }
            }else{

                $this->error("旧密码输入错误!");
            }
        }
    }

    //修改
    public function editAdmin(){
            $list=M('admin')->find($_GET['Aid']);
            $this->assign('list',$list);
            $this->display('editAdmin');
    }

    //执行修改
    public function UpdateAdmin(){
         $mod=M('admin');
         $rules = array( 
            array('UserName','require','请填写用户名！'), 
            array('UserName','','该用户已经存在！',0,'unique',1),  
            array('RePassword','Password','两次密码不一样',0,'confirm'),  
        ); 
        if(!$mod->validate($rules)->create()){
            $this->error($mod->getError());
        }else{
            $mod->Password=md5(I('post.Password'));
            if($mod->where("Aid={$_POST['Aid']}")->save($data)){
                $this->success('修改成功',U("Admin/AdminList"),2);
            }else{
                $this->error('修改失败');
            }
        }
    }

    //更新排序
    public function Sequence(){
        $array=$_POST;
        dump($array);
    }
}