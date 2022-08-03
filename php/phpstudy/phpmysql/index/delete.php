<?php

	include('conn.php');
	include('../session/session.php');
	$id = $_GET['id'];
	
	$sql = "delete from admin where id='$id'";
	
	if($sql){
		echo '执行成功';
	}else{
		echo '执行失败';
	}
	
	$res = mysqli_query($link,$sql);
	
	if($res>0){
        echo "<script>alert('删除成功')</script>";
    }else{
        echo "<script>alert('删除失败！')</script>";
    }
	
    header("Location:index.php");




?>