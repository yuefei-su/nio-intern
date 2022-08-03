<!DOCTYPE html>
<html>
   <head>
      <title>Bootstrap 模板</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 
   </head>
      <style>
		img{
			width:100px;
			hight:100px;
		}
   </style>
   <body>
   
		<?php
			include('conn.php');
			
				$id = $_GET['id'];
				$sql = "select * from admin where id = '$id'";
				$res = $link->query($sql);
				$stu = mysqli_fetch_assoc($res);
				
		?>
		
		<form role="form" enctype="multipart/form-data" action="action.php" method="POST">
				<div class="form-group">
					<label for="name">id</label>
					<input type="text" class="form-control" name="id" value="<?php  echo $stu['id'];?>"/>
				</div>
				  <div class="form-group">
					<label for="name">名字</label>
					<input type="text" class="form-control" name="name" value="<?php  echo $stu['name']; ?>"/>
				  </div>
				  <div class="form-group">
					<label for="name">城市</label>
					<input type="text" class="form-control" name="crity" value="<?php  echo $stu['crity']; ?>"/>
				  </div>
				  <div class="form-group">
					<label for="name">请选择上传文件</label>
			        	<input class="form-control" type="file" name="file"/>
						<input type="text" class="form-control" name="picture" value="<?php  echo $stu['picture'];?>"/>
					 	<img src="<?php echo $stu['picture']; ?>"> 
				  </div>
				  <div class="form-group">
					<label for="name">邮编</label>
					<input type="text" class="form-control" name="email" value="<?php  echo $stu['email']; ?>"/>
				  </div>
			
			  <button type="submit" class="btn btn-default">提交</button>
		</form>
 
  
      <script src="https://code.jquery.com/jquery.js"></script>
      <script src="js/bootstrap.min.js"></script>
   </body>
</html>