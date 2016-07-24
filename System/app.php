<?php
/**************************************************************************
 * 核心路由

 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 * APACHE 2.0 LICENSE
 * Copyright [2016] [Chang Yanlong]

 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

 **************************************************************************/

$app_router = \RSystem\system::load_config('config');
Roller($app_router);

function Roller($app_router) {
    $route_arr = explode("/",explode("&",explode("?",$_SERVER['REQUEST_URI'])[1])[0]);
    $route_arr = array_values(array_diff($route_arr,array(null,'','null',' ')));

    $route_home = count($route_arr)>0 ? $route_arr[0] : $app_router['home'];
    $route_control =  count($route_arr)>1 ? $route_arr[1] : $app_router['Cont'];
    $route_method = count($route_arr)>2 ? $route_arr[2] : $app_router['Meth'];
    //$route_method = preg_match('/^[a-zA-Z0-9]/' , $_GET['Meth']) ? $_GET['Meth'] : $app_router['Meth'];

    $module = CONT_PATH . '/' . $route_home;
    $controller = $module . '/' . $route_control . '.php';

    if(!is_dir($module)) die('<h1>RollerPHP: \'' . $route_home . '\' 找不到</h1>');
    if(!file_exists($controller)){
        die('<h1>RollerPHP:控制器文件 \'' . $route_control . '\' 找不到!');

    }else{

        include($controller);
        $contNameSpaceName = "\\Controller\\$route_home\\$route_control";
        // echo $contNameSpaceName;
        $ctrl = new $contNameSpaceName();

        if(!method_exists($ctrl , $route_method)){
            die('<h1>RollerPHP: \'' . $route_method . '\' 未定义</h1>');
        }else{
            $dataArr = array();

            // 把get参数载入进数组
            foreach ($_GET as $key => $value) {
                if ($key != 'Home' && $key != 'Cont' && $key != 'Meth') {
                    $dataArr[$key] = $value;
                }
            }

            // 把post参数载入
            if ($_POST) {
                foreach ($_POST as $key => $value) {
                    $dataArr[$key] = $value;
                }
            }

            if ($_FILES) {
                // var_dump($_FILES);
                /*
                array(1) { ["textFile"]=> array(5) { ["name"]=> string(19) "PoweredByMacOSX.gif" ["type"]=> string(9) "image/gif" ["tmp_name"]=> string(26) "/private/var/tmp/phpigeW2F" ["error"]=> int(0) ["size"]=> int(3726) } } 
                */
                $upload_error_arr = array();

                foreach ($_FILES as $key => $value) {

                    if ($_FILES[$key]["error"] > 0) {
                        // echo "Error: " . $_FILES[$key]["error"] . "<br />";

                        array_push($upload_error_arr, array('upload_errorMsg' => $_FILES[$key]["error"]));
                    } else {
                        $filename = '';
                        // 文件名
                        if ($_POST['filename']) {
                            $filename = $_POST['filename'];
                        } else {
                            $filename = $_FILES[$key]["name"];
                        }

                        $path = SOTRAGE_PATH .'/' . $filename;

                        if ($_POST['class']) {
                            $path = SOTRAGE_PATH .'/' .$_POST['class'].'/'.$filename;
                        }

                        $dataArr['upload_error'] = move_uploaded_file($_FILES[$key]["tmp_name"], $path);
                    }
                }
            }

            /**
             **参数以数组形式传递
             **/
            return $ctrl->$route_method($dataArr);
        }
    }
}
