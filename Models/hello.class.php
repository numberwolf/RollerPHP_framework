<?php
/**
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午10:56
 */

// namespace Models\Mysql\hello;
system::load_class('db' , '' , 0);

class hello extends db{
	public $PDO_OBJ = null;

	public static function testModel() {
		return array('hello' => 'world', 'name' => 'myname', 'sex' => 'boy' );
	} 

	public function __construct(){
		$this->PDO_OBJ = system::load_pdo();
		echo "数据模型实例";
	}
} 