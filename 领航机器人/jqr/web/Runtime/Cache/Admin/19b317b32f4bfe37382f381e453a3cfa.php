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
	<span class="c-gray en">&gt;</span> 资讯管理
	<span class="c-gray en">&gt;</span> 资讯列表 
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<form action="/Admin/News/index" method="post">
		<div class="text-c"> 
			<input type="text" name="Title" id="Title" placeholder="资讯标题" style="width:250px" class="input-text">
			<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资讯</button>
		</div>
	</form>
	<form action="" method="post" id="myfomr" class="form">
		
	
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<a href="javascript:void(0);" class="btn btn-danger radius remove" id="button">
				<i class="Hui-iconfont">&#xe6e2;</i> 批量删除
			</a> 
		</span> 
		<span class="r">共有数据：<strong><?php echo ($NewsCount); ?></strong> 条</span> 
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<!-- <th width="80">排序</th> -->
					<th>标题</th>
					<!-- <th width="80">分类</th> -->
					<th width="120">更新时间</th>
					<th width="75">浏览次数</th>
					<th width="60">发布状态</th>
					<th width="200">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($newsList)): $i = 0; $__LIST__ = $newsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$newsList): $mod = ($i % 2 );++$i;?><tr class="text-c">
						<td><input type="checkbox" value="<?php echo ($newsList["Nid"]); ?>" name="Nids[]"></td>
						<td><?php echo ($newsList["Nid"]); ?></td>
						<!-- <td><input style="width:40px;" type="text" name="<?php echo ($newsList["Nid"]); ?>" value="<?php echo ($newsList["Sequence"]); ?>"></td> -->
						<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','/Admin/News/newsEdit/Nid/<?php echo ($newsList["Nid"]); ?>')" title="查看"><?php echo ($newsList["Title"]); ?></u></td>
						<!-- <td><?php echo ($newsList["ClassName"]); ?></td> -->
						<td><?php echo (date('Y-m-d H:i:s',$newsList["AddTime"])); ?></td>
						<td><?php echo ($newsList["BrowseAmount"]); ?></td>
						<td class="td-status">
							<?php if($newsList["Status"] == 1): ?><span class="label label-success radius">页面显示</span>
							<?php else: ?>
								<span class="label label-defaunt radius">取消页面显示</span><?php endif; ?>
						</td>
						<td class="f-14 td-manage">
							<?php if($newsList["Status"] == 1): ?><a style="text-decoration:none" onClick="article_stop(this,<?php echo ($newsList["Nid"]); ?>)" href="javascript:void(0);" title="取消显示"><i class="Hui-iconfont">&#xe6de;取消显示</i></a> 
							<?php else: ?>
								<a style="text-decoration:none" onClick="article_start(this,<?php echo ($newsList["Nid"]); ?>)" href="javascript:void(0);" title="页面显示"><i class="Hui-iconfont">&#xe603;页面显示</i></a><?php endif; ?>
							<a style="text-decoration:none" data-title="<?php echo ($newsList["Title"]); ?>" onclick="Hui_admin_tab(this)"  class="ml-5" _href="/Admin/News/newsEdit/Nid/<?php echo ($newsList["Nid"]); ?>" href="javascript:void(0);" title="编辑"><i class="Hui-iconfont">&#xe6df;编辑</i></a> 

							<a style="text-decoration:none" class="ml-5" onClick="article_del(this,<?php echo ($newsList["Nid"]); ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;删除</i></a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
	</form>
	<input type="submit" class="sequence" style="margin:10px 0px 0px 10px" form="myfomr" value="排序">
</div>
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
$(".sequence").click(function(){
	$(".form").attr('action','/Admin/News/NewsSequence');
})

$(".remove").click(function(){
	$(".form").attr('action','/Admin/News/batchDeleteNews');
})

$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  // {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
	]
});
$("#button").click(function() {
		if(!$("input[type='checkbox']").is(':checked')){
			alert('请先选中您要删除的新闻');
			return false;
		}else{
			$("#myfomr").submit();
		}
		
	});
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确定要删除此条新闻吗？',function(index){
		$.ajax({
			url: "/Admin/News/delNews",
			type: 'post',
			dataType: 'json',
			data: {Nid:id},
			success:function(){

				$(obj).parents("tr").remove();
				layer.msg('新闻已删除!',{icon: 5,time:1000});

			}
		})
		
	});
}
/*资讯-不显示*/
function article_stop(obj,id){
	layer.confirm('确认要取消页面显示吗？',function(index){
		$.ajax({
			url: "/Admin/News/setNewsStatus",
			type: 'post',
			dataType: 'json',
			data: {Nid:id},
			success:function(){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" name="<?php echo ($newsList["Nid"]); ?>" onClick="article_start(this,'+id+')" href="javascript:;" title="页面显示"><i class="Hui-iconfont">&#xe603;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">取消页面显示</span>');
				$(obj).remove();
				layer.msg('已取消页面显示!',{icon: 5,time:1000});
			}
		})
		
	});
}

/*资讯-显示*/
function article_start(obj,id){
	layer.confirm('确认要页面显示吗？',function(index){
		$.ajax({
			url: "/Admin/News/setNewsStatus",
			type: 'post',
			dataType: 'json',
			data: {Nid:id},
			success:function(){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,'+id+')" href="javascript:;" title="取消页面显示"><i class="Hui-iconfont">&#xe6de;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">页面显示</span>');
				$(obj).remove();
				layer.msg('页面显示!',{icon: 5,time:1000});
			}
		})
		
	});
}

</script> 
</body>
</html>