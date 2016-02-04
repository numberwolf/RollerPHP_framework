<?php
/**
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午8:06
 */

if(!defined('CHMOD_ROLLER'))            define('CHMOD_ROLLER',       TRUE);
/*框架目录*/
define('ROLLER_PATH',                   dirname(dirname(__FILE__)));
/*类、函数目录*/
define('LIB_PATH',                      ROLLER_PATH . '/Lib');
/*公用相同类库*/
define('Common_PATH',                   LIB_PATH . '/common');
/*核心文件目录*/
define('SYSTEM_PATH',                   ROLLER_PATH . '/System');
/*函数目录*/
define('FUNC_PATH',                     SYSTEM_PATH . '/functions');
/*框架核心类库文件目录*/
define('CLASSES_PATH',                  SYSTEM_PATH . '/classes');
/*配置文件目录*/
define('CONF_PATH',                     ROLLER_PATH . '/Configs');
/*控制器目录*/
define('CONT_PATH',                     ROLLER_PATH . '/Controller');
/*模型目录*/
define('MODELS_PATH',                   ROLLER_PATH . '/Models');
/*模板目录*/
define('TEMPLATES_PATH',	            ROLLER_PATH . '/Templates');
/*视图目录*/
define('VIEWS_PATH',	                ROLLER_PATH . '/Views');
/*db config*/
define('DB_CONFIG_NAME',                'db');

/* 过滤 */
if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value) {
        $value = is_array($value) ?
            array_map('stripslashes_deep', $value) :
            stripslashes($value);

        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

error_reporting(E_ALL ^ E_NOTICE);
ob_start(); // 缓冲池

header('content-type:text/html;charset=utf-8');
header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');

final class system {
    public static function start() {
        return self::load_class('app');
    }

    public static function load_config($configName ) {

        $file = CONF_PATH . '/' . $configName . '.php';

        if(!file_exists($file)){
            die('config file \'' .$configName. '\' is not exists!');
        }else{

            return include($file);
        }
    }/******** here *********/

    /***  数据库连接对象  ***/
    public static function load_pdo() {
        $db_config_arr = self::load_config(DB_CONFIG_NAME);
        $path = CLASSES_PATH.'/'.DB_CONFIG_NAME.'.class.php';

        include($path);

        $DBname = $db_config_arr['DBNAME'];
        $DBip = $db_config_arr['DBHOST'];
        $DBuser = $db_config_arr['DBUSER'];
        $DBpwd = $db_config_arr['DBPASS'];
        $DBCLASS = DB_CONFIG_NAME;

        return new $DBCLASS($DBname,$DBip,$DBuser,$DBpwd);
    }

    public static function load_class($className , $path='' , $init = 1) {
        if('' == $path) {
            $path = CLASSES_PATH;
        }
        $file = $path . '/' . $className . '.class.php';

        if(!file_exists($file)){
            die('class \'' . $className . '\' is not exists!');

        }else{

            include($file);

            if($init == 1){
                return new $className();
            }else{
                return true;
            }
        }
    }

    public static function load_model($modelName, $path = '') {
        if('' == $path) {
            $path = MODELS_PATH;
        }

        $file = $path . '/' . $modelName . '.class.php';

        if(!file_exists($file)) {
            die('model \'' . $modelName . '\' is not exists');
        } else {
            include($file);
            return new $modelName();
        }
    }


    /*** 渲染模板 ***/
    public static function load_tpl($tplName , $style = 'default') {

        $tplFile = TEMPLATES_PATH . '/' . $style . '/' . $tplName . '.tpl.php';

        if(!file_exists($tplFile) ){
            die('templates/' . $style . '/' . $tplName . '.tpl.php is not exists!');
        } else {
            return $tplFile;
        }
    }
    /*********************/


    public static function load_func($funcName , $path='') {
        if($path == '') {
            $path = FUNC_PATH;
        }
        $file = $path . '/' . $funcName . '.func.php';

        if(!file_exists($file)) {
            die('function \'' . $funcName . '\' is not exists!');
        }else{
            include($file);
        }
    }

    /*
     *
     *   分离渲染html   "{{.*}}"
     *
     */
    public static function drawViews($filename,$dataArray,$path = '') {
        if ($path == '') {
            $path = VIEWS_PATH;
        }
        $file = $path . '/' . $filename . '.html';

        $handle = fopen($file, 'r');
        $content = '';

        while(false != ($a = fread($handle, 8080))) {//返回false表示已经读取到文件末尾
            $content .= $a; // 获取html内容
        }
//        echo "test.html内容:".$content."<hr>";
        fclose($handle);
//        return $content;

        $KeyArr = self::getVal($content); // 获得html内所有key

//        var_dump($KeyArr);

        foreach($KeyArr as $key) {
            if (array_key_exists($key,$dataArray)) {
                $content = self::replace_to($dataArray[$key],$content);
            } else {
                $content = self::replace_to("null",$content);
            }
        }

        return $content;
    }

    // 得到key
    private static function getVal($string) {
        preg_match_all("/\{\{.*?\}\}/ism", $string, $outArr);

        $returnArr = array();

        foreach($outArr[0] as $val) {
            $val = str_replace("{{","",$val);
            $val = str_replace("}}","",$val);

            array_push($returnArr,$val);
        }

        return $returnArr;
    }

    private static function replace_to($element,$string) {
        $oldStr = "/\{\{.*?\}\}/ism";

        return preg_replace($oldStr,$element,$string,1);
    }

    public static function test() {
        echo "test system";
    }
}



