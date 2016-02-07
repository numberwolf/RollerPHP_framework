<?php
/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 **************************************************************************/

if(!defined('CHMOD_ROLLER')) exit('权限不足!');

class index{

    public function __construct() {

    }

    public function start($dataArr) {
        echo $dataArr[0]."<hr>";

        echo "<h1>欢迎使用rollerPHP框架!</h1><br>作者:NumberWolf<br>邮箱:porschegt23@foxmail.com";
    }

    public function tpl() {
        $title = '欢迎使用rollerPHP框架';
        $content = '这是一个模板调用Ex';
        include system::load_tpl('index');
    }

    // 模型实例 并且渲染html
    public function model(){
        $helloModel = system::load_model('hello');

        $result_arr = $helloModel->search();

        // $modelArr = $result_arr[0]; // 一条
        foreach ($result_arr as $modelArr) {
            echo system::drawViews('index',$modelArr)."<br>这是一个模型html渲染实例";
        }

    }

    public function uploadFile() {
        echo '<h1>RollerPHP:文件上传拓展</h1>'
            .'<form action="" enctype="multipart/form-data" method="post" name="uploadfile">'
            .'上传文件：<input type="file" name="upfile" /><br>'
            .'<input type="submit" value="上传" /></form>';
    }

    public function func() {
        system::test();
    }

    // 渲染html
    public function testDrawView() {
        $modelArr = array('hello' => 'RollerPHP', 'name' => 'myname', 'sex' => 'boy' );
        // var_dump($modelArr);

        echo system::drawViews('index',$modelArr)."<br>这是一个html渲染实例";
    }

    public function hello () {
        echo "<h1>hello RollerPHP</h1>";
    }
}
?>
