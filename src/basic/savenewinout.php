<?php
include("../conn/conn.php");
$type = $_POST['type'];
$name = $_POST['name'];
$cost = $_POST['cost'];
$id = $_GET['id'];

// 限制$type只能是字母或数字
if (!preg_match('/^[a-zA-Z0-9]+$/', $type)) {
    die("<script>alert('非法输入！');history.back();</script>");
}

// 对$name做类似限制
if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
    die("<script>alert('非法输入！');history.back();</script>");
}

// 确保$cost是数字
if (!is_numeric($cost)) {
    die("<script>alert('非法金额输入！');history.back();</script>");
}

// 确保$id是数字
if (!empty($id) && !is_numeric($id)) {
    die("<script>alert('非法ID输入！');history.back();</script>");
}
if($id!="")
{
       $sql=mysql_query("select * from tb_inout where id='".$id."'",$conn);
      $info=mysql_fetch_array($sql);
	  mysql_query("update tb_inout set type='$type',cost='$cost' where id='".$id."'",$conn);
	  echo "<script>alert('修改成功!');window.location='inoutsetting.php';</script>";
}
else
{ 
    $sql=mysql_query("select * from tb_inout where name='".$name."'",$conn);
   $info=mysql_fetch_array($sql);
   if($info==true)
   {
      echo "<script>alert('该类别已经存在!');history.back();</script>";
      exit;
	}
	else
	{
	    mysql_query("insert into tb_inout(type,name,cost) values('$type','$name','$cost')",$conn);
	    echo "<script>alert('添加成功!');history.back();</script>";
	 }
}


?>
