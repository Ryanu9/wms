<?php
include("../conn/conn.php");
$type = $_POST['type'];
$name = $_POST['name'];
$cost = $_POST['cost'];
$id = $_GET['id'];

// ����$typeֻ������ĸ������
if (!preg_match('/^[a-zA-Z0-9]+$/', $type)) {
    die("<script>alert('�Ƿ����룡');history.back();</script>");
}

// ��$name����������
if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
    die("<script>alert('�Ƿ����룡');history.back();</script>");
}

// ȷ��$cost������
if (!is_numeric($cost)) {
    die("<script>alert('�Ƿ�������룡');history.back();</script>");
}

// ȷ��$id������
if (!empty($id) && !is_numeric($id)) {
    die("<script>alert('�Ƿ�ID���룡');history.back();</script>");
}
if($id!="")
{
       $sql=mysql_query("select * from tb_inout where id='".$id."'",$conn);
      $info=mysql_fetch_array($sql);
	  mysql_query("update tb_inout set type='$type',cost='$cost' where id='".$id."'",$conn);
	  echo "<script>alert('�޸ĳɹ�!');window.location='inoutsetting.php';</script>";
}
else
{ 
    $sql=mysql_query("select * from tb_inout where name='".$name."'",$conn);
   $info=mysql_fetch_array($sql);
   if($info==true)
   {
      echo "<script>alert('������Ѿ�����!');history.back();</script>";
      exit;
	}
	else
	{
	    mysql_query("insert into tb_inout(type,name,cost) values('$type','$name','$cost')",$conn);
	    echo "<script>alert('��ӳɹ�!');history.back();</script>";
	 }
}


?>
