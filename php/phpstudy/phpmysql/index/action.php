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
	//var_dump($id,$name,$picture);exit();
	
	//var_dump($_FILES['file']['name']);exit();
	if(!empty($_FILES['file']['name']))
	{
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
		
	}else{
		$picture_1 = $_POST['picture'];
	}
	
	//var_dump($picture_1);exit();
	
	$sql = "update admin set id ='$id',name ='$name',crity='$crity',email = '$email', picture='$picture_1' where id = '$id' ";
	//var_dump($sql);exit();
	
	 $res = mysqli_query($link,$sql);
	// var_dump($res);exit();
     if($res>0){
        echo "<script>alert('修改成功')</script>";
		 header("Location:index.php");
    }else{
         echo "<script>alert('修改失败！')</script>";
		 header("Location:index.php");
    }
	
   mysqli_close($link);
	

?>