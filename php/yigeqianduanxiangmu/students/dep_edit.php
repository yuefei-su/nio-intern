<?php
   include_once ('./include/config.php');
//    $sql = "select * from class";
//    $class = select_all($conn,$sql);

// 添加院系
    if (isset($_POST['add'])) {
        $data = array(
            'id' => $_POST['id'],
            'd_name' => $_POST['name'],
            'd_manage' => $_POST['manage'],
            'd_phone' => $_POST['phone']
        );
        $res = add($conn,'department',$data);
        if($res){
            msg_jump('成功');
        }else{
            msg_jump('失败');
        }
    }
    // 获取传过来的id
   if(isset($_GET['edit'])){
     global $edit;
     $edit = $_GET['edit'];
     $sql = "select * from department where d_id =$edit";
     $data = select_one($conn,$sql);
   }
// 修改院系信息
   if(isset($_POST['commit'])){
    $data = array(
        'd_name' => $_POST['name'],
        'd_manage' => $_POST['manage'],
        'd_phone' => $_POST['phone']
    );
    $condition = "d_id =$edit";
    $res = update($conn,'department',$data,$condition);
    if($res){
      msg_jump('成功','dep_list.php');
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
                            <a class="btn btn-primary pull-left" href='dep_list.php'>
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
            </table>   
                <form class="form-inline"  method="post">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">院系名称</div>
                        <input type="text"name="name" value="<?php echo $data['d_name']?>" class="form-control" id="exampleInputAmount" >
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon">院长</div>
                        <input type="text"name="manage" value="<?php echo $data['d_manage']?>" class="form-control" id="exampleInputAmount" >
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon">院系电话</div>
                        <input type="text"name="phone" value="<?php echo $data['d_phone']?>" class="form-control" id="exampleInputAmount" >
                    </div>
                </div>
                <button type="submit" name='commit' class="btn btn-primary">提交</button>
                </form>        
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
                            <input type="text" name="id" class="form-control" id='id' placeholder='可选，不可以填已存在的' >
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