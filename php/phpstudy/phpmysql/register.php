<?php
	include('index/conn.php');
	
	
	$name = $_POST['name'];
	$password = md5($_POST['password']);
	$time = time();
	

	$sql = "insert user(username,password,creation_time) values ('$name','$password','$time')";
	//var_dump($sql);exit();
	$res = mysqli_query($link,$sql);
	
	if($res>0){
        echo "<script>alert('注册成功')</script>";
		header("Refresh:1,login.html");
    }else{
		echo "<script>alert('注册失败！')</script>";
		  header("Refresh:1,register.html");
		 
    }
	
    
	mysqli_close($link);





?>