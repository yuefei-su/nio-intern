<?php
   require_once ('../include/config.php');
  //  $sql = "select * from class";
  //  $class = select_all($conn,$sql);

   if(isset($_GET['del'])){
     $condition = "d_id=".$_GET['del'];
      $res = del($conn,'department',$condition);
     if($res){
       msg_jump('删除成功','dep_list.php');
     }else{
      msg_jump('删除失败');
     }
   }

  //分页
  $current = isset($_GET['page'])?$_GET['page']:1;
  $limit = 3;
  $n = ($current-1)*$limit;
  $sql = "select * from department limit $n,$limit";
  $dep = select_all($conn,$sql);

  $co_sql = "select count(d_id) from department";
  $c = select_all($conn,$co_sql);
  $count = $c[0]["count(d_id)"];
?>
<?php require_once ('yetuo.php');?>
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">院系管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">院系列表</div>
                  <a href="dep_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加资讯</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center">
                          <a class="btn btn-gray btn-sm" id="selectAll">全选</a>
                          <a class="btn btn-gray btn-sm" id="selectNotAll">反选</a>
                        </th>
                        <th>院系名称</th>
                        <th>院长</th>
                        <th>电话</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php foreach($dep as $v){?>
                    	<tr class="success">
                        <td class="text-center"><input type="checkbox" value="<?php echo $v['id'];?>" name="idarr[]" class="cbox"></td>
                        <td><?php echo $v['d_name'];?></td>
                        <td><?php echo $v['d_manage'];?></td>
                        <td><?php echo $v['d_phone'];?></td>
                        <td>
		                      <div class="btn-group">
		                        <a href="dep_edit.php?edit=<?php echo $v['d_id'];?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
		                        <a onclick="return confirm('确定要删除吗？');" href="?del=<?php echo $v['d_id'];?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
		                      </div>
                        
                        </td>
                      </tr>
                      <?php }?>
                  </table>
                  
                  <div class="pull-left">
                    <button type="submit" class="btn btn-default btn-gradient pull-right delall">
                      <span class="glyphicons glyphicon-trash"></span></button>
                  </div>
                  
                  <div class="pull-right">
                    <ul class="pagination" id="paginator-example">
                    <?php echo page($current,$count,$limit,5);?>
                      <!-- <li><a href="#">&lt;</a></li>
                      <li><a href="#">&lt;&lt;</a></li>
                      <li><a href="#">1</a></li>
                      <li class="active"><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">&gt;</a></li>
                      <li><a href="#">&gt;&gt;</a></li> -->
                    </ul>
                  </div>
                  
                </div>
                </form>
              </div>
          </div>
        </div>
    </div>
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --> 
</body>
</html>