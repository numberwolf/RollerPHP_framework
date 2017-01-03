<?php
/**************************************************************************
 * * 核心路由

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
namespace RSystem;

header('content-type:text/html;charset=utf-8');
header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
header('Pragma: no-cache');

if(!defined('CHMOD_ROLLER'))            define('CHMOD_ROLLER',       TRUE);

/*框架目录 如果URL需要展示则配置，看需求*/
define('ROLLER_PATH',                   dirname(dirname(__FILE__)));
/*项目名称*/
define('PROJECT_NAME',                  str_replace('/','',str_replace(dirname(ROLLER_PATH),'',ROLLER_PATH)));

/*储存器名字*/
define('SOTRAGE_NAME',                  'Storage');
/*核心文件名字*/
define('SYSTEM_NAME',                   'System');
/*函数名字*/
define('FUNC_NAME',                     'functions');
/*框架核心类库文件名字*/
define('CLASSES_NAME',                  'classes');
/*配置文件名字*/
define('CONF_NAME',                     'Configs');
/*控制器名字*/
define('CONT_NAME',                     'Controller');
/*模型名字*/
define('MODELS_NAME',                   'Models');
/*模板名字*/
define('TEMPLATES_NAME',                'Templates');
/*视图名字*/
define('VIEWS_NAME',                    'Views');

/*储存器目录*/
define('SOTRAGE_PATH',                  ROLLER_PATH.'/'.SOTRAGE_NAME);
/*核心文件目录*/
define('SYSTEM_PATH',                   ROLLER_PATH . '/'.SYSTEM_NAME);
/*函数目录*/
define('FUNC_PATH',                     SYSTEM_PATH . '/'.FUNC_NAME);
/*框架核心类库文件目录*/
define('CLASSES_PATH',                  SYSTEM_PATH . '/'.CLASSES_NAME);
/*配置文件目录*/
define('CONF_PATH',                     ROLLER_PATH . '/'.CONF_NAME);
/*控制器目录*/
define('CONT_PATH',                     ROLLER_PATH . '/'.CONT_NAME);
/*模型目录*/
define('MODELS_PATH',                   ROLLER_PATH . '/'.MODELS_NAME);
/*模板目录*/
define('TEMPLATES_PATH',                ROLLER_PATH . '/'.TEMPLATES_NAME);
/*视图目录*/
define('VIEWS_PATH',                    ROLLER_PATH . '/'.VIEWS_NAME);
/*PDO数据库操作 config*/
define('DB_CONFIG_NAME',                'db');

/*数据模型 命名空间前缀*/
define('MODELS_NAMESPACE',              'Models');


final class system {

    private static $RootPath_URL = null;

    public static function init() {
        // self::load_func('app');
        return include_once('app.php');
    }

    public static function load_config($configName) {

        $file = CONF_PATH . '/' . $configName . '.php';

        if(!file_exists($file)){
            die('<h1>RollerPHP:配置文件 \'' .$configName. '\' 不存在</h1>');
        }else{
            return include($file);
        }
    }

    public static function load_storage($fileName, $class = '', $path = null) {

        if(null == $path) {
            $file_path = (UNSHOW_PRONAME==false?(PROJECT_NAME.'/'):'').SOTRAGE_NAME;
        } else {
            $file_path = $path.'/'.(UNSHOW_PRONAME==false?(PROJECT_NAME.'/'):'').SOTRAGE_NAME;
        }

        if ($class != '') {
            $f_path = $file_path.'/'.$class;
        }

        return 'http://'.$_SERVER['HTTP_HOST'].'/'.$f_path.'/'.$fileName;
    }

