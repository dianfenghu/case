<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
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
<link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/skin/green/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台数据管理</title>
</head>
<body>
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="tylogo fl">
            <a href="/Admin/Index/index">
                <!-- <img src="/Public/admin/static/h-ui/images/steps/logo.png" alt="" /> -->
                <!-- <img src="/Public/admin/static/h-ui/images/steps/logo2.png" alt="" /> -->
            </a> 
        </div>
        <div class="navbar fr">
            <ul>
                <li>
                    <a onclick="creatIframe('/Admin/Setting/index','网站设置')" href="javascript:void(0)" >
                        <span><img src="/Public/admin/static/h-ui/images/i1.png" alt="网站设置" /></span>网站设置
                    </a>
                </li>
               <!--  <li>
                    <a onclick="creatIframe('/Admin/Menu/index','栏目管理')" >
                        <span><img src="/Public/admin/static/h-ui/images/i2.png" alt="栏目管理" /></span>栏目管理
                    </a>
                </li> -->
               <!--  <li>
                    <a onclick="creatIframe('/Admin/Areaweb/index','地区分站')" href="javascript:void(0)">
                        <span><img src="/Public/admin/static/h-ui/images/i3.png" alt="地区分站" /></span>地区分站
                    </a>
                </li> -->

                <li>
                    <a onclick="creatIframe('/Admin/Admin/index','用户管理')" href="javascript:void(0)">
                        <span><img src="/Public/admin/static/h-ui/images/i4.png" alt="用户管理" /></span>用户管理
                    </a>
                </li>
                <!-- <li>
                    <a onclick="creatIframe('/Admin/Phone/index','手机站设置')" href="javascript:void(0)">
                        <span><img src="/Public/admin/static/h-ui/images/i5.png" alt="手机站设置" /></span>手机站设置</a>
                    </li>-->
                <li>
                    <a href="<?php echo ($webUrl); ?>" target="_Blank">
                        <span><img src="/Public/admin/static/h-ui/images/i6.png" alt="网站首页" /></span>网站首页
                    </a>
                </li>
                <li>
                    <a href="/Admin/Quit/index">
                        <span><img src="/Public/admin/static/h-ui/images/i7.png" alt="安全退出" /></span>安全退出
                    </a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="container-fluid cl"> 
            <!--<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:void(0)" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:void(0)" onclick="article_add('添加资讯','/Admin/News/addNews')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
							<li><a href="javascript:void(0);" onclick="product_add('添加产品','/Admin/Product/addProduct')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li>超级管理员</li>
					<li class="dropDown dropDown_hover"> <a href="/Public/admin/#" class="dropDown_A">admin <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:void(0)">个人信息</a></li>
							<li><a href="javascript:void(0)">切换账户</a></li>
							<li><a href="javascript:void(0)">退出</a></li>
						</ul>
					</li>
				</ul>
			</nav>--> 
        </div>
    </div>
