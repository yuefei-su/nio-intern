<?php
   require_once ('../include/config.php');
   $sql = "select * from class";
   $class = select_all($conn,$sql);

   if(isset($_POST['name'])){
     $data = array(
       'c_name' => $_POST['name']
     );
     $res = add($conn,'class',$data);
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
        <li class="active">添加班级</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-11 center-column">
        <form action="#" method="post" class="cmxform">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">添加班级</div>
              <div class="panel-btns pull-right margin-left">
              <a href="class_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">班级名字</span>
                    <input type="text" name="name" value="" class="form-control">
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