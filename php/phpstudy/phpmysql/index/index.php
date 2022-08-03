<!DOCTYPE html>
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
	img {
		width: 55px;
		hight: 55px;
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
						<div class="input-group">

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
			include("conn.php");
			include("../session/session.php");


			$num_rec_per_page = 6; //设置每页显示的数量
			if (isset($_GET["page"])) {
				$page  = $_GET["page"];
			} else {
				$page = 1;
			};
			$start_from = ($page - 1) * $num_rec_per_page;

			$sql = "select * from admin  ORDER BY id ASC limit $start_from,$num_rec_per_page";

			$array = $link->query($sql);
			//$attrn = $array->fetch_assoc();
			foreach ($array as $v) {
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
			};
			mysqli_close($link);

			?>

		</tbody>


	</table>
	<?php
	include("conn.php");
	$sql = "select * from admin";
	$rs_result = $link->query($sql); //查询数据
	$total_records = mysqli_num_rows($rs_result);

	$total_pages = ceil($total_records / $num_rec_per_page);  // 计算总页数

	echo "<ul class='pagination'>
			<li><a href='index.php?page=1'>&laquo;</a></li>"; // 第一页

	for ($i = 1; $i <= $total_pages; $i++) {
		echo "<li><a href='index.php?page=" . $i . "'>" . $i . "</a> </li>";
	};
	echo "<li><a href='index.php?page=$total_pages'>&raquo;</li></ul>"; // 最后一页
	mysqli_close($link);
	?>



	<!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
	<script src="https://code.jquery.com/jquery.js"></script>
	<!-- 包括所有已编译的插件 -->
	<script src="js/bootstrap.min.js"></script>
</body>

</html>