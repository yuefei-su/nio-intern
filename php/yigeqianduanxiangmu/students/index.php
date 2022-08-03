<?php
   include_once ('./include/config.php');
   
    // 编写sql语句
    // $sql = "SELECT * FROM student AS stu left JOIN department AS dep ON stu.d_id = dep.d_id left JOIN class ON stu.class = class.id";
    // $data = select_all($conn, $sql);

    // var_dump($data);
    if (isset($_POST) && !empty($_POST)) {
        // var_dump($_FILES);die;
        $up = upload('proimg');
        $img_thumb = img_thumb($up['dir'],90,90,'./thumb',$up['name']);
        $data1 = array(
            "name" => $_POST['name'],
            "sex" => $_POST['sex'],
            "age" => $_POST['age'],
            "d_id" => $_POST['d_id'],
            "class" => $_POST['class'],
            "stu_img" => $up['dir'],
            "stu_thumb" => $img_thumb
        );
        $res1 = add($conn,'student',$data1);
        if ($res1) {
            msg_jump("添加成功","index.php");
        } else {
            msg_jump("添加失败");
        }
    }

    //删除记录
    if (!empty($_GET) && isset($_GET['id'])) {
        $co = "number = ".$_GET['id'];
        $res = del($conn,'student',$co);
        if ($res) {
            msg_jump("删除成功!","index.php");
        } else {
            msg_jump("删除失败!");
        }
    }

    // 上传头像图片
    // if(isset($_POST['imgadd'])){
        
    //     if($res){
    //         msg_jump('成功','index.php');
    //     }else{
    //         msg_jump('失败');
    //     }
    // }


    //分页
    if(isset($_GET['page'])){
        $current = $_GET['page'];
    }else{ $current = 1;}
    $limit = 3;
    $n = ($current-1)*$limit;
    $sql = "select * FROM student AS stu left JOIN department AS dep ON stu.d_id = dep.d_id 
    left JOIN class ON stu.class = class.id order by stu.number limit $n,$limit";
    $data = select_all($conn,$sql);

    $count_sql = "select count(number) from student";
    $c = select_all($conn,$count_sql);
    // var_dump();count($c);
    $count = $c[0]['count(number)'];
    $size = 5;

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
    <link rel="stylesheet" href="./css/bootstrap-fileinput.css" />
    <link rel="stylesheet" href="./css/animate.css" />
    <title>学生管理系统</title>
    <style>
        .titles>th{text-align: center;}
        table td{vertical-align: middle!important;}
        .add-touxiang .form-group,#uploadForm{margin-left:50px;}
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <h2 class="text-center text-primary">学生管理系统</h2>
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <td colspan="8">
                        <h4>
                            <a class="btn btn-primary pull-left disabled" href='index.php'>
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
                            <a class="btn btn-primary pull-right" data-toggle="modal" data-target=".add-model">
                                添加学生
                            </a>
                        </h4>
                    </td>
                </tr>
                <tr class="titles">
                    <th>头像</th>
                    <th>id</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>年龄</th>
                    <th>系部</th>
                    <th>班级</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($data as $value) { ?>
                    <tr align="center">
                        <td><img class="img-circle" src="<?php echo file_exists($value['stu_thumb'])? $value['stu_thumb']:' '; ?>" alt=""></td>
                        <td><?php echo $value['number']; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo ($value['sex'] == 1) ? '男' : '女'; ?></td>
                        <td><?php echo $value['age']; ?></td>
                        <td><?php echo $value['d_name']; ?></td>
                        <td><?php echo $value['c_name']; ?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="update.php?id=<?php echo $value['number']; ?>">修改</a>
                            <a class="btn btn-sm btn-warning del" onclick="return confirm('确定删除吗？');" href="?id=<?php echo $value['number']; ?>" >删除</a>                           
                            <!-- <a class="btn btn-primary" data-toggle="modal" data-target=".add-touxiang">
                                上传头像
                            </a> -->
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <!-- 分页 -->
            <nav aria-label="Page navigation" style="margin:auto;">
                <ul class="pagination">
                   <?php echo page($current,$count,$limit,$size,'Gray');?>
                </ul>
            </nav>
        </div>        
    </div>
    
    <!-- 添加学生模态框 -->
    <div class="modal fade add-model"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static"  data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加学生</h4>
                </div>             
                <form action="" method="post" class="form-horizontal" style="margin-top:20px;" enctype='multipart/form-data'>                   
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>                       
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">性别</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" name="sex" id="" value="1" checked> 男
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" id="" value="0"> 女
                            </label>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-2 control-label">年龄</label>
                        <div class="col-sm-9">
                            <input type="text" name="age" class="form-control" id="age" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="d_id" class="col-sm-2 control-label">系部</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="d_id">
                                <?php foreach ($dep as $v){?>
                                    <option value="<?php echo $v['d_id'];?>"><?php echo $v['d_name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="class" class="col-sm-2 control-label">班级</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="class">
                                <?php foreach ($class as $v){?>
                                    <option value="<?php echo $v['id']?>"><?php echo $v['c_name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <!-- //图片预览插件 -->
            <div class="form-group " id="uploadForm" >
                <div class="h4">图片预览</div>
                <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                    <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                        <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="img/noimage.png" alt="" />
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                    <div>
                        <span class="btn btn-primary btn-file">
                            <span class="fileinput-new">选择文件</span>
                            <span class="fileinput-exists">换一张</span>
                            <input type="file" name="proimg" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                        </span>
                        <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                    </div>
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
    <!-- 上传头像模态框 -->
    <!-- <div class="modal fade add-touxiang"  tabindex="2" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static"  data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">上传头像</h4>
                </div>             
                <form action="" method="post" class="form-horizontal" style="margin-top:20px;"enctype='multipart/form-data'>                   
               //图片预览插件
            <div class="form-group" id="uploadForm" >
                <div class="h4">图片预览</div>
                <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                    <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                        <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="img/noimage.png" alt="" />
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                    <div>
                        <span class="btn btn-primary btn-file">
                            <span class="fileinput-new">选择文件</span>
                            <span class="fileinput-exists">换一张</span>
                            <input type="file" name="proimg" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                        </span>
                        <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                    </div>
                </div>
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <input type="submit" name='imgadd' class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/bootstrap-fileinput.js"></script>
</body>
</html>