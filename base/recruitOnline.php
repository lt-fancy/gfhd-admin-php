<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/16
 * Time: 20:10
 */
require_once '../mysql.php';
$ids = $_POST['id'];
$result=$_POST['type'];
$mysqli->query("update recruit_info set is_deleted=$result where id in ($ids)");
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