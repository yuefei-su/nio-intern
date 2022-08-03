<?php
	header("Content-Type:text/html;charset=UTF-8");
	include('conn.php');
	include('../session/session.php');
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	$crity = $_POST['crity'];
	$email = $_POST['email'];
	$picture = $_FILES['file'];
	$result = $_SERVER['SERVER_NAME'];
	if ($picture['type'] == "image/jpg" || $picture['type'] == "image/png"  or $picture['type'] == "text/plain") {
  //9、输出：失败
		echo '失败--类型不符';
	    die();
	}
	if ($picture['size'] > 8000000) {
		  //9、输出：失败
		echo '失败--大小不符';
		die();
	}
		//7、移动临时文件到上传的文件存放位置（核心代码）
	 $picture_1 = "http://".$result.'/phpmysql/upload/'.$picture['name'];
	 copy($picture['tmp_name'], "D:\phpstudy_pro\WWW\phpmysql\upload\\". $picture['name']);
		//8、输出：成功

	$sql = "insert admin (id,name,crity,email,picture) values ('$id','$name','$crity','$email','$picture_1')";
	//var_dump($sql);exit();
	
	 $res = mysqli_query($link,$sql);
	 
     if($res>0){
        echo "<script>alert('添加成功')</script>";
		header("Location:index.php");
    }else{
		 header("Location:add.html");
		 echo "<script>alert('添加失败！')</script>";
    }
	
    
mysqli_close($link);

?>