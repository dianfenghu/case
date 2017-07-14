<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
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
<title>网站后台管理系统</title>
<meta name="keywords" content="网站后台管理系统">
<meta name="description" content="网站后台管理系统">
</head>
<body>
<div class="page-container">
    <dl class="box_one">
        <dt>系统信息</dt>
        <dd class="f-16 tcolor">欢迎使用网站管理系统，您的网站已经通过授权！</dd>
    </dl>
    <dl class="box_two">
        <dt>企业信息</dt>
        <dd>
            <table width="100%" border="0" bordercolor="#BAD6EB" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td width="80" class="c1">企业名称:</td>
                        <td class="c2"><span id="lblCompanyName"><?php echo ($setting[0]['WebName']); ?></span></td>
                    </tr>
                    <tr>
                        <td class="c1">网站域名:</td>
                        <td class="c2"><span id="lblUrl"><?php echo ($setting[0]['Url']); ?></span></td>
                    </tr>
                    <tr>
                        <td class="c1">关 键 字:</td>
                        <td class="c2"><span id="lblKeys"><?php echo ($setting[0]['Keyword']); ?></span></td>
                    </tr>
                    <tr>
                        <td valign="top" class="c1">网站描述:</td>
                        <td class="c2"><span id="lblInfo"><?php echo ($setting[0]['Description']); ?></span></td>
                    </tr>
                    <tr>
                        <td valign="top" class="c1">地区分站:</td>
                        <td class="c2"><span id="lblAreas">
                            <?php if(is_array($areaWeb)): $i = 0; $__LIST__ = $areaWeb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$areaWeb): $mod = ($i % 2 );++$i;?><a"><?php echo ($areaWeb['AreaName']); ?></a>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                        </span></td>
                    </tr>
                    <!-- <tr style="display:none">
                        <td class="c1">网站行业:</td>
                        <td class="c2"><span id="lblHY"></span></td>
                    </tr> -->
                    <tr>
                        <td class="c1">手机号码:</td>
                        <td class="c2"><span id="lblMobile"><?php echo ($setting[0]['Tel']); ?></span></td>
                    </tr>
                    <tr style="display:none">
                        <td class="c1">模 板 号:</td>
                        <td class="c2"><span id="lblTempH">ys</span></td>
                    </tr>
                </tbody>
            </table>
        </dd>
    </dl>
</div>
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.js"></script> 
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>