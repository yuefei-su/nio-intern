<?php
	session_start();
	// 将原来注册的某个变量销毁
	$res = $_SESSION['admin']; 
	//  销毁整个 Session 文件
	if(isset($res)){
		unset($res);
		echo "注销成功";
		header("Refresh:1,login.html");
	}
	session_destroy();
?>