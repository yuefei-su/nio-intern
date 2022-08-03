## 文件引入

- include引入时，即使此时引入出错也不会影响后面的代码执行，只是当前引入语句报错；include则是引入几次就输出几次：
- require则不同，一旦报错则下面的代码都不会执行。
```php
<?php include "inc/header.php" ?>
    <h1>Home</h1>
<?php require "inc/footer.php" ?>
```

## 混合html写法
```php
<div>
    <?php if ($loggedIn) { ?>
        <h1>welcome to php world!</h1>
    <?php } else{ ?>
        <h1>hello you guys.</h1>
    <?php } ?>
</div>
```

```php
<div>
    <?php if ($loggedIn): ?>
        <h1>welcome to php world!</h1>
    <?php else: ?>
        <h1>hello you guys.</h1>
    <?php endif; ?>
</div>
```

## php预定义变量

1. 服务器信息获取
- 获取主机名：`$_SERVER["SERVER_NAME"]`;
- 获取服务器软件信息：`$_SERVER["SERVER_SOFTWARE"]`;
- 获取服务器文件（向客户端返回的文件）根路径：`$_SERVER["DOCUMENT_ROOT"]`;
- 获取http主机名，结果和获取主机名一样：`$_SERVER["HTTP_HOST"]`;
- 获取当前脚本（执行该\$_SERVER[......]语句所在的php文件）的路径：`$_SERVER["SCRIPT_NAME"]`;
- 获取当前脚本的绝对路径：`$_SERVER["SCRIPT_FILENAME"]`;
- 获取当前页面路径，结果和\$_SERVER["SCRIPT_NAME"]一样：`$_SERVER["PHP_SELF"]`;


2. 客户端信息获取
- 获取客户端信息，一般是浏览器信息：`$_SERVER["HTTP_USER_AGENT"]`;
- 获取客户端协议头信息：`$_SERVER["REMOTE_ADDR"]`;
- 获取客户端端口号：`$_SERVER["REMOTE_PORT"]`;

```php
<?php 
    if(isset($_GET["name"])){
        echo $_GET["name"];
    }
    if(isset($_POST["name"])){
        echo $_POST["name"];
    }
    if(isset($_REQUEST["name"])){
        echo $_REQUEST["name"];
    }
?>
```


## 面向对象

- 类、对象
```php
class Person {
    # 属性
    private $name = "cercy";
    public $sex = "girl";
    protected $height = 1.88;
 
    # 方法
    public function setName($name){
        $this->name = $name;
    }
 
    public function getName(){
        return $this->name;
    }
}
 
# 实例化一个对象
$myObject = new Person();
echo $myObject->name;
//private修饰的属性在类外部不能访问，所以$myobject->name会报错
 
echo $myObject->getName();
```

- 构造函数
```php
class Person {
    private $name = "jimson";
    public $sex = "boy";
 
    public function getName(){
        return $this->$name;
    }
 
    public function __construct($name,$sex){
        $this->$name = $name;
        $this->$sex = $sex;
    }
}
 
$newObj = new Person("Tim","girl");
```


- 析构函数：自动执行的函数，用于实例化对象之后将类销毁。
```php
class Person {
    # ……
    public function __destruct(){
        echo __CLASS__."被销毁了";
    }
}
 
$newObj = new Person("Tim","girl");
```

- 继承：可以通过关键字extends来定义类，被继承的类叫父类，以此继承父类的非private属性和方法。
```php
class Person {
    private $name = "jimson";
    public $sex = "boy";
 
    public function getName(){
        return $this->$name;
    }
 
    public function __construct($name,$sex){
        $this->$name = $name;
        $this->$sex = $sex;
    }
}
 
class Teacher extends Person{
    public $salary = "3000";
 
    public function teachStudent(){
        echo "传授学生知识";
    }
}
 
$teacher = new Teacher("james","boy");
# 调用父类的方法
$teacher->getName();
# 调用自己的方法
$teacher->teachStudent();
```


子类也可以用自己的构造函数，同时调用父类的构造函数。
```php
class Person {
    private $name = "jimson";
    public $sex = "boy";
 
    public function getName(){
        return $name;
    }
 
    public function __construct($name,$sex){
        $this->$name = $name;
        $this->$sex = $sex;
    }
}
 
class Teacher extends Person{
    public $salary = "3000";
 
    public function getSalary(){
        return $this->$salary;
    }
 
    public function __construct($name,$sex,$salary){
        # 调用父类的构造函数
        parent::__construct($name,$sex);
        $this->$salary = $salary;
    }
}
 
$teacher = new Teacher("james","boy","10000");
echo $teacher->getName();  //james
echo $teacher->getSalary();  //10000
```














