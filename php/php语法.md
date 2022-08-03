
## 数组
```php
// 创建数组
$arr = ["","",""];
$arr = array("","","");
$arr = array(array("jim","bob"),array(1,22));

// 创建关联数组
$arr["Bob"] = 27;
$arr =array("Bob" => 26,"Jim" => 23);

// 打印数组
print_r(数组)
// 万能打印方法：打印的信息更详细，但不常用。
var_dump(数组)


// 循环遍历
foreach(数组 as item){
    echo item;
}

// 循环关联数组
foreach(数组 as key => value){
    echo key.":".value;
}
```

## 函数
- **Camel Case：小驼峰命名法**，myFunction()
- Lower Case：下划线命名法，my_function()
- Pascal Case：大驼峰命名法，MyFunction()
```php
// 函数定义调用，传参
function testName($paramsName){
    return $paramsName*2;
}
 
testName(3);
```

```php
// 函数定义调用，默认传参
function testName($name = "jimson"){
    echo "Hello $name";
}
 
testName();

```

```php
$testValue = 10;
 
//  传值
function addFive($num){
    $num += 5;
}
 
//  传地址
function addTen(&$num){
    $num += 10;
}
 
addFive($testValue);
echo $testValue;
// 10
 
addTen($testValue);
echo $testValue;
// 20
```


## 字符串函数

- substr()：返回字符串的一部分
```php
//例一：返回从1号位置到后面的字符
echo substr("hello",1);
//结果：ello
 
//例二：返回一号位置到三号位置的字符
echo substr("hello",1,3);
//结果：ell
 
//例三：返回后两位字符
echo substr("hello",-2);
//结果：lo
```

- strlen()：返回字符串长度
```php
echo strlen("hello");
// 结果：5
```

- strpos()：查找字符串中某字符（串）第一次出现的位
```php
echo strpos("hello world","o");
//结果：4
```

- strrpos()：查找字符串中某字符（串）最后一次出现的位置
```php
echo strrpos("hello world","o");
//结果：7
```

- trim()：去除首尾空格
```php
var_dump(trim("hello world      "));
//结果：11
```

- str_replace()：替换字符串中所匹配的内容
```php
echo str_replace("world","jimson","hello world");
//结果：hello jimson
```

- 字符串大小写转换
```php
echo strtoupper("hello");
//结果：HELLO

echo strtolower("HELLO");
//结果：hello

echo ucwords("hello world");
//结果：Hello World
```

- is_string()：判断是不是字符串
```php
echo is_string("jimson");
//结果：1
// 返回1说明是字符串，不返回任何内容说明不是字符串。这一方法常常结合循环结构（foreach）去过滤数组中的非字符串的值。
```

- 解、压缩字符串
```php
echo gzcompress("sjdkfjskdjfskfjks");
//结果：压缩，是一堆乱码。

echo gzuncompress(gzcompress("sjdkfjskdjfskfjks"));
//结果：解压，这时候就可以将压缩过的字符串解压还原回原来的样子。
```


## 数组函数

- 添加、删除元素
```php
$array = array();
 
//array_push()：添加元素到数组末尾。
array_push($array,"hello");
//结果：往数组的末尾添加了hello。
 
//array_pop()：删除数组末尾元素。
array_pop($array);
//结果：删除了数组末尾的元素hello。
 
//array_unshift()：添加元素到数组开头。
array_unshift($array,"hello");
//结果：往数组的开头添加了hello。
 
//array_shift()：删除数组开头元素。
array_unshift($array);
//结果：删除了数组开头的元素hello。
```


- 排序
```php
$array = [1,2,15,6,33,44,5];
 
//sort()：数组排序。
print_r(sort($array));
//结果：Array([0]=>1 [1]=>2 [2]=>5 ...)
```


- 数组和字符串相互转换
```php
$array = ["hello","jim"];
 
//implode()：将数组转换成字符串。
echo implode(",", $array);
//结果：hello,jim
//说明：将数组用逗号“,”拼接为字符串。
 
 
//explode()：将字符串转换成数组。
print_r(explode(",", "hello,jim"));
//结果：Array([0] => hello  [1] => jim)
//说明：将字符串根据逗号“,”分割成数组。
```


## 三目运算符
```php
$loggedIn = false;
echo ($loggedIn) ? "you are logged in" : "you are not logged in";
```


## 循环语法糖
```php
<div>
    <?php for($i = 0; $i < 10; $i++) ?>
        <li><?php echo $i."<br>"; ?></li>
    <?php endfor; ?>
</div>
```

```php
<?php
    $arr = ["jimson","lily","candy","alice"];
?>
 
<div>
    <?php foreach($arr as $val): ?>
        <?php echo $val."<br>"; ?>
    <?php endforeach; ?>
</div>
```


