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

 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.

 **************************************************************************/

if(!defined('CHMOD_ROLLER')) exit('权限不足!');

class index{

    public function __construct() {

    }

    public function start($dataArr) {
        // var_dump($dataArr);
        // echo $dataArr['test']."<hr>";

        echo '<img src="'.system::load_storage('RollerPHP_small.png').'" />';
        echo '<h1>欢迎使用RollerPHP框架!</h1><br>作者:NumberWolf<br>邮箱:porschegt23@foxmail.com';
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
        echo system::drawViews('index',$result_arr)."<br>这是一个模型html渲染实例";

    }

    public function uploadFile($dataArr) {
        // var_dump($dataArr);

        if (count($dataArr['upload_error']) <= 0) {
            echo "上传成功";
        } else {
            echo var_dump($dataArr['upload_error']);
        }
    }

    public function func() {
        system::test();
    }

    // 渲染html
    public function testDrawView() {
        $modelArr = array(array('hello' => 'RollerPHP', 'name' => 'myname', 'sex' => 'boy' ),array('hello' => 'RollerPHP2', 'name' => 'myname2', 'sex' => 'boy2' ));

        echo system::drawViews('index',$modelArr)."<br>这是一个html渲染实例";
    }

    public function hello () {
        echo "<h1>hello RollerPHP</h1>";
    }
}
?>
