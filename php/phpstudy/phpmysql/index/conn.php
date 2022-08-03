<?php

	$dblocalhost = 'localhost';
	$dbuser = 'root';
	$dbpwd = 'root';
	$dbname = 'demo';
	
	$link = mysqli_connect($dblocalhost,$dbuser,$dbpwd,$dbname);
	if(!$link){
		die('连接失败'.$link->mysql_error());
	}

?>
