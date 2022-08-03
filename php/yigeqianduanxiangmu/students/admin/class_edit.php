<?php
   require_once ('../include/config.php');
   $sql = "select * from class";
   $class = select_all($conn,$sql);

   if(isset($_GET['edit'])){
     global $edit;
     $edit = $_GET['edit'];
     $sql = "select * from class where id =$edit";
     $data = select_one($conn,$sql);
   }

   if(isset($_POST['commit'])){
    $data = array(
      'c_name' => $_POST['name']
    );
    $condition = "id =$edit";
    $res = update($conn,'class',$data,$condition);
    if($res){
      msg_jump('成功','class_list.php');
    }else{
     msg_jump('失败');
    }
  }
?>
<?php require_once ('yetuo.php');?>
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">编辑班级类型</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-11 center-column">
        <form action="#" method="post" class="cmxform">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">编辑班级类型</div>
              <div class="panel-btns pull-right margin-left">
              <a href="class_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">班级名字</span>
                    <input type="text" name="name" value="<?php echo $data['c_name']?>" class="form-control">
                  </div>
                </div>
                </div>
                <div class="col-md-7">
	                <div class="form-group">
	                  <input type="submit" name='commit' value="提交" class="submit btn btn-blue">
	                </div>
                </div>
            </div>
          </div>
          </form>
        </div>
    </div>
  </section>
  <!-- End: Content --> 
</div>

</body>

</html>