</header>
<aside class="Hui-aside">
    <input runat="server" id="divScrollValue" type="hidden" value="" />
    <div class="menu_dropdown bk_2">
        <dl id="menu-system">
            <dt><i class="Hui-iconfont">&#xe62e;</i>网站设置<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/Setting/index" data-title="系统设置" href="javascript:void(0)" >系统设置</a></li>
                    <!-- <li><a _href="/Admin/Setting/introduction" data-title="公司简介" href="javascript:void(0)">公司简介</a></li> -->
                    <li><a _href="/Admin/Setting/Contact" data-title="联系方式" href="javascript:void(0)">联系方式</a></li>
                    <li><a _href="/Admin/Setting/QRcode" data-title="二维码" href="javascript:void(0)">二维码</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-picture">
            <dt><i class="Hui-iconfont">&#xe613;</i> BANNER图添加<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/Banner/index" data-title="Banner管理" href="javascript:void(0)">Banner管理</a></li>
                </ul>
            </dd>
        </dl>
         <dl id="menu-picture">
            <dt><i class="Hui-iconfont">&#xe613;</i> 文件管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/File/index" data-title="文件管理" href="javascript:void(0)">文件管理</a></li>
                </ul>
            </dd>
        </dl>
       <!--  <dl id="menu-tongji">
            <dt><i class="Hui-iconfont">&#xe61a;</i> 栏目管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/Menu/index" data-title="栏目列表" href="javascript:void(0)">栏目列表</a></li>
                </ul>
            </dd>
        </dl> -->
        <dl id="menu-article">
            <dt><i class="Hui-iconfont">&#xe616;</i> 新闻资讯<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/News/index" href="javascript:void(0)" data-title="新闻管理">新闻管理</a></li>
                    <li><a _href="/Admin/News/addNews" href="javascript:void(0)" data-title="添加新闻">添加新闻</a></li>
                    <!-- <li><a _href="/Admin/News/newsClass" href="javascript:void(0)" data-title="新闻类别管理">新闻类别管理</a></li> -->
                </ul>
            </dd>
        </dl>
       <!--  <dl id="menu-product">
            <dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/Product/index" data-title="产品管理" href="javascript:void(0)">产品管理</a></li>
                    <li><a _href="/Admin/Product/addProduct" data-title="添加产品" href="javascript:void(0)">添加产品</a></li>
                    <li><a _href="/Admin/Product/ProductClass" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
                </ul>
            </dd>
        </dl> -->
       <!--  <dl id="menu-product">
            <dt><i class="Hui-iconfont">&#xe620;</i> 视频管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/Vedio/index" data-title="视频管理" href="javascript:void(0)">视频管理</a></li>
                    <li><a _href="/Admin/Vedio/addvedio" data-title="添加视频" href="javascript:void(0)">添加视频</a></li>
                    <li><a _href="/Admin/Vedio/vedioClass" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
                </ul>
            </dd>
        </dl> -->
        <dl id="menu-comments">
            <dt><i class="Hui-iconfont">&#xe622;</i> 友情链接管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/Links/index" data-title="友情链接" href="javascript:void(0)">友情链接</a></li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-comments">
            <dt><i class="Hui-iconfont">&#xe622;</i> 留言板管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/Message/addMessage" data-title="添加留言" href="javascript:void(0)">添加留言</a></li>
                    <li><a _href="/Admin/Message/index" data-title="查看留言" href="javascript:void(0)">查看留言</a></li>
                </ul>
            </dd>
        </dl>
        <!-- <dl id="menu-member">
            <dt><i class="Hui-iconfont">&#xe60d;</i> 地区分站<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/Areaweb/index" data-title="地区分站" href="javascript:void(0)">地区分站</a></li>
                </ul>
            </dd>
        </dl> -->
       <!--  <dl id="menu-member">
            <dt><i class="Hui-iconfont">&#xe60d;</i> 品牌管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/BrandPromotionb/index" data-title="品牌管理" href="javascript:void(0)">品牌管理</a></li>
                </ul>
            </dd>
        </dl> -->
        <dl id="menu-admin">
            <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a _href="/Admin/Admin/index" data-title="管理员列表" href="javascript:void(0)">修改密码</a></li>
                    
                    <!-- <li><a _href="/Admin/Admin/AdminList" data-title="管理员列表" href="javascript:void(0)">用户管理</a></li> -->
                    <li><a _href="/Admin/Admin/addAdmin" data-title="添加管理员" href="javascript:void(0)">添加管理员</a></li>
                    
                </ul>
            </dd>
        </dl>
<!--         <?php if($_SESSION['admin'][0]['Level'] == 2): ?><dl id="menu-system">
                <dt><i class="Hui-iconfont">&#xe62e;</i>高级设置<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
                <dd>
                    <ul>
                        <li><a _href="/Admin/DataManagement/index" data-title="系统设置" href="javascript:void(0)" >数据列表</a></li>
                        <li><a _href="/Admin/DataManagement/addDataManagement" data-title="添加数据显示" href="javascript:void(0)" >添加数据显示</a></li>
                    </ul>
                </dd>
            </dl><?php endif; ?> -->
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="/Public/admin/javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
    <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
        <div class="Hui-tabNav-wp">
            <ul id="min_title_list" class="acrossTab cl">
                <li class="active"><span title="后台首页" data-href="/Admin/Index/welcom">后台首页</span><em></em></li>
            </ul>
        </div>
        <div class="Hui-tabNav-more btn-group">
            <a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:void(0);">
                <i class="Hui-iconfont">&#xe6d4;</i>
            </a>
            <a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:void(0);">
                <i class="Hui-iconfont">&#xe6d7;</i>
            </a>
        </div>
    </div>
    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <div style="display:none" class="loading"></div>
            <iframe scrolling="yes" frameborder="0" src="/Admin/Index/welcome"></iframe>
        </div>
    </div>
</section>
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
</script> 
<script type="text/javascript">
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s)})();
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>