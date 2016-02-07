<?php
/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 * 这是一个控制器例子
 **************************************************************************/

if(!defined('CHMOD_ROLLER')) exit('权限不足!');

class index{

    public function __construct() {

    }

    public function start($dataArr) {
        // var_dump($dataArr);
        // echo $dataArr['test']."<hr>";

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

    public function uploadFile($dataArr) {
        // var_dump($dataArr);

        if (count($dataArr['upload_error']) <= 0) {
            echo "上传成功";
        }
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
