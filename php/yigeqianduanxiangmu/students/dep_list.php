<?php
   include_once ('./include/config.php');
   
// 添加院系
    if (isset($_POST) && !empty($_POST)) {
        $data = array(
            'd_id' => $_POST['id'],
            'd_name' => $_POST['name'],
            'd_manage' => $_POST['manage'],
            'd_phone' => $_POST['phone']
        );
        $res = add($conn,'department',$data);
        if($res){
            msg_jump('成功','dep_list.php');
        }else{
            msg_jump('失败');
        }
    }

    //删除记录
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
  $limit = 4;
  $n = ($current-1)*$limit;
  $sql = "select * from department order by d_id limit $n,$limit";
  $class = select_all($conn,$sql);

  $co_sql = "select count(d_id) from department ";
  $c = select_all($conn,$co_sql);
  $count = $c[0]["count(d_id)"];

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
    <title>院系管理</title>
    <style>
        .titles>th{text-align: center;}
        table td{vertical-align: middle!important;}
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <h2 class="text-center text-primary">院系管理</h2>
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <td colspan="7">
                        <h4>
                            <a class="btn btn-primary pull-left" href='index.php'>
                                管理学生
                            </a>
                            <a class="btn btn-primary pull-left disabled" href='dep_list.php'>
                                管理院系
                            </a>
                            <a class="btn btn-primary pull-left" href='cou_list.php'>
                                管理课程
                            </a>
                            <a class="btn btn-primary pull-left" href='class_list.php'>
                                管理班级
                            </a>
                            <a class="btn btn-primary pull-left" href='score_list.php'>
                                管理成绩
                            </a>
                            <a id="add" class="btn btn-primary pull-right" data-toggle="modal" data-target=".add-model">
                                添加院系
                            </a>
                        </h4>
                    </td>
                </tr>
                <tr class="titles">
                    <th>id</th>
                    <th>院系名称</th>
                    <th>院长</th>
                    <th>电话</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($class as $v) { ?>
                    <tr align="center">
                        <td><?php echo $v['d_id'];?></td>
                        <td><?php echo $v['d_name'];?></td>
                        <td><?php echo $v['d_manage'];?></td>
                        <td><?php echo $v['d_phone'];?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="dep_edit.php?edit=<?php echo $v['d_id'];?>">修改</a>
                            <a class="btn btn-sm btn-warning del" onclick="return confirm('确定删除吗？');" href="?del=<?php echo $v['d_id'];?>">删除</a>
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
    


    <!-- 添加院系模态框 -->
    <div class="modal fade add-model"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static"  data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加院系</h4>
                </div>             
                <form action="" method="post" class="form-horizontal" style="margin-top:20px;">                          
                    <div class="form-group">
                        <label for="id" class="col-sm-2 control-label">院系序号</label>
                        <div class="col-sm-9">
                            <input type="text" name="id" class="form-control" id='id' placeholder='可选，不可以填已存在的'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-2 control-label">院系名称</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="age" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-2 control-label">院长</label>
                        <div class="col-sm-9">
                            <input type="text" name="manage" class="form-control" id="age" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-2 control-label">院系电话</label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" class="form-control" id="age" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <input type="submit"  class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>
</html>