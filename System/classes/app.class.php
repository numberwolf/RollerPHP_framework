<?php
/**
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午8:07
 */

// 模板引擎应该在这里引入
class app{
    private $router;
    private $database;

    public function __construct(){
        $this->router = system::load_config('config');
        $this->init();
    }
    public function init(){
        //// Controller
        // 选取目录Home(Index默认)
        $route_home = preg_match('/^[a-z]/' , $_GET['m']) ? $_GET['m'] : $this->router['Home'];

        // 选取页面Controller
        $route_control = preg_match('/^[a-z]/' , $_GET['c']) ? $_GET['c'] : $this->router['Cont'];

        // 选取方法Method
        $route_method = preg_match('/^[a-z]/' , $_GET['a']) ? $_GET['a'] : $this->router['Meth'];

        $module = CONT_PATH . '/' . $route_home;
        $controller = $module . '/' . $route_control . '.php';

        if(!is_dir($module)) die('modules \'' . $route_home . '\' is not dir!');

        if(!file_exists($controller)){
            die('controller \'' . $route_control . '\' is not defined!');
        }else{
            include($controller); // include模板php
            $ctrl = new $route_control(); // 新建模板目录下面的类
            if(!method_exists($ctrl , $route_method)){
                die('action \'' . $route_method . '\' is not defined!');
            }else{
                return $ctrl->$route_method(); // 执行route_method方法 默认init
            }
        }
    }
}
