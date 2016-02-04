<?php
/**
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午7:01
 */
// 控制器
if(!defined('IN_GOODPHP')) exit('No permission to access!');
class index{
    public function __construct(){

    }
    public function init(){
        echo "欢迎使用GOODPHP框架";
    }
    public function view(){
        $title = '欢迎使用GOODPHP框架';
        $content = '这是一个模板调用案例';
        include good::load_view('index');
    }
    public function model(){
        $db = good::load_model('test');
        if( $db->delete('`catid` > \'10\'')){
            echo 'ok';
        }else{
            echo 'no';
        }
    }
    public function func(){
        test();
    }

    public function hello (){
        echo "hello world";
    }
}
?>
