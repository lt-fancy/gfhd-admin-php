<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/12
 * Time: 11:30
 */
require_once '../mysql.php';
$id = $_POST['id'];
$result=$_POST['type'];
$isParent=$_POST['isParent'];
if(0==$isParent){
    //父级菜单
    $mysqli->query("update menu_info set is_deleted=$result where parent_id=$id");
}
$mysqli->query("update menu_info set is_deleted=$result where id=$id");
if (mysqli_affected_rows($mysqli)) {
    $arr['success'] = 1;
    if(0==$result){
        $arr['msg'] = '上线成功！';
    } else {
        $arr['msg'] = '下线成功！';
    }
} else {
    $arr['success'] = 0;
    if(0==$result){
        $arr['msg'] = '上线失败！请稍后重试';
    } else {
        $arr['msg'] = '下线失败！请稍后重试';
    }
}

echo json_encode($arr); //输出json数据