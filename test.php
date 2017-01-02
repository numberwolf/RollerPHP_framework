<?php 
// echo $_SERVER["REMOTE_ADDR"];
// echo "<br>";
// echo $_COOKIE['TOKEN'];

// echo '<br>'.time();
// $sql = 'select * from title where title_name="dsadas"';
// echo mysql_escape_string($sql);

//$conn = null;
//try {
//	$conn = new PDO("mysql:host=127.0.0.1;dbname=ME;",'root','porsche');
//	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//	$conn->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
//	$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//
//} catch (PDOException $e) {
//	die("connect fail!".$e->getMessage());
//}
//try {
//	$conn->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
//	$conn->beginTransaction();
//	$res = $conn->exec("insert into test value(1000,4,'2111')");
//	var_dump($res);
//	echo "<hr>";
//
//
//	$sql_query = $conn->query("select * from test");
//	$returnArr = $sql_query->fetchAll(PDO::FETCH_ASSOC);
//	var_dump($returnArr);
//	echo "<hr>".count($returnArr)."<hr>";
//
//	$conn->rollBack();
//	$conn->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
//
//	$sql_querys = $conn->query("select * from test");
//	$returnArrs = $sql_querys->fetchAll(PDO::FETCH_ASSOC);
//	var_dump($returnArrs);
//	echo "<hr>".count($returnArrs)."<hr>";
//
//} catch(PDOException $ex) {
//	$conn->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
//	var_dump($ex);
//}
// try 
// { 
// 	$conn->query('set names utf8');

// 	$conn->beginTransaction(); 

// 	for($i=0; $i<1000000; $i++) 
// 	{ 
// 		$conn->exec("insert into test values(null,'$i','$i')"); 
// 	} 
// 	$conn->commit(); 
// } 
// catch(PDOException $ex) 
// { 
// 	$conn->rollBack(); 
// 	echo 'error:'.$i.'<br>';
// }
//$_SERVER['HTTP_HOST'].
echo $_SERVER['REQUEST_URI'];




