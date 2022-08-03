<?php
   include_once ('./include/config.php');
  function del_path($path){
    if(isset($path)){
      $img_yuan = $path;
      if(file_exists($img_yuan)){
        unlink($img_yuan);
      }
    }
  }
   
// 添加课程
if (isset($_POST) && !empty($_POST)) {
    $data = array(
        'c_id' => $_POST['id'],
        'c_name' => $_POST['name'],
        'c_teacher' => $_POST['teacher'],
        'c_credit' => $_POST['credit']
      );
      $res = add($conn,'course',$data);
      if($res){
        msg_jump('成功','cou_list.php');
      }else{
       msg_jump('失败');
      }
    }

 //分页
 $current = isset($_GET['page'])?$_GET['page']:1;
 $limit = 3;
 $n = ($current-1)*$limit;
 $sql = "select * from course order by c_id limit $n,$limit";
 $course = select_all($conn,$sql);

 $co_sql = "select count(c_id) from course";
 $c = select_all($conn,$co_sql);
 $count = $c[0]["count(c_id)"];

    //删除记录
    if(isset($_GET['del'])){
        $condition = "c_id=".$_GET['del'];
       $res = del($conn,'course',$condition);
        if($res){
          msg_jump('删除成功','cou_list.php');
        }else{
         msg_jump('删除失败');
        }
      }

    //关闭数据库
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/css.css" />
    <link rel="stylesheet" href="./css/animate.css" />
    <title>课程管理</title>
    <style>
        .titles>th{text-align: center;}
        table td{vertical-align: middle!important;}
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <h2 class="text-center text-primary">课程管理</h2>
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <td colspan="7">
                        <h4>
                            <a class="btn btn-primary pull-left" href='index.php'>
                                管理学生
                            </a>
                            <a class="btn btn-primary pull-left" href='dep_list.php'>
                                管理院系
                            </a>
                            <a class="btn btn-primary pull-left disabled" href='cou_list.php'>
                                管理课程
                            </a>
                            <a class="btn btn-primary pull-left" href='class_list.php'>
                                管理班级
                            </a>
                            <a class="btn btn-primary pull-left" href='score_list.php'>
                                管理成绩
                            </a>
                            <a id="add" class="btn btn-primary pull-right" data-toggle="modal" data-target=".add-model">
                                添加课程
                            </a>
                        </h4>
                    </td>
                </tr>
                <tr class="titles">
                    <th>id</th>
                    <th>课程名称</th>
                    <th>课程老师</th>
                    <th>课程学分</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($course as $v) { ?>
                    <tr align="center">
                        <td><?php echo $v['c_id'];?></td>
                        <td><?php echo $v['c_name'];?></td>
                        <td><?php echo $v['c_teacher'];?></td>
                        <td><?php echo $v['c_credit'];?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="cou_edit.php?edit=<?php echo $v['c_id'];?>">修改</a>
                            <a class="btn btn-sm btn-warning del" onclick="return confirm('确定删除吗？');" href="?del=<?php echo $v['c_id'];?>">删除</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <!-- 分页 -->
            <nav aria-label="Page navigation" style="margin:auto;">
                <ul class="pagination">
                   <?php echo page($current,$count,$limit,5,'Gray');?>
                </ul>
            </nav>
        </div>        
    </div>
    


    <!-- 添加课程模态框 -->
    <div class="modal fade add-model"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static"  data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加课程</h4>
                </div>             
                <form action="" method="post" class="form-horizontal" style="margin-top:20px;">                          
                    <div class="form-group">
                        <label for="id" class="col-sm-2 control-label">课程序号</label>
                        <div class="col-sm-9">
                            <input type="text" name="id" class="form-control" id='id' placeholder='可选，不可以填已存在的'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-2 control-label">课程名称</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="age" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-2 control-label">课程老师</label>
                        <div class="col-sm-9">
                            <input type="text" name="teacher" class="form-control" id="age" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-2 control-label">课程学分</label>
                        <div class="col-sm-9">
                            <input type="text" name="credit" class="form-control" id="age" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <input type="submit" name='add' class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>
</html>