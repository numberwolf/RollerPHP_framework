<?php

/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 * 这是一个控制器例子
 * APACHE 2.0 LICENSE
 * Copyright [2016] [Chang Yanlong]

 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0
 **************************************************************************/
namespace Controller\Index;

if(!defined('CHMOD_ROLLER')) exit('权限不足!');

class index{

    public function __construct() {
        // echo __METHOD__;
    }

    public function start($dataArr) {
        // var_dump($dataArr);
        // echo $dataArr['test']."<hr>";

        echo '<img src="'.\RSystem\system::load_storage('RollerPHP_small.png','temp').'" />';
        echo '<h1>欢迎使用RollerPHP框架!</h1><br>作者:NumberWolf<br>邮箱:porschegt23@foxmail.com';
    }



    public function tpl() {
        $title = '欢迎使用rollerPHP框架';
        $content = '这是一个模板调用Ex';
        include \RSystem\system::load_tpl('index');
    }

    // 模型实例 并且渲染html
    public function model(){
        $helloModel = \RSystem\system::load_model('hello'); 

        $result_arr = $helloModel->search();// 从数据库搜索查询
        /**
        数据格式: [{ 
            [0]=> array(4) {
                ["hello"]=> string(5) "hello" 
                ["name"]=> string(4) "name" 
                ["sex"]=> string(3) "sex" 
                [" boy "]=> string(5) " boy " 
            } 
            [1]=> array(4) { 
                ["hello"]=> string(5) "hello" 
                ["name"]=> string(4) "name" 
                ["sex"]=> string(3) "sex" 
                [" boy "]=> string(5) " boy "  
            }
        }]
        **/
        //echo \RSystem\system::drawViews('index',$result_arr)."<br>这是一个模型html渲染实例";

    }

    public function func() {
        \RSystem\system::test();
    }

    // 渲染html
    public function testDrawView() {
        $modelArr = array(array('hello' => 'RollerPHP', 'name' => 'myname', 'sex' => 'boy' ),array('hello' => 'RollerPHP2', 'name' => 'myname2', 'sex' => 'boy2' ));

        echo \RSystem\system::drawViews('index',$modelArr)."<br>这是一个html渲染实例";
    }

    // 上传文件html
    public function testUploadView() {
        echo \RSystem\system::drawViews('upload');
    }

    public function testPostView() {
        echo \RSystem\system::drawViews('test');
    }

    // 上传文件结果回调
    public function uploadFile($dataArr) {

        if (count($dataArr['upload_error']) <= 0) {
            echo "上传成功";
        } else {
            echo var_dump($dataArr['upload_error']);
        }
    }

    public function textPost($dataArr){
        var_dump($dataArr);
    }

    public function hello() {
        echo "<h1>hello RollerPHP</h1>";
    }
}
?>
