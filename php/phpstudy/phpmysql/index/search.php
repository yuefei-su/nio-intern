<html>
   <head>
      <title>Bootstrap 模板</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- 引入 Bootstrap -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 
      <!-- HTML5 Shiv 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
      <!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
      <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
   </head>
   <style>
		img{
			width:55px;
			hight:55px;
		}
   </style>
 	  
   <body>
  
      <table class="table table-hover">
		  <caption>悬停表格布局</caption>
		  <thead>
			<tr>
			  <th>id</th>
			  <th>名称</th>
			  <th>城市</th>
			  <th>图片</th>
			  <th>邮编</th>
			  <th>操作</th>
			  <th style="width:220px">
			 <form role="form" enctype="multipart/form-data" action="search.php" method="POST">
				<div class="input-group" >
				
					<input type="text" style="width:150px" name="search" class="form-control" placeholder="搜索名称">
				
						<button class="btn btn-default" type="submit">
							搜索
						</button>
				
				</div>
				 </form>	
			  <a class="btn btn-default" style="" href="add.html" role="button">添加</a>
			  <a class="btn btn-default" style="" href="../logout.php" role="button">注销</a>
			  </th>
			</tr>
		  </thead>
		 
		  <tbody>
<?php

	include('conn.php');
	
	$search = $_POST['search'];
	if(!empty($search)){
		$sql = "select * from admin  where name like '%$search%'";
		$res = mysqli_query($link,$sql);
		
		if(!empty(mysqli_num_rows($res))){
			foreach($res as $v){
						echo "<tr>
								 <th>{$v['id']}</th>
								  <td>{$v['name']}</td>
								  <td>{$v['crity']}</td>
								  <td>    
									<a href={$v['picture']}><img src={$v['picture']}></a>
								  </td>
								  <td>{$v['email']}</td>
								  <td>
									  <a href='edit.php?id={$v['id']}'>编辑</a>
									  <a href='delete.php?id={$v['id']}'>删除</a>
								  </td>
							 </tr>";
						 
				}
				mysqli_close($link);	
		}else{
			echo "<tr>
					 <th>没有数据信息</th>
				</tr>";
		}
		
	}else{
		echo "<tr>
					 <th>请输入要搜索内容</th>
				</tr>";
	}
	
		
	
	?>
	
 </tbody>
		

		</table> 
<a class="btn btn-default" href="index.php" role="button">返回主页</a>
		  
 
      <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
      <script src="https://code.jquery.com/jquery.js"></script>
      <!-- 包括所有已编译的插件 -->
      <script src="js/bootstrap.min.js"></script>
   </body>
   
</html>



