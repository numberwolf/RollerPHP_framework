<?php
/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 * APACHE 2.0 LICENSE
 * http://www.apache.org/licenses/LICENSE-2.0 
 **************************************************************************/

if(!defined('CHMOD_ROLLER'))            define('CHMOD_ROLLER',       TRUE);

/*框架目录*/
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
define('TEMPLATES_PATH',	            ROLLER_PATH . '/'.TEMPLATES_NAME);
/*视图目录*/
define('VIEWS_PATH',	                ROLLER_PATH . '/'.VIEWS_NAME);
/*PDO数据库操作 config*/
define('DB_CONFIG_NAME',                'db');


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
ob_start();

// $PHP_SELF = $_SERVER['PHP_SELF'];
// $url = 'http://'.$_SERVER['HTTP_HOST'].substr($PHP_SELF,0,strrpos($PHP_SELF,'/')+1);

header('content-type:text/html;charset=utf-8');
header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');

final class system {

    private static $RootPath_URL = null;

    public static function init() {
        // echo PROJECT_NAME;

        return self::load_class('app');
    }

    public static function load_config($configName ) {

        $file = CONF_PATH . '/' . $configName . '.php';

        if(!file_exists($file)){
            die('<h1>RollerPHP:配置文件 \'' .$configName. '\' 不存在</h1>');
        }else{

            return include($file);
        }
    }

    public static function load_storage($fileName) {
        return 'http://'.$_SERVER['HTTP_HOST'].'/'.PROJECT_NAME.'/'.SOTRAGE_NAME.'/'.$fileName;
    }

    public static function load_pdo($database = '' ,$memSwitch = false ,$memName = 'memcache' ,$memPath = '') {

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

        return new $DBCLASS($DBname, $DBip, $DBuser, $DBpwd, $memSwitch, $memName, $memPath);
    }

    public static function load_class($className , $path='' , $init = 1) {
        if('' == $path) {
            $path = CLASSES_PATH;
        }
        $file = $path . '/' . $className . '.class.php';

        if(!file_exists($file)){
            die('<h1>RollerPHP:class \'' . $className . '\' 不存在</h1>');

        }else{

            include($file);

            if($init == 1){
                return new $className(); // include , new
            }else{
                return true; // include
            }
        }
    }

    public static function load_model($modelName, $path = '') {
        if('' == $path) {
            $path = MODELS_PATH;
        }

        $file = $path . '/' . $modelName . '.model.php';

        if(!file_exists($file)) {
            die('<h1>RollerPHP:model \'' . $modelName . '\' 不存在</h1>');
        } else {
            include($file);
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



    public static function load_func($funcName , $path='') {
        if($path == '') {
            $path = FUNC_PATH;
        }
        $file = $path . '/' . $funcName . '.func.php';

        if(!file_exists($file)) {
            die('<h1>RollerPHP:function \'' . $funcName . '\' 不存在</h1>');
        }else{
            include($file);
        }
    }

    /***********
     ***********
     渲染视图引擎  采用{{.*}}
     ************
     ************/
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

        fclose($handle);
        /**  路径 **/
        $content = self::returnMeth($content);
        $content = self::returnCont($content);
        $content = self::returnHome($content);

        /**  值 **/
        $content = self::getVal($content,$dataArray); // 获得html内所有key

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
            $content = str_replace('____'.$value.'____', '&Meth='.$value, $content);
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
            $content = str_replace('___'.$value.'___/', '&Cont='.$value, $content);
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
            $rootPath = dirname(ROLLER_PATH);

            $rootPath = str_replace($rootPath,"",ROLLER_PATH);
            $content = str_replace('__'.$value.'__/', $rootPath.'/?Home='.$value, $content);
        }

        return $content;
    }

    // 得到key
    private static function getVal($string,$dataArray) {
        preg_match_all("/\{\{.*?\}\}/ism", $string, $outArr);

        $returnArr = array();

        foreach ($outArr as $tempArr) {
            foreach($tempArr as $val) {
                $val = str_replace("{{","",$val);
                $val = str_replace("}}","",$val);

                array_push($returnArr,$val);
            }
        }

        foreach($returnArr as $key) {
            if (array_key_exists($key,$dataArray)) {
                $string = self::replace_to_Parameter($dataArray[$key], $string, "/\{\{.*?\}\}/ism");
            } else {
                $string = self::replace_to_Parameter("<!---RollerPHP这里无参数--->", $string, "/\{\{.*?\}\}/ism");
            }
        }
        
        return $string;
    }

    private static function replace_to_Parameter($element, $string, $regular) {
        // $oldStr = "/\{\{.*?\}\}/ism";

        return preg_replace($regular,$element,$string,1);
    }

    /*********************   endView   ***********************/
    public static function test() {
        echo "test system";
    }
}
