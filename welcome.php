<?php
/**
 * Created by PhpStorm.
 * User: sawallianc
 * Date: 2017/9/28 0028
 * Time: 12:13
 */
require_once 'mysql.php';
$sql=$mysqli->query("select * from login_info");
$sql_arr = mysqli_fetch_assoc($sql);
$last_login_ip=$sql_arr['last_login_ip'];
$last_login_ip=$last_login_ip==null?'-':$last_login_ip;
$login_count=$sql_arr['login_count'];
$login_count=$login_count==null?0:$login_count;
$last_login_time=$sql_arr['last_login_time'];
$last_login_time=$last_login_time==null?'-':$last_login_time;

//今日起始
$today_begin=date("Y-m-d").' 00:00:00';
//今日结束
$today_end=date("Y-m-d").' 23:59:59';

$thismonth = date('m');
$thisyear = date('Y');

//本月起始
$startMonth = $thisyear . '-' . $thismonth . '-1 00:00:00';
//本月结束
$endMonth = $thisyear . '-' . $thismonth . '-' . date('t', strtotime($startDay)).' 23:59:59';


//菜单
$menu_sql=$mysqli->query("select count(*) as total from menu_info where is_deleted=0");
$menu_data=mysqli_fetch_assoc($menu_sql);
$menu_total=$menu_data['total'];

$menu_today=$mysqli->query("select count(*) as total from menu_info where is_deleted=0 and gmt_created BETWEEN '$today_begin' AND '$today_end'");
$menu_day_data=mysqli_fetch_assoc($menu_today);
$menu_day_total=$menu_day_data['total'];

$menu_month=$mysqli->query("select count(*) as total from menu_info where is_deleted=0 and gmt_created BETWEEN '$startMonth' AND '$endMonth'");
$menu_month_data=mysqli_fetch_assoc($menu_month);
$menu_month_total=$menu_month_data['total'];

//图片
$image=$mysqli->query("select count(*) as total from image_info where is_deleted=0");
$image_date=mysqli_fetch_assoc($image);
$image_total=$image_date['total'];

$image_today=$mysqli->query("select count(*) as total from image_info where is_deleted=0 and gmt_created BETWEEN '$today_begin' AND '$today_end'");
$image_day_data=mysqli_fetch_assoc($image_today);
$image_day_total=$image_day_data['total'];

$image_month=$mysqli->query("select count(*) as total from image_info where is_deleted=0 and gmt_created BETWEEN '$startMonth' AND '$endMonth'");
$image_month_data=mysqli_fetch_assoc($image_month);
$image_month_total=$image_month_data['total'];

//新闻
$list=$mysqli->query("select count(*) as total from list_info where is_deleted=0");
$list_date=mysqli_fetch_assoc($list);
$list_total=$list_date['total'];

$list_today=$mysqli->query("select count(*) as total from list_info where is_deleted=0 and gmt_created BETWEEN '$today_begin' AND '$today_end'");
$list_day_data=mysqli_fetch_assoc($list_today);
$list_day_total=$list_day_data['total'];

$list_month=$mysqli->query("select count(*) as total from list_info where is_deleted=0 and gmt_created BETWEEN '$startMonth' AND '$endMonth'");
$list_month_data=mysqli_fetch_assoc($list_month);
$list_month_total=$list_month_data['total'];

//文本
$text=$mysqli->query("select count(*) as total from text_info where is_deleted=0");
$text_date=mysqli_fetch_assoc($text);
$text_total=$text_date['total'];

$text_today=$mysqli->query("select count(*) as total from text_info where is_deleted=0 and gmt_created BETWEEN '$today_begin' AND '$today_end'");
$text_day_data=mysqli_fetch_assoc($text_today);
$text_day_total=$text_day_data['total'];

$text_month=$mysqli->query("select count(*) as total from text_info where is_deleted=0 and gmt_created BETWEEN '$startMonth' AND '$endMonth'");
$text_month_data=mysqli_fetch_assoc($text_month);
$text_month_total=$text_month_data['total'];

//招聘
$recruit=$mysqli->query("select count(*) as total from recruit_info where is_deleted=0");
$recruit_date=mysqli_fetch_assoc($recruit);
$recruit_total=$recruit_date['total'];

$recruit_today=$mysqli->query("select count(*) as total from recruit_info where is_deleted=0 and gmt_created BETWEEN '$today_begin' AND '$today_end'");
$recruit_day_data=mysqli_fetch_assoc($recruit_today);
$recruit_day_total=$recruit_day_data['total'];

