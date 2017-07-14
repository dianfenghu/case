<?php if (!defined('THINK_PATH')) exit();?>﻿<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/admin/lib/html5.js"></script>
<script type="text/javascript" src="/Public/admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/Public/admin/lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/admin/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/admin/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台数据管理</title>
</head>
<body>
<nav class="breadcrumb"> 
    <i class="Hui-iconfont">&#xe67f;</i> 首页 
    <span class="c-gray en">&gt;</span> 系统管理 
    <span class="c-gray en">&gt;</span> 基本设置 
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> 
</nav>
<div class="page-container">
    <div id="tab-system" class="HuiTab">
        <div class="tabBar cl"><span>基本设置</span><span>网站LOGO</span><span>添加代码</span></div>
        <!--基本设置-->
        <div class="tabCon">
            <form class="form form-horizontal" id="form-article-add" action="/Admin/Setting/updateWebSetting" method="post">
                <input type="hidden" name="Sid" value="<?php echo ($Setting[0]['Sid']); ?>">
                <div class="row cl">
                    <label class="form-label rleft"><span class="c-red">*</span>企业名称：</label>
                    <div class="formControls rright">
                        <input <?php echo (session('disabled')); ?> type="text" id="website-title" placeholder="控制在25个字、50个字节以内" name="WebName" value="<?php echo ($Setting[0]['WebName']); ?>" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label rleft"><span class="c-red">*</span>网站标题：</label>
                    <div class="formControls rright">
                        <input <?php echo (session('disabled')); ?> type="text" id="website-title" placeholder="控制在25个字、50个字节以内" name="WebTitle" value="<?php echo ($Setting[0]['WebTitle']); ?>" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label rleft"><span class="c-red">*</span>关键词：</label>
                    <div class="formControls rright">
                        <input type="text" <?php echo (session('disabled')); ?> id="website-Keywords" placeholder="5个左右,8汉字以内,用英文,隔开" name="Keyword" value="<?php echo ($Setting[0]['Keyword']); ?>" class="input-text">
                    </div>
                </div>
  
                <div class="row cl">
                    <label class="form-label rleft"><span class="c-red">*</span>描述：</label>
                    <div class="formControls rright">
                        <input <?php echo (session('disabled')); ?> type="text" id="website-description" placeholder="空制在80个汉字，160个字符以内" name="Description" value="<?php echo ($Setting[0]['Description']); ?>" class="input-text">
                    </div>
                </div>
                <!-- <div class="row cl"> -->
                    <!-- <label class="form-label rleft"><span class="c-red">*</span>Q Q 号码：</label> -->
                    <!-- <div class="formControls rright"> -->
                        <!-- <input type="text" id="website-static" placeholder="客服QQ" value="<?php echo ($Setting[0]['QQ']); ?>" name="QQ" class="input-text"> -->
                    <!-- </div> -->
                <!-- </div> -->
                    <div class="row cl">
                    <label class="form-label rleft"><span class="c-red">*</span>邮箱：</label>
                    <div class="formControls rright">
                        <input type="text" id="website-static" placeholder="邮箱" value="<?php echo ($Setting[0]['Email']); ?>" name="Email" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label rleft"><span class="c-red">*</span>电话号码：</label>
                    <div class="formControls rright">
                        <input type="text" id="website-static" placeholder="电话" value="<?php echo ($Setting[0]['Tel']); ?>" name="Tel" class="input-text">
                    </div>
                </div>
                <!-- <div class="row cl"> -->
                    <!-- <label class="form-label rleft"><span class="c-red">*</span>联系人：</label> -->
                    <!-- <div class="formControls rright"> -->
                        <!-- <input type="text" id="website-Keywords" placeholder="5个左右,8汉字以内,用英文,隔开" name="contacts" value="<?php echo ($Setting[0]['contacts']); ?>" class="input-text"> -->
                    <!-- </div> -->
                <!-- </div> -->
                <div class="row cl">
                    <label class="form-label rleft"><span class="c-red">*</span>公司地址：</label>
                    <div class="formControls rright">
                        <input type="text" id="website-static" placeholder="电话" value="<?php echo ($Setting[0]['Address']); ?>" name="Address" class="input-text">
                    </div>
                </div>
<!--                 <div class="row cl">
                    <label class="form-label rleft">手机号码：</label>
                    <div class="formControls rright">
                        <input type="text" id="website-static" placeholder="手机号" value="<?php echo ($Setting[0]['Phone']); ?>" name="Phone" class="input-text">
                    </div>
                </div> -->
                <!-- <div class="row cl"> -->
                    <!-- <label class="form-label rleft"><span class="c-red">*</span>网址：</label> -->
                    <!-- <div class="formControls rright"> -->
                        <!-- <input type="text" id="website-static" placeholder="网址" value="<?php echo ($Setting[0]['Url']); ?>" name="Url" class="input-text"> -->
                    <!-- </div> -->
                <!-- </div> -->
                <div class="row cl">
                    <label class="form-label rleft"><span class="c-red"> </span>备案号：</label>
                    <div class="formControls rright">
                        <input type="text" id="website-icp" placeholder="京ICP备00000000号" value="<?php echo ($Setting[0]['CaseNumber']); ?>" name="CaseNumber"  class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label rleft"><span class="c-red">*</span>底部版权信息：</label>
                    <div class="formControls rright">
                        <input type="text" id="website-copyright" placeholder="&copy; 2016 www.zztxkj.com" value="<?php echo ($Setting[0]['Copyright']); ?>" name="Copyright" class="input-text">
                    </div>
                </div>
                <div class="row cl">
                    <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                        <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                        <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                    </div>
                </div>
            </form>
        </div>
        
        <!--网站LOGO-->
