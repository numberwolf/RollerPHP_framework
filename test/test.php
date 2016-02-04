<?php
/**
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午3:14
 * 模板
 */
header('content-type:text/html;charset=utf-8');
require_once 'test.class.php';
$thetest = "test";
$testObj = new $thetest();

$path = 'test.html';

$replaceArr = array("hello" => "myworld" ,"name" => "myname" ,"sex" => "boy");

$content = $testObj->drawViews($path,$replaceArr);
echo $content."<br>";

//$str = "{{a}}{{a}}{{b}}";
//echo $testObj::replace_to("tihuan/",$str);

function mytest($a = 1) {
    echo $a;
}

mytest(2);
echo "<br>";
mytest();



 ob_start();//开启缓冲区
 echo "这是第一次输出内容!\n";
 $ff[1] = ob_get_contents() ; //获取当前缓冲区内容
 ob_flush();//缓冲器清除
 echo "这是第二次输出内容!\n";
 $ff[2] = ob_get_contents() ; //获取当前缓冲区内容
 echo "这是第三次输出内容!\n";
 $ff[3] = ob_get_contents() ; //获取当前缓冲区内容

echo "<pre>";
print_r($ff);