<?php
/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 **************************************************************************/

final class app {
    private $router;
    private $database;

    public function __construct(){
        $this->router = system::load_config('config');
        $this->init();
    }

    public function init(){

        //// Controller
        // 选取目录Home(Index默认)
        $route_home = preg_match('/^[a-z]/' , $_GET['Home']) ? $_GET['Home'] : $this->router['Home'];

        // 选取页面Controller
        $route_control = preg_match('/^[a-z]/' , $_GET['Cont']) ? $_GET['Cont'] : $this->router['Cont'];

        // 选取方法Method
        $route_method = preg_match('/^[a-z]/' , $_GET['Meth']) ? $_GET['Meth'] : $this->router['Meth'];

        $module = CONT_PATH . '/' . $route_home;
        $controller = $module . '/' . $route_control . '.php';

        if(!is_dir($module)) die('<h1>RollerPHP: \'' . $route_home . '\' 找不到</h1>');

        if(!file_exists($controller)){
            die('<h1>RollerPHP:控制器文件 \'' . $route_control . '\' 找不到!');

        }else{

            include($controller);
            $ctrl = new $route_control();


            if(!method_exists($ctrl , $route_method)){
                die('<h1>RollerPHP: \'' . $route_method . '\' 未定义</h1>');
            }else{
                $dataArr = array();

                foreach ($_GET as $key => $value) {
                    if ($key != 'Home' && $key != 'Cont' && $key != 'Meth') {
                        array_push($dataArr, $value);
                    }
                }

                if ($_POST) {
                    foreach ($_POST as $key => $value) {
                        array_push($dataArr, $value);
                    }
                }

                /**
                 **参数以数组形式
                 **/
                return $ctrl->$route_method($dataArr);
            }
        }
    }
}
