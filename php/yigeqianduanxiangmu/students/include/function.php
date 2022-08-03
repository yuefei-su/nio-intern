<?php
/**
 * 查询单条数据
 * @param mysqli_connect $conn 连接的数据库
 * @param string $sql 查询语句
 * @param return arr $data 返回查询到的数组
 */
function select_one($conn,$sql){
    $res = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($res);
    return $data;
}

/**
 * 查询多条数据
 * @param mysqli_connect $conn 连接的数据库
 * @param string $sql 查询语句
 * @param return arr $data 返回查询到的数组
 */
 function select_all($conn,$sql){
    // 查询
    $res = mysqli_query($conn, $sql); // 参数1：链接名；参数2：sql语句
    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_object($res)) {
            $data[] = get_object_vars($row);
        }
    }
    // get_object_vars()
    return $data;
 }

 /**
 * 更新数据
 * @param mysqli_connect $conn 连接的数据库
 * @param $table 数据表名
 * @param $data 更新的字段
 * @param $condition 条件
 * @param $res 返回查询的结果
 */
function update($conn,$table, $data, $condition){
    $str = '';
    foreach($data as $k =>$v){
        $str .= "`$k`='$v',";
    }
    $str = rtrim($str,',');
    $sql = "update $table set $str where $condition";
    // var_dump($sql);die;
    // var_dump($sql);
    $res = mysqli_query($conn,$sql);
    return $res;
}


 /**
 * 弹出框，及跳转
 * @param $msg 弹出框的信息
 * @param $url 跳转的地址
 */
function msg_jump($msg,$url=''){
    if($url!=''){
        echo "<script>alert('$msg');location.href='$url';</script>";
    }else{
        echo "<script>alert('$msg');history.back(-1);</script>";
    }
}


 /**
 * 添加数据
 * @param mysqli_connect $conn 连接的数据库
 * @param $table 数据表名
 * @param $data 添加的索引数组
 */
function add($conn,$tables,$data){
    $keys_arr = array_keys($data);
    $v_arr = array_values($data);
    $k_str = implode("`,`",$keys_arr);
    $v_str = implode("','",$v_arr);

    //拼接SQL 语句
    $sql = "INSERT INTO `$tables` (`$k_str`) VALUES ('$v_str ')";
    // echo $sql;
    $result = mysqli_query($conn, $sql);
    return $result;
//     if($result && mysqli_insert_id($conn)){
//         return 1;
//     }else{
//         return 0;
//     }
}


 /**
 * 更新数据
 * @param mysqli_connect $conn 连接的数据库
 * @param $table 数据表名
 * @param $condition 条件
 * @param $res 返回查询的结果
 */
function del($conn,$table,$condition){
    $sql = "DELETE FROM $table WHERE $condition";
    $res = mysqli_query($conn, $sql);
    return $res;
}

function get_url(){
    $url = $_SERVER["PHP_SELF"].'?';
    if($_GET){
        foreach ($_GET as $k => $v){
            if($k != 'page'){
                $url .= "$k=$v&";
            }
        }
    }
    return $url;
}

/**
 * @param $current  当前的页号
 * @param $count    有多少条信息
 * @param $limit    每页显示多少条信息
 * @param $size     页码数最多显示个数
 * @param return str 返回拼接好的字符串
 */
function page($current,$count,$limit,$size){
    $str = '';
    if($count > $limit){
        $url = get_url();
        $pages = ceil($count/$limit);
        $str .= "<nav class='text-center'><ul class='pagination'>";
        $str .= "<li class='disabled'><a href='#'>总数$count</a></li>";
        if($current == 1){
            $str .= "<li class='disabled'><a href='#'>首页</a></li>";
        }else{
            $str .= "<li><a href='".$url."page=1'>首页</a></li>";
            $str .= "<li><a href='$url page=".($current-1)."' aria-label='Previous'><span aria-hidden='true'>上一页</span></a></li>";
        }

        if($current <= floor($size/2)){
            $star = 1;
            $end = $pages > $size ? $size : $pages;
        }else if($current > $pages-floor($size/2)){
            $star = $pages-$size+1 > 0 ?$pages-$size+1:1;
            $end = $pages;
        }else{
            $star = $current-floor($size/2);
            $end = $current+floor($size/2);
        }

        for($i=$star ;$i<=$end; $i++){
            if($current == $i){
                $str .= "<li class='active'><a>$i</a> </li>";
            }else{
                $str .= "<li><a href='".$url."page=$i'> $i</a></li>";
            }
        }

        //尾页
        if($current == $pages){
            $str .= "<li class='disabled'><a href='#'>尾页</a></li>";
        }else{
            $str .= "<li><a href='".$url."page=".($current+1)."' aria-label='Next'><span aria-hidden='true'>下一页</span></a></li>";
            $str .= "<li><a href='".$url."page=".$pages."'>尾页</a></li>";
        }
        $str .= "</ul></nav>";
    }
    return $str;
}

