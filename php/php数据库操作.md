## 数据库基本操作语句

1. 创建数据库
```sql
CREATE DATABASE person;
```

2. 删除数据库
```sql
DROP DATABASE person;
``` 

3. 创建一个数据表
```sql
CREATE TABLE teacher(
    id INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255),
    lastName VARCHAR(255),
    email VARCHAR(255),
    city VARCHAR(255),
    PRIMARY KEY(id)
);
```

4. 往数据表插入一条数据

```sql
INSERT INTO teacher (firstName,lastName,email,city) VALUES('jimson','zhu','18198936160@163.com','guangdongguangzhou');
```

5. 更新一条数据表数据
```sql
UPDATE teacher SET email = '870255589@qq.com',firstName = 'Tim' WHERE id = 1;
```

6. 删除数据表数据

```sql
DELETE FROM teacher;  //删除表里所有数据
 
DELETE FROM teacher WHERE id = 1;
 
DELETE FROM teacher WHERE id = 1 AND firstName = 'jimson';
```

7. 查询数据

```sql
SELECT * FROM teacher;  //整表数据
 
SELECT * FROM teacher WHERE id = 1;//一行数据
 
SELECT firstName,email FROM teacher WHERE id = 1;//两格数据
 
SELECT firstName,email FROM teacher ORDER BY id;  //根据id排一下序
 
SELECT firstName,email FROM teacher ORDER BY id DESC;  //降序排序
 
SELECT firstName,email FROM teacher ORDER BY id ASC;  //升序排序
```

## php代码进行数据库操作

1. 连接数据库

```php
$mysqli = mysqli("localhost","root","password",person);
// 主机名（地址）、用户名、密码、数据库名
```

2. 判断连接是否成功

```php
// 判断错误码，只要不为0即为连接失败，需要断开连接
if($mysqli->connect_errno){
    die($mysqli->connect_error);  //断开连接并打印错误信息
);
```

3. 开始操作数据库

```php
$result = $mysqli->query("INSERT INTO teacher (firstName,lastName,email,city) VALUES('jimson','zhu','18198936160@163.com','guangdongguangzhou')");
```

插入的数据是中文，需要指定编码格式
```php
$mysqli->query("set names utf8");
 
$result = $mysqli->query("INSERT INTO teacher (firstName,lastName,email,city) VALUES('中文测试','zhu','18198936160@163.com','guangdongguangzhou')");
```

4. 判断操作是否成功

```php
if($result){
    echo "插入成功";
}else{
    echo "插入失败";
}
```

5. 关闭数据库连接

```php
$mysqli->close();
```

## php完整数据操作代码封装

- 数据插入
```php
function insertData($sql) {
    $mysqli = mysqli("localhost","root","password",person);
 
    if($mysqli->connect_errno){
        die($mysqli->connect_error);
    );
 
    $mysqli->query("set names utf8");
 
    $result = $mysqli->query($sql);
 
    if($result){
        echo "插入成功";
    }else{
        echo "插入失败";
    }
 
    $mysqli->close();
}
 
$sql = "INSERT INTO teacher (firstName,lastName,email,city) VALUES('中文测试','zhu','18198936160@163.com','guangdongguangzhou')";
 
insertData($sql);
```



- 数据更新
```php
function updateData($sql) {
    $mysqli = mysqli("localhost","root","password",person);
 
    if($mysqli->connect_errno){
        die($mysqli->connect_error);
    );
 
    $mysqli->query("set names utf8");
 
    $result = $mysqli->query($sql);
 
    if($result){
        echo "更新成功";
    }else{
        echo "更新失败";
    }
 
    $mysqli->close();
}
 
$sql = "UPDATE teacher SET `email` = '870255589@qq.com' WHERE id = 1";
 
updateData($sql);
```

- 数据删除
```php
function deleteData($sql) {
    $mysqli = mysqli("localhost","root","password",person);
 
    if($mysqli->connect_errno){
        die($mysqli->connect_error);
    );
 
    $mysqli->query("set names utf8");
 
    $result = $mysqli->query($sql);
 
    if($result){
        echo "删除成功";
    }else{
        echo "删除失败";
    }
 
    $mysqli->close();
}
 
$sql = "DELETE FROM teacher WHERE id = 1";
 
deleteData($sql);
```

- 数据查询  
    还需要对数据库操作返回的数据进行处理
```php
function fetchData($sql) {
    $mysqli = mysqli("localhost","root","password",person);
 
    if($mysqli->connect_errno){
        die($mysqli->connect_error);
    );
 
    $mysqli->query("set names utf8");
 
    $result = $mysqli->query($sql);
 
    // 判断查询结果是否为空
    if($result->num_rows){
        // 处理查询结果
        // 有以下几种处理方式
        // 方式一：fetch_row()  返回的是一个数组
        while($row = $result->fetch_row()){
            print_r($row);
        }
 
        // 方式二：fetch_array()
        while($row = $result->fetch_array(MYSQLI_ASSOC)){  //以下标数组形式查询
            print_r($row);
        }
 
        // 方式三：fetch_all()
        $row = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($row);  // 返回json格式数据，更有利于前端处理
    }else{
        echo "查询失败";
    }
 
    $mysqli->close();
}
 
$sql = "SELECT * FROM teacher";
 
fetchData($sql);
```