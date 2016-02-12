<?php
/*
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 * APACHE 2.0 LICENSE
 * Copyright [2016] [Chang Yanlong]

 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.

 */

// namespace Models\Mysql\hello;
system::load_class('db' , '' , 0);

class hello extends db{
	public $PDO_OBJ = null;

	public function __construct() {
		$this->PDO_OBJ = system::load_pdo('', true); // 当为true时候打开memcache缓存
		echo "数据模型实例,已开启缓存";
	}

	public function search() {

		$ResArr = $this->PDO_OBJ->select_Tab('test')->select_Obj('*')->search_command();
		// var_dump($ResArr);

		return $ResArr;
	}
}