/**
 * 上传图片的函数
 * @param $name file名字
 * @param $path 存入的路径
 * @param $path 可选，文件大小，默认1m
 * @param $path 可选，文件类型，暂时不起作用
 * @return $res 数组，存放了是否成功的msg，存放路径dir，文件名字name
 * 错误信息error=1 出错了，相应的msg有不同信息
 *              2   为上传成功
 */
function upload($name,$path='./uploads/',$size='1048576',$type=array('jpeg','jpg','png','gif')){
    $error = $_FILES[$name]['error'];
    if($error > 0){
        switch($error){
            case 1:
            case 2:
                $res['msg'] = "文件太大！！";
                break;
            case 3:
                $res['msg'] = "网络错误！！！";
                break;
            case 4:
                $res['msg'] =  "没有上传文件！！！";
                break;
            case 6:
                $res['msg'] =  "找不到文件！！！";
                break;
            default:
                $res['msg'] =  "其他错误！！！";
                break;
        }
        $res['error'] = 1;//规定1为出错代码
        return $res;
    }
    if($_FILES[$name]['size'] > $size){
        $res['msg'] = "文件超过规定大小！请重新上传!!";
        $res['error'] = 1;
        return $res;
    }

    $path_arr = pathinfo($_FILES[$name]['name']);
    $ext = $path_arr['extension'];
    if(!in_array($ext,$type)){
        $res['msg'] = '文件类型错误，请重新上传';
        $res['error'] = 1;
        return $res;
    }

    //存入目录
    $date = date("Y-m-d",time());
    $dir = rtrim($path,'/').'/'.$date;
    if(!is_dir($dir)){
        mkdir($dir,0777,true);
    }
    $file_name = time().mt_rand(0,9999).'.'.$ext;//文件名字
    // 保存到目录中
    $re =  move_uploaded_file($_FILES[$name]['tmp_name'],$dir.'/'.$file_name); 
    if($re){
        $res['msg'] = '成功上传图片';
        $res['error'] = 2;
        $res['dir'] = $dir.'/'.$file_name;
        $res['name'] = $file_name;
        return $res;
    }
}

/**
 * @param $src_addr 原图片的路径
 * @param $des_w    缩略图的宽度
 * @param $path     缩略图的存放路径
 * @param $thumb_name   原图的名字也是缩略图的名字
 * @return string
 */
function img_thumb1($src_addr,$path,$thumb_img,$des_w=100){
    $src_info = getimagesize($src_addr);
    $src_w = $src_info[0];
    $src_h = $src_info[1];
    $des_h = $src_w*$des_w/$src_h;
    if($src_info[2] == 1){
        $des_img = imagecreatefromgif($src_addr);
    }else if($src_info[2] == 2){
        $des_img = imagecreatefromjpeg($src_addr);
    }else if($src_info[2] == 3){
        $des_img = imagecreatefrompng($src_addr);
    }

    $img_new = imagecreatetruecolor($des_w,$des_h);

    imagecopyresized($img_new,$des_img,0,0,0,0,$des_w,$des_h,$src_w,$src_h);

 // fill the background color
 $bg  =  imagecolorallocate ( $img_new ,  255 ,  255 ,  255 );

//  // choose a color for the ellipse
//  $img_new  =  imagecolorallocate ( $image ,  255 ,  255 ,  255 );

 // draw the white ellipse
 imagefilledellipse ( $bg,  $des_w/2 ,  $des_h/2 ,  30 ,  20 , $img_new );

    //存入目录
    $date = date("Y-m-d",time());
    $dir = rtrim($path,'/').'/'.$date;
    if(!is_dir($dir)){
        mkdir($dir,0777,true);
    }

    //7. 保存图片
    $thumb_path =$dir.'/thumb_'.$thumb_img;
    imagejpeg($img_new,$thumb_path,80);

    //8. 释放内存
    imagedestroy($img_new);
    return $thumb_path;
}


function img_thumb($src_addr,$des_w=100,$des_h=100,$path,$thumb_img){
    $src_info = getimagesize($src_addr);
    $src_w = $src_info[0];
    $src_h = $src_info[1];

    if($src_info[2] == 1){
        $des_img = imagecreatefromgif($src_addr);
    }else if($src_info[2] == 2){
        $des_img = imagecreatefromjpeg($src_addr);
    }else if($src_info[2] == 3){
        $des_img = imagecreatefrompng($src_addr);
    }

    $img_new = imagecreatetruecolor($des_w,$des_h);

    imagecopyresized($img_new,$des_img,0,0,0,0,$des_w,$des_h,$src_w,$src_h);

    // $ext = phpinfo($src_addr,PATHINFO,EXTENSION);

    //存入目录
    $date = date("Y-m-d",time());
    $dir = rtrim($path,'/').'/'.$date;
    if(!is_dir($dir)){
        mkdir($dir,0777,true);
    }

    //7. 保存图片
    $thumb_path =$dir.'/thumb_'.$thumb_img;
    imagejpeg($img_new,$thumb_path,80);

    //8. 释放内存
    imagedestroy($img_new);
    return $thumb_path;
}
?>