<?php
/**
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午8:07
 */

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

        if(!is_dir($module)) die('controller \'' . $route_home . '\' is not dir!');

        if(!file_exists($controller)){
            die('controller \'' . $route_control . '\' is not defined!');

        }else{

            include($controller); 
            $ctrl = new $route_control(); 


            if(!method_exists($ctrl , $route_method)){
                die('action \'' . $route_method . '\' is not defined!');
            }else{
                return $ctrl->$route_method(); 
            }
        }
    }
}
