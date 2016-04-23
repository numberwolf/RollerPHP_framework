<?php
/*
 *	2015/9/12 20:08
 *	常炎隆
 *	email:porschegt23@qq.com
 */
//namespace api\sqlClass;

class api_sql{

	// private $DBname = 'app_smartki';
	// private $DBip = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
	// private $DBuser = SAE_MYSQL_USER;
	// private $DBpwd = SAE_MYSQL_PASS;

	private $DBname = null;
	private $DBip = null;
	private $DBuser = null;
	private $DBpwd = null;

	private $TabName = null;
	private $object_str = null;
	private $where_str = null;
	private $other_Str = null;
	private $newObj_str = null;
	private $sql_str = null;
	
	// 连接数据库
	function __construct($DBname,$DBip,$DBuser,$DBpwd){
		$this->DBname = $DBname;
		$this->DBip = $DBip;
		$this->DBuser = $DBuser;
		$this->DBpwd = $DBpwd;

		$q = mysql_connect($this->DBip, $this->DBuser, $this->DBpwd);

		if(!$q){
		    die('Could not connect: ' . mysql_error());
		}

		mysql_query('set names utf8'); //以utf8读取数据
		mysql_select_db($this->DBname,$q); //数据库
	}

	// 设置数据表名
	public function select_Tab($TabName){
		// $TabName = strval($TabName);
		$this->TabName = $TabName;
		return $this;
	}

	// 设置sql执行的对象
	public function select_Obj($object_str){
		// $object_str = strval($object_str);
		$this->object_str = $object_str;
		return $this;
	}

	public function select_Where($where_str){
		// $where_str = strval($where_str);
		$this->where_str = ' WHERE '.$where_str.' ';
		return $this;
	}

	// 补充的其他sql语句
	public function select_other($other_Str){
		// $other_Str = strval($other_Str);
		$this->other_Str = ' '.$other_Str.' ';
		return $this;
	}

	// 设置新对象
	public function set_newObj($newObj_str){
		// $newObj_str = strval($newObj_str);
		$this->newObj_str = $newObj_str;
		return $this;
	}

	private function do_sql_query($sqlstr){
		$sql_query = mysql_query($sqlstr);
		unset($this->sql_str);
		unset($this->where_str);
		unset($this->other_Str);
		unset($this->object_str);
		unset($this->TabName);

		if ($sql_query == true) {
			return array('pass' => 'true');
		}else{
			return array('pass' => 'false');
		}
	}

	// 查
	public function search_command(){
		$this->sql_str = "SELECT $this->object_str FROM $this->TabName".$this->where_str.$this->other_Str;

		$sql_query = mysql_query($this->sql_str);
		$returnArr = array();

		if(is_resource($sql_query)){
			while($result_text = mysql_fetch_assoc($sql_query)){
			 	array_push($returnArr,$result_text);
			}
		}

		// 如果不释放的话就会占满空间，无法进行新建一个类中一个函数内两次调用此方法
		unset($this->sql_str);
		unset($this->where_str);
		unset($this->other_Str);
		unset($this->object_str);
		unset($this->TabName);

		return $returnArr;
	}

	// 改
	public function update_command(){
		$this->sql_str = "UPDATE $this->TabName SET $this->object_str = $this->newObj_str $this->where_str";

		return $this->do_sql_query($this->sql_str);
	}

	// 删
	public function del_command(){
		$this->sql_str = "DELETE FROM $this->TabName $this->where_str";

		return $this->do_sql_query($this->sql_str);
	}

	// 增
	public function insert_command(){
		$this->sql_str = 'INSERT INTO '.$this->TabName.'('.$this->object_str.') values('.$this->newObj_str.')';

		return $this->do_sql_query($this->sql_str);
	}
}


