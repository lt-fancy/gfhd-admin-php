<?php
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>菜单列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 菜单管理 <span class="c-gray en">&gt;</span> 菜单列表 <a id="refresh" class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
                    <th width="50" hidden='hidden'>id</th>
                    <th width="50" hidden="hidden">is_parent</th>
                    <th width="50" hidden='hidden'>is_have_children</th>
					<th width="120">菜单名称</th>
					<th width="80">是否父级菜单</th>
					<th width="120">父级菜单</th>
					<th width="60">排序</th>
					<th width="80">更新时间</th>
					<th width="60">上线状态</th>
					<th width="60">操作</th>
				</tr>
			</thead>
			<tbody>
            <?php
                require_once 'mysql.php';
                $sql = $mysqli->query("select * from menu_info order by is_deleted asc");
                $datarow = mysqli_num_rows($sql); //长度
                //循环遍历出数据表中的数据
                for($i=0;$i<$datarow;$i++){
                    $sql_arr = mysqli_fetch_assoc($sql);
                    $ename = $sql_arr['menu_ename'];
                    $cname = $sql_arr['menu_cname'];
                    $is_parent = $sql_arr['is_parent'];
                    $isparent=$is_parent==0?'是':'否';
                    $parentName = $sql_arr['parent_menu_cname']==null?'-':$sql_arr['parent_menu_cname'];
                    $time = $sql_arr['gmt_modified'];
                    $isOn = $sql_arr['is_deleted'];
                    $order = $sql_arr['order_index'];
                    $id = $sql_arr['id'];
                    $sql1 = $mysqli->query("select count(*) as total from menu_info where parent_id=$id and is_deleted=0");
                    $number = mysqli_fetch_assoc($sql1)['total'];
                    $online='';
                    $operate='';
                    if($isOn==0){
                        $online = "<td class='td-status'><span class='label label-success radius'>已上线</span></td>";
                        $operate="<td class='f-14 td-manage'><a style='text-decoration:none' onClick='online(this.parentNode,1)' href='javascript:;' title='下线'><i class='Hui-iconfont' style='font-size: large'>&#xe6de;</i></a></td>";
                    }else{
                        $online = "<td class='td-status'><span class='label label-danger radius'>已下线</span></td>";
                        $operate="<td class='f-14 td-manage'><a style='text-decoration:none' onClick='online(this.parentNode,0)' href='javascript:;' title='上线'><i class='Hui-iconfont' style='font-size: large'>&#xe6dc;</i></a></td>";
                    }
                    echo "<tr class='text-c'>
                        <td class='menu_id' hidden='hidden'>$id</td>
                        <td class='is_parent' hidden='hidden'>$is_parent</td>
                        <td class='is_have_children' hidden='hidden'>$number</td>
                        <td class='editable-cname'>$cname</td>
                        <td>$isparent</td>
                        <td>$parentName</td>
                        <td>$order</td>
                        <td>$time</td>",$online,$operate,"</tr>";
                }
            ?>
			</tbody>
		</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="lib/datatables/jquery.jeditable.js"></script>
<script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    var oTable = $('.table-sort').dataTable({
    });
    $('.editable-cname', oTable.fnGetNodes()).editable('base/editMenuName.php', {
        "callback": function (sValue, y) {
            var aPos = oTable.fnGetPosition( this );
            oTable.fnUpdate( sValue, aPos[0], aPos[1]);
        },
        "submitdata": function (value, settings) {
            var name = $(this).val();
            var id = $(this).siblings('.menu_id').html();
            return {
                "name":name,
                "id": id
            };//这里你编辑的内容默认以“value”发送到后台
        },
        "height": "20px",
        "width": "120px"
    });
    function online(ele,type) {
        var id = $(ele).siblings('.menu_id').html();
        var is_parent = $(ele).siblings('.is_parent').html();
        var menu_name = $(ele).siblings('.editable-cname').html();
        var menuChildren = $(ele).siblings('.is_have_children').html();
        var msg = '';
        var isParentMsg = '';
        if(menuChildren>0){
            isParentMsg = "该菜单属于父级菜单，操作会影响其下属"+menuChildren+"个子级菜单，";
        }
        if(0==type){
            //上线
            msg = isParentMsg+"确认要将菜单【"+menu_name+"】上线吗？";
        } else {
            msg = isParentMsg+"确认要将菜单【"+menu_name+"】下线吗？";
        }
        layer.confirm(msg,function(index) {
            $.ajax({
                type: "POST",
                url: "base/menuOnline.php",
                dataType: "json",
                data: {"id": id, "type": type,"isParent":is_parent},
                success: function (json) {
                    if (json.success == 1) {
                        layer.msg(json.msg, {
                            icon: 1,
                            time: 1500
                        },function () {
                            window.location.href = $("#refresh").attr('href');
                        });
                    } else {
                        layer.msg(json.msg, {
                            icon: 2,
                            time: 1500
                        },function () {
                            window.location.href = $("#refresh").attr('href');
                        });
                    }
                }
            });
        });
    }
/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
		$(obj).remove();
		layer.msg('已下架!',{icon: 5,time:1000});
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布!',{icon: 6,time:1000});
	});
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

</script> 
</body>
</html>