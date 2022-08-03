<?php
   require_once ('../include/config.php');
  //  $sql = "select * from class";
  //  $class = select_all($conn,$sql);

   if(isset($_GET['del'])){
     $condition = "c_id=".$_GET['del'];
    $res = del($conn,'course',$condition);
     if($res){
       msg_jump('删除成功','cou_list.php');
     }else{
      msg_jump('删除失败');
     }
   }

  //分页
  $current = isset($_GET['page'])?$_GET['page']:1;
  $limit = 3;
  $n = ($current-1)*$limit;
  $sql = "select * from course limit $n,$limit";
  $course = select_all($conn,$sql);

  $co_sql = "select count(c_id) from course";
  $c = select_all($conn,$co_sql);
  $count = $c[0]["count(c_id)"];
?>
<?php require_once ('yetuo.php');?>
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">课程管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">课程列表</div>
                  <a href="cou_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加资讯</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center">
                          <a class="btn btn-gray btn-sm" id="selectAll">全选</a>
                          <a class="btn btn-gray btn-sm" id="selectNotAll">反选</a>
                        </th>
                        <th>课程名称</th>
                        <th>课程老师</th>
                        <th>课程学分</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php foreach($course as $v){?>
                    	<tr class="success">
                        <td class="text-center"><input type="checkbox" value="<?php echo $v['c_id'];?>" name="idarr[]" class="cbox"></td>
                        <td><?php echo $v['c_name'];?></td>
                        <td><?php echo $v['c_teacher'];?></td>
                        <td><?php echo $v['c_credit'];?></td>               
                        <td>
		                      <div class="btn-group">
		                        <a href="cou_edit.php?edit=<?php echo $v['c_id'];?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
		                        <a onclick="return confirm('确定要删除吗？');" href="?del=<?php echo $v['c_id'];?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
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