<?php

		$admin = false;
			//  启动会话
		session_start();
			//  判断是否登陆
		if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
			//echo "欢迎用户".$_SESSION['admin'];
		} else {
				// 验证失败，将 $_SESSION["admin"] 置为 false
			$_SESSION["admin"] = false;
			echo "<script> alert('你没有权限访问！')</script>";
			header('Refresh:0.1,../login.html');
		}

?>