    public static function load_pdo($database = '' ,$memSwitch = false , $memPort=11111,$memName = 'memcache' ,$memPath = '') {

        $db_config_arr = self::load_config(DB_CONFIG_NAME);
        // $path = CLASSES_PATH.'/'.DB_CONFIG_NAME.'.class.php';
        // include($path);

        $DBname = null;

        if ($database == '') {
            $DBname = $db_config_arr['DBNAME'];
        } else {
            $DBname = $database;
        }

        $DBip = $db_config_arr['DBHOST'];
        $DBuser = $db_config_arr['DBUSER'];
        $DBpwd = $db_config_arr['DBPASS'];
        $DBCLASS = DB_CONFIG_NAME;

        return new $DBCLASS($DBname, $DBip, $DBuser, $DBpwd, $memSwitch, $memPort, $memName, $memPath);
    }

    public static function load_class($className , $path = '' , $init = 1) {
        $file = '';
        if('' == $path) {
            $file = CLASSES_PATH. '/' . $className . '.class.php';
        } else {
            $file = CLASSES_PATH.'/'.$path . '/' . $className . '.class.php';
        }

        if(!file_exists($file)){
            die('<h1>RollerPHP:class \'' . $className . '\' 不存在</h1>');

        }else{

            include_once($file);

            if($init == 1){
                return new $className(); // include , new
            }else{
                return true; // include
            }
        }
    }

    public static function load_model($modelName, $path = '') {

        $file = '';

        if('' == $path) {
            $file = MODELS_PATH.'/' . $modelName . '.model.php';
        } else {
            $file = MODELS_PATH.'/'.$path . '/' . $modelName . '.model.php';
        }

        // echo $file;

        if(!file_exists($file)) {
            die('<h1>RollerPHP:model \'' . $modelName . '\' 不存在</h1>');
        } else {
            include_once($file);
            return new $modelName();
        }
    }



    public static function load_tpl($tplName , $style = 'default') {

        $tplFile = TEMPLATES_PATH . '/' . $style . '/' . $tplName . '.tpl.php';

        if(!file_exists($tplFile) ){
            die('<h1>RollerPHP:templates/' . $style . '/' . $tplName . '.tpl.php 不存在</h1>');
        } else {
            return $tplFile;
        }
    }

    public static function load_cont($homeName, $contName ,$path = '') {

        $file = '';

        if($path == '') {
            $file = CONT_PATH.'/'.$homeName.'/'.$contName.'.php';
        } else {
            $file = CONT_PATH.'/'.$path.'/'.$homeName.'/'.$contName.'.php';
        }

        if(!file_exists($file)) {
            die('<h1>RollerPHP:Controller \'' . $contName . '\' 不存在</h1>');
        }else{
            include_once($file);
        }
    }


    public static function load_func($funcName , $path = '') {

        $file = '';

        if($path == '') {
            $file = FUNC_PATH.'/' . $funcName . '.func.php';
        } else {
            $file = FUNC_PATH.'/'.$path.'/' . $funcName . '.func.php';
        }

        if(!file_exists($file)) {
            die('<h1>RollerPHP:function \'' . $funcName . '\' 不存在</h1>');
        }else{
            include_once($file);
        }
    }

    /***********
     ***********
     渲染视图引擎  采用{{.*}} $dataArray
     $dataArray 数据格式

        $returnArr : ArrayObject
         [{ 
            [0]=> array(4) {
                [0]=> string(5) "hello" 
                [1]=> string(4) "name" 
                [2]=> string(3) "sex" 
                [3]=> string(5) " boy " 
            } 
            [1]=> array(4) { 
                [4]=> string(5) "hello" 
                [5]=> string(4) "name" 
                [6]=> string(3) "sex" 
                [7]=> string(5) " boy " 
            }
        }]

     ************
     ************/
    public static function drawViews($filename,$dataArray = null,$path = '') {
        $file = '';

        if ($path == '') {
            $file = VIEWS_PATH. '/' . $filename . '.html';
        } else {
            $file = VIEWS_PATH. '/' . $path . '/' . $filename . '.html';
        }
        
        $handle = fopen($file, 'r');
        $content = '';

        while(false != ($a = fread($handle, 8080))) {//返回false表示已经读取到文件末尾
            $content .= $a; // 获取html内容
        }

        fclose($handle);

        $content = self::returnView($content);
        /**  路径 **/
        $content = self::returnMeth($content);
        $content = self::returnCont($content);
        $content = self::returnHome($content);

        if (!empty($dataArray)) {
            /**  值 **/
            $content = self::getVal($content,$dataArray); // 获得html内所有key
        }
        

        return self::replace_to_Parameter(URL_HEAD, $content, "/\{\{URL_HEAD\}\}/ism");
    }