<!--网站LOGO-->
        <div class="tabCon">
        <form class="form form-horizontal action" id="form-article-add" action="" method="post" enctype="multipart/form-data">
            <div class="row cl">
                    <label class="form-label rleft"><span class="c-red">*</span>请选择类型：</label>
                    <div class="formControls rright">
                        <select name="type" id="" class="type" style="width:200px;height:30px;">
                            <option value="">请选择</option>
                            <!-- <option value="mobile">手机站</option> -->
                            <option value="pc">电脑站</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" class="h" name="Sid" value="<?php echo ($Setting[0]['Sid']); ?>">
                <div class="row">
                    <div class="leftw fl">
                        <label class="form-label">网站LOGO：</label>
                    </div>
                    <div class="rightcon fl img">
                        
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <div class="leftw fl">
                        <label class="form-label">上传新的Logo：</label>
                    </div>
                    <div class="rightcon fl"> <span class="btn-upload form-group">
                        <input class="input-text upload-url" type="text" name="" id="uploadfile" readonly nullmsg="请添加图片" style="width:200px">
                        <a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 选择图片</a>
                        <input type="file" multiple name="" class="input-file">
                        </span> </div>
                    <div class="clear"></div>
                </div>
                <div class="row">
                    <div class="leftw fl">&nbsp;</div>
                    <div class="rightcon fl">
                        <button onClick="article_save_submit();" class="btn btn-primary radius submit" type="submit" disabled style="color:#666;background:#ccc"><i class="Hui-iconfont">&#xe632;</i>保存</button>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
        </div>
        
        <!--添加代码-->
        <div class="tabCon">
            <form class="form form-horizontal" id="form-article-add" action="/Admin/Setting/addCode" method="post">
                <div class="row cl">
                    <div class="leftw fl">
                        <label class="form-labelcol-sm-3">网站底部代码：</label>
                    </div>
                    <div class="rightcon fl">
                        <textarea name="footer" <?php echo (session('disabled')); ?> cols="" rows="10" class="textarea" style="height:50%; min-width:500px; display:block; width:100%;"><?php echo ($footerCode); ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="leftw fl">&nbsp;</div>
                    <div class="rightcon fl">
                    <?php if($_SESSION['admin'][0]['Level'] == 2): ?><button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button><?php endif; ?>
                    </div>
                   
                    <div class="clear"></div>
                </div>
            </form>
        </div>
        <div class="tabCon">
            <form class="form form-horizontal" id="form-article-add" action="/Admin/Setting/style_update" method="post">
                <div class="row cl">
                    <div class="leftw fl">
                        <label class="form-labelcol-sm-3">手机风格：</label>
                    </div>
                    <div class="rightcon fl">
                        <select name="phone_style" id="" style="width:150px;height:30px;font-size:16px;text-align:center">
                            <option <?php if($Setting[0]['phone_style'] == 0): ?>selected<?php endif; ?> value="0">关闭手机站</option>
                            <option <?php if($Setting[0]['phone_style'] == 1): ?>selected<?php endif; ?> value="1">样式1</option>
                            <option <?php if($Setting[0]['phone_style'] == 2): ?>selected<?php endif; ?> value="2">样式2</option>
                            <option <?php if($Setting[0]['phone_style'] == 3): ?>selected<?php endif; ?> value="3">样式3</option>
                            <option <?php if($Setting[0]['phone_style'] == 4): ?>selected<?php endif; ?> value="4">样式4</option>
                        	<option <?php if($Setting[0]['phone_style'] == 5): ?>selected<?php endif; ?> value="5">样式5</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="leftw fl">&nbsp;</div>
                    <div class="rightcon fl">
                        <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                    </div>
                   
                    <div class="clear"></div>
                </div>
            </form>
        </div>
        <div class="tabCon"> </div>
    </div>
</div>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<!--/_footer /作为公共模版分离出去--> 

<!--请在下方写此页面业务相关的脚本--> 
<script type="text/javascript">
$(".type").change(function(){
    s=$(this).val();
    Sid=$(".h").val();
    // alert(s)
    if(s=='mobile'){
        $(".submit").attr('disabled',false).css({'background':'#00be50','color':'white'});
        $(".img").children('img').remove();
        $(".action").attr('action',"/Admin/Setting/update_mLogo");
        $(".input-file").attr('name','m_logo');
        $(".upload-url").attr('name','m_logo');
        $.post("/Admin/Setting/getimg",{Sid:Sid,type:'mobile'},function(data){
        if(data){
            $(".img").append('<img width="120px" height="60px" src="/Public/Uploads/Logo/'+data+'">');
        }
    })
    }else if(s=='pc'){
        $(".submit").attr('disabled',false).css({'background':'#00be50','color':'white'});
        $(".img").children('img').remove();
        $(".action").attr('action',"/Admin/Setting/updateLogo");
        $(".input-file").attr('name','Logo');
        $(".upload-url").attr('name','Logo');
        $.post("/Admin/Setting/getimg",{Sid:Sid,type:'pc'},function(data){
        if(data){
            $(".img").append('<img width="120px" height="60px" src="/Public/Uploads/Logo/'+data+'">');
        }
    })
    }
})

$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>