$recruit_month=$mysqli->query("select count(*) as total from recruit_info where is_deleted=0 and gmt_created BETWEEN '$startMonth' AND '$endMonth'");
$recruit_month_data=mysqli_fetch_assoc($recruit_month);
$recruit_month_total=$recruit_month_data['total'];
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
    <title>我的桌面</title>
</head>
<body>
<div class="page-container">
    <p class="f-20 text-success">欢迎使用北京高峰宏道投资有限公司CMS系统！</p>
    <p>登录次数：<?php echo $login_count?> </p>
    <p>上次登录IP：<?php echo $last_login_ip?>  上次登录时间：<?php echo $last_login_time?></p>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th colspan="7" scope="col">信息统计</th>
        </tr>
        <tr class="text-c">
            <th>统计</th>
            <th>菜单库</th>
            <th>图片库</th>
            <th>新闻库</th>
            <th>文本库</th>
            <th>招聘库</th>
        </tr>
        </thead>
        <tbody>
        <tr class="text-c">
            <td>总数</td>
            <td><?php echo $menu_total?></td>
            <td><?php echo $image_total?></td>
            <td><?php echo $list_total?></td>
            <td><?php echo $text_total?></td>
            <td><?php echo $recruit_total?></td>
        </tr>
        <tr class="text-c">
            <td>今日</td>
            <td><?php echo $menu_day_total?></td>
            <td><?php echo $image_day_total?></td>
            <td><?php echo $list_day_total?></td>
            <td><?php echo $text_day_total?></td>
            <td><?php echo $recruit_day_total?></td>
        </tr>
        <tr class="text-c">
            <td>本月</td>
            <td><?php echo $menu_month_total?></td>
            <td><?php echo $image_month_total?></td>
            <td><?php echo $list_month_total?></td>
            <td><?php echo $text_month_total?></td>
            <td><?php echo $recruit_month_total?></td>
        </tr>
        </tbody>
    </table>
    <table class="table table-border table-bordered table-bg mt-20">
        <thead>
        <tr>
            <th colspan="2" scope="col">服务器信息</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>服务器IP地址</td>
            <td>192.168.1.1</td>
        </tr>
        <tr>
            <td>服务器域名</td>
            <td><a href="http://www.gfhdtz.com">www.gfhdtz.com</a></td>
        </tr>
        <tr>
            <td>服务器端口 </td>
            <td>80</td>
        </tr>
        <tr>
            <td>服务器IIS版本 </td>
            <td>Microsoft-IIS/6.0</td>
        </tr>
        <tr>
            <td>服务器操作系统 </td>
            <td>Microsoft Windows NT 5.2.3790 Service Pack 2</td>
        </tr>
        <tr>
            <td>系统所在文件夹 </td>
            <td>C:\WINDOWS\system32</td>
        </tr>
        <tr>
            <td>服务器脚本超时时间 </td>
            <td>30000秒</td>
        </tr>
        <tr>
            <td>服务器的语言种类 </td>
            <td>Chinese (People's Republic of China)</td>
        </tr>
        <tr>
            <td>.NET Framework 版本 </td>
            <td>2.050727.3655</td>
        </tr>
        <tr>
            <td>服务器当前时间 </td>
            <td><?php echo date("Y-m-d H:i:s")?></td>
        </tr>
        <tr>
            <td>服务器IE版本 </td>
            <td>6.0000</td>
        </tr>
        <tr>
            <td>服务器上次启动到现在已运行 </td>
            <td>7210分钟</td>
        </tr>
        <tr>
            <td>逻辑驱动器 </td>
            <td>C:\D:\</td>
        </tr>
        <tr>
            <td>CPU 总数 </td>
            <td>4</td>
        </tr>
        <tr>
            <td>CPU 类型 </td>
            <td>x86 Family 6 Model 42 Stepping 1, GenuineIntel</td>
        </tr>
        <tr>
            <td>虚拟内存 </td>
            <td>52480M</td>
        </tr>
        <tr>
            <td>当前程序占用内存 </td>
            <td>3.29M</td>
        </tr>
        <tr>
            <td>Asp.net所占内存 </td>
            <td>51.46M</td>
        </tr>
        <tr>
            <td>当前Session数量 </td>
            <td>8</td>
        </tr>
        <tr>
            <td>当前SessionID </td>
            <td>gznhpwmp34004345jz2q3l45</td>
        </tr>
        <tr>
            <td>当前系统用户名 </td>
            <td>NETWORK SERVICE</td>
        </tr>
        </tbody>
    </table>
</div>
<footer class="footer mt-20">
    <div class="container">
        <p>
            Copyright &copy;2015-2017 All Rights Reserved. 北京高峰宏道投资有限公司<br>
        </p>
    </div>
</footer>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
</body>
</html>
