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

    public function __construct(){
        $this->router = good::load_config('router');
        $this->init();
    }
    public function init(){
        $router_m = preg_match('/^[a-z]/' , $_GET['m']) ? $_GET['m'] : $this->router['router_m']; // 选取模板目录
        $router_c = preg_match('/^[a-z]/' , $_GET['c']) ? $_GET['c'] : $this->router['router_c']; // 选取模板页面
        $router_a = preg_match('/^[a-z]/' , $_GET['a']) ? $_GET['a'] : $this->router['router_a']; // 选取模板方法
        $module = MODULES_PATH . '/' . $router_m;
        $controller = $module . '/' . $router_c . '.php';
        if(!is_dir($module)) die('modules \'' . $router_m . '\' is not dir!');
        if(!file_exists($controller)){
            die('controller \'' . $router_c . '\' is not defined!');
        }else{
            include($controller); // include模板php
            $ctrl = new $router_c(); // 新建模板目录下面的类
            if(!method_exists($ctrl , $router_a)){
                die('action \'' . $router_a . '\' is not defined!');
            }else{
                return $ctrl->$router_a(); // 执行router_a方法 默认init
            }
        }
    }
}
