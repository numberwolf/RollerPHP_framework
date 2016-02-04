<?php
/**
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午8:06
 */

/*框架目录*/
define('ROLLER_PATH',       dirname(dirname(__FILE__)));
/*类、函数目录*/
define('LIB_PATH',          ROLLER_PATH . '/lib');
/*公用相同类库*/
define('LIB_PATH',          LIB_PATH . '/common');
/*核心文件目录*/
define('SYSTEM_PATH',       ROLLER_PATH . '/System');
/*函数目录*/
define('FUNC_PATH',         SYSTEM_PATH . '/functions');
/*框架核心类库文件目录*/
define('CLASSES_PATH',      SYSTEM_PATH . '/classes');
/*配置文件目录*/
define('CONF_PATH',         ROLLER_PATH . '/Configs');
/*控制器目录*/
define('MODULES_PATH',      ROLLER_PATH . '/Controllers');
/*模型目录*/
define('MODELS_PATH',       ROLLER_PATH . '/models');
/*模板目录*/
define('TEMPLATES_PATH',	ROLLER_PATH . '/Templates');

if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value)
    {
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
ob_start();

header('content-type:text/html;charset=utf-8');
header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');

class system {
    public static function init_app(){
        return self::load_class('app');
    }
    public static function load_config($configName , $path=''){
        if('' == $path) $path = CONF_PATH;
        $file = $path . '/' . $configName . '.php';
        if(!file_exists($file)){
            die('config file \'' .$configName. '\' is not exists!');
        }else{
            return include($file);
        }
    }
    public static function load_class($className , $path='' , $init = 1){
        if('' == $path) $path = CLASSES_PATH;
        $file = CLASSES_PATH . '/' . $className . '.class.php';
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
    public static function load_model($modelName){
        $file = MODELS_PATH . '/' . $modelName . '.class.php';
        if(!file_exists($file)){
            die('model \'' . $modelName . '\' is not exists');
        }else{
            include($file);
            return new $modelName();
        }
    }


    /*** 这个方法不要 ***/
    public static function load_view($tplName , $style = 'default'){
        $tplFile = TEMPLATES_PATH . '/' . $style . '/' . $tplName . '.tpl.php';
        if(!file_exists($tplFile)){
            die('templates/' . $style . '/' . $tplName . '.tpl.php is not exists!');
        }else{
            return $tplFile;
        }
    }
    /*********************/


    public static function load_func($funcName , $path=''){
        if($path == '') $path = FUNC_PATH;
        $file = $path . '/' . $funcName . '.func.php';
        if(!file_exists($file)){
            die('function \'' . $funcName . '\' is not exists!');
        }else{
            include($file);
        }
    }
}



