<?php

	include('index/conn.php');
	
	$name = $_POST['username'];
	$password = $_POST['password'];
	
	//var_dump($name);
	
	$sql = "select * from user";
	
	$res =  mysqli_query($link,$sql);
	//var_dump($res);exit();
	
	$attrn = $res->fetch_assoc();
	
	$username = $attrn['username'];
	
	$pwd = $attrn['password'];
	
/* 	if($name == $username && md5($password) == $pwd){
		echo "<script> alert('登录成功！')</script>";
		header('Refresh:1,index/index.php');
	}else{
		echo "<script> alert('登录失败！')</script>";
		echo "<h5>账号或者用户名错误</h5>";
		header('Refresh:2,login.html');
	} */
	
	if (!empty($name) == $username && !empty(md5($password)) == $pwd) {
    //  当验证通过后，启动 Session
		echo "<script> alert('登录成功！')</script>";
		header('Refresh:1,index/index.php');
		session_start();
    //  注册登陆成功的 admin 变量，并赋值 true
		$_SESSION["admin"] = true;
	} else {
		echo "<script> alert('登录失败！')</script>";
		echo "<h5>账号或者用户名错误</h5>";
		header('Refresh:2,login.html');
	}

	
	
	
	mysqli_close($link);







?>