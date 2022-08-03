<?php
   include_once ('./include/config.php');
   function del_path($path){
       if(file_exists($path)){
         unlink($path);
       }
   }
	// 通过get方式传过来的id查询记录
	if(isset($_GET) && !empty($_GET)){
		$id = $_GET['id'];
		$sql = "SELECT * FROM student WHERE number = $id";
        $data  = select_one($conn,$sql);
	}

    // global $data1;
	//通过post提交的信息修改记录
	if(!empty($_POST) && $_POST['sub']=='修改'){
        // var_dump($_FILES['proimg']);die;
            $number = $_POST['number'];
            $data1 = array(
                'name' => $_POST['name'],
                'age '=> $_POST['age'],
                'sex' => $_POST['sex'],
                'd_id' => $_POST['d_id'],
                'class' => $_POST['class']
            );
        if($_FILES['proimg']['error'] == 0){
            del_path($data['stu_img']);
            del_path($data['stu_thumb']);
            $up = upload('proimg');
            $img_thumb = img_thumb($up['dir'],90,90,'./thumb',$up['name']);
            $data1["stu_img"] = $up['dir'];
            $data1["stu_thumb"] = $img_thumb;
        }
// var_dump($data);die;
        $condition = " number = $number";
        $res = update($conn,'student', $data1,$condition);
		if($res){
            msg_jump("修改成功!","index.php");
		}else{
            msg_jump('修改失败!');
		}
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/animate.css" />
    <link rel="stylesheet" href="./css/css.css" />
    <link rel="stylesheet" href="./css/bootstrap-fileinput.css" />
    <link rel="icon" href="./img/logo.png" type="image/x-icon">
	<title>修改</title>
    <style>
    #uploadForm{
        margin-left:201px;
    }
    
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <a href="index.php" class='btn-lg pull-left'><span class='glyphicon glyphicon-triangle-left'></span></a>
            <h3 class="text-center">修改</h3>
            <div class="form-box">
                <form action="" method="post"  class="form-horizontal" enctype='multipart/form-data'>
                    <!--隐藏域-->
                    <input type="hidden" name="number" value="<?php echo $data['number']; ?>">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" id="name" required  value="<?php echo $data['name']; ?>">
                        </div>                       
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">性别</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input type="radio" name="sex" id="" value="1" <?php if($data['sex']==1){echo 'checked';} ?>> 男
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" id="" value="0" <?php if($data['sex']==0){echo 'checked';} ?>> 女
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-2 control-label">年龄</label>
                        <div class="col-sm-9">
                            <input type="text" name="age" class="form-control" id="age" required value="<?php echo $data['age']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="d_id" class="col-sm-2 control-label">系部</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="d_id">
                                    <option value=""></option>
                                <?php foreach ($dep as $v){?>
                                    <option value="<?php echo $v['d_id']?>"
                                    <?php if($v['d_id'] == $data['d_id']){echo "selected='selected'";} ?>
                                    ><?php echo $v['d_name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="class" class="col-sm-2 control-label">班级</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="class">
                                    <option value=""></option>
                                <?php foreach ($class as $v){?>
                                    <option value="<?php echo $v['id']?>" 
                                    <?php if($v['id'] == $data['class']){echo "selected='selected'";} ?>
                                    ><?php echo $v['c_name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <!-- //图片预览插件 -->
            <div class="form-group" id="uploadForm" >
                <div class="h4">图片预览</div>
                <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                    <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                        <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" 
                        src="<?php echo isset($data['stu_img'])?$data['stu_img']:'img/noimage.png';?>" alt="" />
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
                        <a type="button" class="btn btn-default" data-dismiss="modal" href="index.php">返回</a>
                        <input type="submit" name='sub' value ='修改' class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/bootstrap-fileinput.js"></script>
