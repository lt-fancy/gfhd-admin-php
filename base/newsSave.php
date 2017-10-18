<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/14
 * Time: 15:10
 */
require_once '../mysql.php';
$id = $_POST['id'];
$title = $_POST['title'];
$isHome = $_POST['is_home'];
$image = $_POST['image'];
$content = $_POST['content'];
if($id==0){
    //新增
    $sql= $mysqli->query("insert into list_info (menu_ename,menu_cname,list_title,list_content,gmt_created,
                    gmt_modified,is_deleted,author,is_home,image_uri) values('news-business','行业信息','$title','$content',now(),now(),0,'管理员',$isHome,'$image')");
} else {
    //更新
    $sql = $mysqli->query("update list_info set list_title='$title',list_content='$content',image_uri='$image',is_home=$isHome, gmt_modified=now() where id=$id");
}
if(mysqli_affected_rows($mysqli)){
    $arr['success'] = 1;
    $arr['msg'] = '保存成功！';
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
} else {
    $arr['success'] = 0;
    $arr['msg'] = '保存失败！';
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    exit;
}