<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/12
 * Time: 10:11
 */
require_once '../mysql.php';
$name=$_POST['value'];
$id=$_POST['id'];
$mysqli->query("update menu_info set menu_cname='$name' where id=$id");
echo $name;