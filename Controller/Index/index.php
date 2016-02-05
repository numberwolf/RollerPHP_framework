<?php
/**
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午7:01
 */

if(!defined('CHMOD_ROLLER')) exit('权限不足!');

class index{

    public function __construct() {

    }

    public function start() {
        echo "<h1>欢迎使用rollerPHP框架!</h1><br>作者:小老虎<br>邮箱:porschegt23@foxmail.com";
    }

    public function view() {
        $title = '欢迎使用rollerPHP框架';
        $content = '这是一个模板调用Ex';
        include system::load_tpl('index');
    }

    public function model(){
        $helloModel = system::load_model('hello');

        $helloModel->search();
        // $helloModel->hellotest();

    }

    public function func() {
        system::test();
    }

    // 渲染html
    public function testDrawView() {
        $modelObj = system::load_model('hello');
        $modelArr = $modelObj::testModel();
        // var_dump($modelArr);

        echo system::drawViews('index',$modelArr)."<br>这是一个html渲染实例";
    }

    public function hello () {
        echo "hello world";
    }
}
?>
