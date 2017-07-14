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
<title>腾云CMS整站优化系统-后台数据管理</title>
</head>
<body>
	<nav class="breadcrumb">
		<i class="Hui-iconfont">&#xe67f;</i> 首页 
		<span class="c-gray en">&gt;</span> 广告管理 
		<span class="c-gray en">&gt;</span> Banner管理 
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</nav>
	<div class="page-container">
		<div class="text-c">
			<form class="Huiform" id="myform" method="post" action="/Admin/Banner/insertBanner" target="_self" enctype="multipart/form-data">
				<span class="c-red">*</span><input type="text" placeholder="Banner名称" value="" class="input-text" style="width:120px" name="Name" id="Name">
				<input type="text" placeholder="Banner链接" value="" class="input-text" style="width:300px" name="Url" id="Url">
				<span class="c-red">*</span>
				<select name="type" id="" class="input-text" style="width:150px">
					<option value="0">请选择类型</option>
					<option value="1">手机</option>
					<option value="2">PC</option>
				</select>
				<span class="btn-upload form-group">
					<input class="input-text upload-url" type="text" name="uploadfile-2" id="uploadfile-2" readonly  datatype="*" nullmsg="请添加附件！" style="width:200px">
					<a href="javascript:void();" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
					<input type="file" multiple name="Photo" class="input-file" id="Photo">
				</span>
				<button type="submit" class="btn btn-success"  id="button" name="" onClick="picture_colume_add(this);"><i class="Hui-iconfont">&#xe600;</i> 添加</button>
			</form>
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20"> 
			<!-- <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span>  -->
			<span class="r">共有数据：<strong><?php echo ($BannerCount); ?></strong> 条</span> 
		</div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-sort">
				<thead>
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="" value=""></th>
						<th width="50">ID</th>
						<th width="50">排序</th>
						<th width="100">图片</th>
						<th width="300">Banner名称</th>
						<th width="300">链接</th>
						<th width="120">类型</th>
						<th width="120">状态</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($Banner)): $i = 0; $__LIST__ = $Banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Banner): $mod = ($i % 2 );++$i;?><tr class="text-c">
							<td><input name="" type="checkbox" value=""></td>
							<td class="nid"><?php echo ($Banner["Bid"]); ?></td>
							<td><?php echo ($Banner["Sequence"]); ?></td>
							<td > <img src="/Public/Uploads/Banner/thumb_<?php echo ($Banner["Photo"]); ?>" width="50"></td>
							<td class="text-l"><?php echo ($Banner["Name"]); ?></td>
							<td class="text-l"><?php echo ($Banner["Url"]); ?></td>
							<!--<td class="td-status"><span class="label label-success radius"><?php echo (date('Y-m-d H:i:s',$Banner["AddTime"])); ?></span></td>-->
							<td class="td-status">
								<?php if($Banner["Status"] == 1): ?><span class="label label-success radius tuijian" style="cursor:pointer;">已显示</span>
								<?php else: ?>
									<span class="label label-defaunt radius tuijian" style="cursor:pointer;">不显示</span><?php endif; ?>
							</td>
							<td class="td-type">
								<?php if($Banner["type"] == 1): ?><span class="label label-success radius" style="background:orange">mobile</span>
								<?php elseif($Banner["type"] == 2): ?>
									<span class="label label-defaunt radius" style="background:red">PC</span><?php endif; ?>
							</td>
							<td class="f-14 product-brand-manage">
								<a style="text-decoration:none" href="/Admin/Banner/editBanner/Bid/<?php echo ($Banner["Bid"]); ?>" title="编辑"><i class="Hui-iconfont">修改</i></a> 
								<a style="text-decoration:none" class="ml-5" href="/Admin/Banner/delBanner/Bid/<?php echo ($Banner["Bid"]); ?>" title="删除"><i class="Hui-iconfont">删除</i></a>
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
			alert('请输入Banner名称');
			$("#DataName").select();
			$("#DataName").focus();
			return false;
		}if(!$("#Photo").val()){
			alert('请添加Banner图片');
			$("#Photo").select();
			$("#Photo").focus();
			return false;
		}else{
			$("#myform").submit();
		}
		
	});
$(".tuijian").bind('click',function(){
	tj=$(this).parents('.td-status');
	id=$(this).parents('.text-c').find('.nid').html();
	$.post("/Admin/Banner/setBannerStatus",{Bid:id},function(data){
		if(data==1){
			tj.html('<span class="label label-defaunt radius tuijian" style="cursor:pointer;">不显示</span>');
		}else if(data==2){
			tj.html('<span class="label label-success radius tuijian" style="cursor:pointer;">显示</span>');
		}
	})
})
</script>
</body>
</html>