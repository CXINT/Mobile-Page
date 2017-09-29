<?php

	header("Content-type: text/html; charset=utf-8"); //指定页面编码
	
	if (empty($_POST)) header('location:index.html');
	//接收数据
	$visitorName 	= htmlspecialchars($_POST['visitorName']);//姓名
	$visitorPhone	= htmlspecialchars($_POST['visitorPhone']);//电话或者微信号
	$addtime  = date("Y-m-d H:i:s ");
	$ip = $_SERVER["REMOTE_ADDR"];//IP
	//$url = $_GET["url"];
	//var_dump($_POST);
		
	//连接数据库
	include("conn.php");
	
	$s = "select * from user where ip ='"."$ip'";//检测ip,相同的ip只能填写一次
	$sql=mysql_query($s);
	$info=mysql_fetch_array($sql);
	//var_dump($sql1);
	//exit;
	if ($info) {
		echo "<script language='javascript'>alert('您已填写过资料，请勿重复提交');history.back();</script>";
		exit;
	} else {
		//发送sql语句
		$sql = "insert into user(visitorName, visitorPhone, ip, addtime) values('$visitorName', '$visitorPhone', '$ip', '$addtime')";
		//echo $sql;
		//exit;
		$re=mysql_query($sql);
		 echo "<script language='javascript'>alert('感谢您的填写');history.back();</script>";
		 exit; 
	}
		
?>






		