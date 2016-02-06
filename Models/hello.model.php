<?php
/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 **************************************************************************/

// namespace Models\Mysql\hello;
system::load_class('db' , '' , 0);

class hello extends db{
	public $PDO_OBJ = null;

	public function __construct() {
		$this->PDO_OBJ = system::load_pdo('', true);
		echo "数据模型实例";
	}

	public function search() {

		$ResArr = $this->PDO_OBJ->select_Tab('test')->select_Obj('*')->search_command();
		// var_dump($ResArr);

		return $ResArr;
	}
}
