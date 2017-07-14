<?php
namespace Home\Controller;
use Think\Controller;
class AllowController extends Controller {
    public function _initialize(){
		if(!$_SESSION['UserInfo'] or !$_SESSION['UserInfo'][0]['loginStatus']){
            $this->redirect('Index/index');
		}
    }

}