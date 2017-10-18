<?php
/* 数据库的配置*/
$host="w.rdc.sae.sina.com.cn";
$db_user="m1yk41zo35";
$db_pass="xm1i3jk145ml20lk2xwz224mj0ilz10yhh3x3ily";
$db_name="app_gfhdtz";

$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);
$mysqli->query("SET names UTF8");