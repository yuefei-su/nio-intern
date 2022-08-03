<?php
   include_once ('./include/config.php');
//    $sql = "select * from class";
//    $class = select_all($conn,$sql);
// 添加成绩
if (isset($_POST['add'])) {
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

    // 获取传过来的id
//    if(isset($_GET['edit'])){
//      global $edit;
//      $edit = $_GET['edit'];
//      $sql = "select * from score where number =$edit";
//      $data = select_one($conn,$sql);
//    }

// 修改成绩信息
    $sql = 'select name from student where number="'.$_GET['edit'].'"';
    $stu = select_one($conn,$sql);
    $sql = 'select c_name from course where c_id="'.$_GET['c_id'].'"';
    $cou = select_one($conn,$sql);
   if(isset($_POST['commit'])){
    $data = array('score' => $_POST['score']);

    $condition = " `number` =".$_GET['edit']." and `c_id`=".$_GET['c_id'];
// var_dump($condition);die;
    $res = update($conn,'score',$data,$condition);
    if($res){
      msg_jump('成功','score_list.php');
    }else{
     msg_jump('失败');
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
                            <a class="btn btn-primary pull-left" href='score_list.php'>
                                管理成绩
                            </a>
                            <a id="add" class="btn btn-primary pull-right" data-toggle="modal" data-target=".add-model">
                                添加成绩
                            </a>
                        </h4>
                    </td>
                </tr>
            </table>   
                <form class="form-inline"  method="post">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">学生名</div>
                        <input type="text"name="name" value="<?php echo $stu['name'];?>" class="form-control"readonly >
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon">课程名</div>
                        <input type="text"name="c_name" value="<?php echo $cou['c_name'];?>" class="form-control"readonly >
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon">成绩</div>
                        <input type="text"name="score" value="<?php echo $_GET['score'];?>" class="form-control" id="exampleInputAmount" >
                    </div>
                </div>
                <button type="submit" name='commit' class="btn btn-primary">提交</button>
                </form>        
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