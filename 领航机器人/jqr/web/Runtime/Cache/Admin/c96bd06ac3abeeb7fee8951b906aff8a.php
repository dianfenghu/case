<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
	<span class="c-gray en">&gt;</span> 留言板管理
	<span class="c-gray en">&gt;</span> 留言板列表 
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<form action="/Admin/Message/index" method="post">
		<div class="text-c"> 
			<input type="text" name="Title" id="Title" placeholder="留言标题" style="width:250px" class="input-text">
			<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜标题</button>
		</div>
	</form>
	<form action="/Admin/message/batchDeletemessage" method="post" id="myfomr">
		
	
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<a href="javascript:void(0);" class="btn btn-danger radius" id="button">
				<i class="Hui-iconfont">&#xe6e2;</i> 批量删除
			</a> 
		</span> 
		<span class="r">共有数据：<strong><?php echo ($messageCount); ?></strong> 条</span> 
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th width="50">留言人</th>
					<!-- <th width="80">电话</th> -->
					<th width="80">电话</th>
					<th width="120">留言内容</th>
					<th width="80">添加时间</th>

					<!-- <th width="75">邮箱</th>
					<th width="60">地址</th> -->
					<th width="200">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($messageList)): $i = 0; $__LIST__ = $messageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$messageList): $mod = ($i % 2 );++$i;?><tr class="text-c">
						<td><input type="checkbox" value="<?php echo ($messageList["Mid"]); ?>" name="Mids[]"></td>
						<td><?php echo ($messageList["Mid"]); ?></td>
						<td><?php echo ($messageList["Name"]); ?></td>
						<td><?php echo ($messageList["Phone"]); ?></td>
						<td><?php echo (htmlspecialchars_decode($messageList["Content"])); ?></td>
						<td><?php echo (date('Y-m-d H:i:s',$messageList["AddTime"])); ?></td>
						<!-- <td><?php echo ($messageList["Email"]); ?></td>
						<td><?php echo ($messageList["Address"]); ?></td> -->
						
						<td class="f-14 td-manage">
							<?php if($messageList["Reply"] == null): ?><a style="text-decoration:none" data-title="<?php echo ($messageList["Title"]); ?>" onclick="Hui_admin_tab(this)"  class="ml-5" _href="/Admin/message/ReplyMessage/Mid/<?php echo ($messageList["Mid"]); ?>" href="javascript:void(0);" title="回复"><i class="Hui-iconfont">&#xe6df;回复</i></a><?php endif; ?>
							
							<a style="text-decoration:none" data-title="<?php echo ($messageList["Title"]); ?>" onclick="Hui_admin_tab(this)"  class="ml-5" _href="/Admin/message/messageEdit/Mid/<?php echo ($messageList["Mid"]); ?>" href="javascript:void(0);" title="编辑"><i class="Hui-iconfont">&#xe6df;编辑</i></a> 

							<a style="text-decoration:none" class="ml-5" onClick="article_del(this,<?php echo ($messageList["Mid"]); ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;删除</i></a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				
			</tbody>
		</table>
	</div>

	</form>
</div>
<script type="text/javascript" src="/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/admin/lib/layer/2.1/layer.js"></script> 
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
	  // {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
	]
});
//批量删除
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
			url: "/Admin/message/delmessage",
			type: 'post',
			dataType: 'json',
			data: {Mid:id},
			success:function(){
				$(obj).parents("tr").remove();
				layer.msg('新闻已删除!',{icon: 5,time:1000});
			}
		})
		
	});
}



</script> 
</body>
</html>