    private static function returnView($content) {
        //VIEWS_PATH
        $regular = "/____VIEWPATH____/ism";
        $content = str_replace('____VIEWPATH____', VIEWS_NAME, $content);

        return $content;
    }

    private static function returnMeth($content) {
        $regular = "/____.*?____/ism";
        preg_match_all($regular, $content, $pathArr);

        $returnArr = array();

        foreach ($pathArr as $tempArr) {
            foreach($tempArr as $val) {
                $val = str_replace("____","",$val);
                $val = str_replace("____","",$val);

                array_push($returnArr,$val);
            }
        }

        foreach($returnArr as $key => $value) {
            $content = str_replace('____'.$value.'____', '/mt/'.$value, $content);
        }

        return $content;
    }

    private static function returnCont($content) {
        $regular = "/___.*?___/ism";
        preg_match_all($regular, $content, $pathArr);

        $returnArr = array();

        foreach ($pathArr as $tempArr) {
            foreach($tempArr as $val) {
                $val = str_replace("___","",$val);
                $val = str_replace("___","",$val);

                array_push($returnArr,$val);
            }
        }

        foreach($returnArr as $key => $value) {
            $content = str_replace('___'.$value.'___/', '/ct/'.$value, $content);
        }

        return $content;
    }

    private static function returnHome($content) {
        $regular = "/__.*?__/ism";
        preg_match_all($regular, $content, $pathArr);

        $returnArr = array();

        foreach ($pathArr as $tempArr) {

            foreach($tempArr as $val) {

                $val = str_replace("__", "", $val);
                $val = str_replace("__", "", $val);

                array_push($returnArr,$val);
            }
        }

        foreach($returnArr as $key => $value) {
			if(UNSHOW_PRONAME == false) {
            	$rootPath = dirname(ROLLER_PATH);
            	$rootPath = str_replace($rootPath,"",ROLLER_PATH);
			} else {
				$rootPath = $_SERVER['HTTP_HOST'];
			}
            $content = str_replace('__'.$value.'__/', $rootPath.'/hm/'.$value, $content);
        }

        return $content;
    }

    // 得到key
    private static function getVal($string = null,$dataArray = null) {
        preg_match_all("/\{\{.*?\}\}/ism", $string, $outArr);

        $returnArr = array();

        foreach ($outArr as $tempArr) {
            foreach($tempArr as $val) {
                $val = str_replace("{{","",$val);
                $val = str_replace("}}","",$val);

                array_push($returnArr,$val);
            }
        }

        $certainVal = $returnArr[0];
        $certainNum = null;

        foreach ($returnArr as $key => $value) {

            if ($value == $certainVal && $certainNum > 0) {
                break;
            }

            $certainNum ++;
        }

        $returnArr = array_chunk($returnArr,$certainNum,false);
        
        $keyArrNum = 0;

        foreach ($returnArr as $returnKeyArr) {
            $dataModelArr = $dataArray[$keyArrNum];

            foreach($returnKeyArr as $key) {
                if (array_key_exists($key,$dataModelArr)) {
                    $string = self::replace_to_Parameter($dataModelArr[$key], $string, "/\{\{.*?\}\}/ism");
                } else {
                    $string = self::replace_to_Parameter("<!---RollerPHP这里无参数--->", $string, "/\{\{.*?\}\}/ism");
                }
            }

            $keyArrNum++;
        }
        
        return $string;
    }

    private static function replace_to_Parameter($element, $string, $regular) {
        // $oldStr = "/\{\{.*?\}\}/ism";

        return preg_replace($regular,$element,$string,1);
    }

    /*********************   endView   ***********************/
}
