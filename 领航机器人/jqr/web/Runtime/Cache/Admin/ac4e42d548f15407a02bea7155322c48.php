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
		<span class="c-gray en">&gt;</span> 友情链接管理 
		<span class="c-gray en">&gt;</span> 友情链接
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</nav>
	<div class="page-container">
		<div class="text-c">
			<form class="Huiform" method="post" action="/Admin/Links/insertLinks" target="_self" enctype="multipart/form-data" id="myform">
				<input type="text" placeholder="友情链接名称" value="" class="input-text" style="width:120px" name="Name" id="Name">
				<input type="text" placeholder="链接" value="" class="input-text" style="width:300px" name="Link" id="Link">
				<span class="btn-upload form-group">
					<input class="input-text upload-url" type="text" name="uploadfile-2" id="uploadfile-2" readonly  datatype="*" nullmsg="请添加附件！" style="width:200px">
					<a href="javascript:void();" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
					<input type="file" multiple name="Photo" class="input-file">
				</span>
				<button type="submit" class="btn btn-success" id="button" name="" onClick="picture_colume_add(this);"><i class="Hui-iconfont">&#xe600;</i> 添加</button>
			</form>
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20"> 
			<!-- <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span>  -->
			<span class="r">共有数据：<strong><?php echo ($LinksCount); ?></strong> 条</span> 
		</div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-sort">
				<thead>
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="" value=""></th>
						<th width="70">ID</th>
						<th width="80">排序</th>
						<th width="200">图片</th>
						<th width="120">Links名称</th>
						<th>链接</th>
						<th width="200">添加时间</th>
						<th width="120">状态</th>
						<th width="150">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($Links)): $i = 0; $__LIST__ = $Links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Links): $mod = ($i % 2 );++$i;?><tr class="text-c">
							<td><input name="" type="checkbox" value=""></td>
							<td><?php echo ($Links["Lid"]); ?></td>
							<td><?php echo ($Links["Sequence"]); ?></td>
							<td > 
								<?php if($Links["Photo"] != ''): ?><img src="/Public/Uploads/Links/thumb_<?php echo ($Links["Photo"]); ?>" width="80">
								<?php else: ?>
									暂时没有图片<?php endif; ?>
							</td>
							<td class="text-l"><?php echo ($Links["Name"]); ?></td>
							<td class="text-l"><?php echo ($Links["Link"]); ?></td>
							<td class="td-status"><span class="label label-success radius"><?php echo (date('Y-m-d H:i:s',$Links["AddTime"])); ?></span></td>
							<td class="td-status">
								<?php if($Links["Status"] == 1): ?><span class="label label-success radius">已显示</span>
								<?php else: ?>
									<span class="label label-defaunt radius">不显示</span><?php endif; ?>
							</td>
							<td class="f-14 product-brand-manage">
								<a style="text-decoration:none" href="/Admin/Links/editLinks/Lid/<?php echo ($Links["Lid"]); ?>" title="编辑"><i class="Hui-iconfont">&#xe6df; 编辑</i></a> 
								<a style="text-decoration:none" class="ml-5" href="/Admin/Links/delLinks/Lid/<?php echo ($Links["Lid"]); ?>" title="删除"><i class="Hui-iconfont">&#xe6e2; 删除</i></a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</div>
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Public/admin/lib/laypage/1.2/laypage.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script>  
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,6]}// 制定列不参与排序
	]
});
$("#button").click(function() {
	if(!$("#Name").val()){
		alert('请输入友情链接名称');
		$("#Name").select();
		$("#Name").focus();
		return false;
	}if(!$("#Link").val()){
		alert('请输入链接');
		$("#Link").select();
		$("#Link").focus();
		return false;
	}else{
		$("#myform").submit();
	}		
});

</script>
</body>
</html>