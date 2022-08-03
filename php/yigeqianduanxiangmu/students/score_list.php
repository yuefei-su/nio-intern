<?php
   include_once ('./include/config.php');

// 添加成绩
    if (isset($_POST) && !empty($_POST)) {
        $data = array(
            'number' => $_POST['number'],
            'c_id' => $_POST['c_id'],
            'score' => $_POST['score']
        );
        $res = add($conn,'score',$data);
        // var_dump($data);die;
        if($res){
            msg_jump('成功','score_list.php');
        }else{
            msg_jump('失败');
        }
    }

    //删除记录
    if(isset($_GET['del'])){
        $condition = "number=".$_GET['del'];
       $res = del($conn,'score',$condition);
        if($res){
          msg_jump('删除成功','score_list.php');
        }else{
         msg_jump('删除失败');
        }
      }

    //分页
  $current = isset($_GET['page'])?$_GET['page']:1;
  $limit = 3;
  $n = ($current-1)*$limit;
  $sql = "select * from score sc left join student stu on stu.number=sc.number 
  left join course co on co.c_id=sc.c_id order by d_id limit $n,$limit";
  $class = select_all($conn,$sql);

  $co_sql = "select count(score) from score";
  $c = select_all($conn,$co_sql);
  $count = $c[0]["count(score)"];

//   选中课程？
   if(isset($_GET['c_id'])){
       $cid = $_GET['c_id'];
        $sql = "select * from score sc left join student stu on stu.number=sc.number 
        left join course co on co.c_id=sc.c_id where sc.c_id='$cid' limit $n,$limit";
        $class = select_all($conn,$sql);
        
    $co_sql = "select count(score) from score sc left join student stu on stu.number=sc.number 
    left join course co on co.c_id=sc.c_id where sc.c_id='$cid' ";
    $c = select_all($conn,$co_sql);
    $count = $c[0]["count(score)"];
    // if($count==0){$data=array(0,0,0);}
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
    <title>成绩管理</title>
    <style>
        .titles>th{text-align: center;}
        table td{vertical-align: middle!important;}
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <h2 class="text-center text-primary">成绩管理</h2>
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
                            <a class="btn btn-primary pull-left" href='cou_list.php'>
                                管理科目
                            </a>
                            <a class="btn btn-primary pull-left" href='class_list.php'>
                                管理班级
                            </a>
                            <a class="btn btn-primary pull-left disabled" href='class_list.php'>
                                管理成绩
                            </a>
                                <select name="form-control" id="xuanze"class="btn btn-primary pull-left">
                                    <option value=""></option>
                                    <?php foreach($course as $v){?>
                                        <option value="<?php echo $v['c_id'];?>"
                                        <?php if(isset($_GET['c_id'])){if($_GET['c_id']==$v['c_id']){echo 'selected';}}?>>
                                            <?php echo $v['c_name']?>
                                        </option>
                                    <?php }?>
                                </select>
                            <a class="btn btn-primary pull-right" data-toggle="modal" data-target=".add-model">
                                添加成绩
                            </a>
                        </h4>
                    </td>
                </tr>
                <tr class="titles">
                    <th>学生头像</th>
                    <th>学生id</th>
                    <th>学生名字</th>
                    <th>科目</th>
                    <th>成绩</th>
                    <th>操作</th>
                </tr>
                <?php if(!(empty($class))){foreach($class as $v) {?>
                    <tr align="center">
                        <td><img class="img-circle" src="<?php echo file_exists($v['stu_thumb'])? $v['stu_thumb']:' '; ?>" alt=""></td>
                        <td><?php echo $v['number'];?></td>
                        <td><?php echo $v['name'];?></td>
                        <td><?php echo $v['c_name'];?></td>
                        <td><?php echo $v['score'];?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="score_edit.php?edit=<?php echo $v['number'];?>&c_id=<?php echo $v['c_id'];?>&score=<?php echo $v['score'];?>">修改</a>
                            <a class="btn btn-sm btn-warning del" onclick="return confirm('确定删除吗？');" href="?del=<?php echo $v['number'];?>">删除</a>
                        </td>
                    </tr>
                <?php } }?>
            </table>
            <!-- 分页 -->
            <nav aria-label="Page navigation" style="margin:auto;">
                <ul class="pagination">
                   <?php echo page($current,$count,$limit,5);?>
                </ul>
            </nav>
        </div>        
    </div>
    


    <!-- 添加成绩模态框 -->
    <div class="modal fade add-model"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static"  data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加成绩</h4>
                </div>             
                <form action="" method="post" class="form-horizontal" style="margin-top:20px;">
                    <div class="form-group">
                        <label for="id" class="col-sm-2 control-label">学生名</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="number">
                                <?php foreach ($stu as $v){?>
                                    <option value="<?php echo $v['number']?>">
                                        <?php echo $v['name'];?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id" class="col-sm-2 control-label">课程名</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="c_id">
                                <?php foreach ($course as $v){?>
                                    <option value="<?php echo $v['c_id']?>">
                                        <?php echo $v['c_name'];?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sc" class="col-sm-2 control-label">成绩</label>
                        <div class="col-sm-9">
                            <input type="text" name="score" class="form-control" id="sc" required>
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
<script>
    var course = document.getElementById('xuanze');
    console.log(course);
    course.onchange = function(){
        location.href = 'score_list.php?c_id='+course.value;
        console.log('nihao');
    }
</script>