<?php
    header("content-type:text/html;charset=utf8;");
    date_default_timezone_set("Asia/Shanghai");
    $host = 'localhost';
    $user = 'root';
    $pws = 'root';
    $db = 'students';
    // 连接数据库
    $conn = @mysqli_connect($host,$user,$pws,$db);
    //@符号，忽略错误和警告
	if(!$conn){
		die('数据库错误：'.mysqli_connect_errno().','.mysqli_connect_error());
    }
    // 设置编码
    mysqli_query($conn,"SET NAMES 'utf8'");

    require_once ('function.php');

    $sql_dep = "select * from department";
    $sql_class = "select * from class";
    $sql_course = "select * from course";
    $sql_stu = "select * from student";
    $dep = select_all($conn,$sql_dep);
    $class = select_all($conn,$sql_class);
    $course = select_all($conn,$sql_course);
    $stu = select_all($conn,$sql_stu);








?>
