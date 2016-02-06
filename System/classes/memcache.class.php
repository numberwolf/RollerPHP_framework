<?php

/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 **************************************************************************/

final class memcacheClass
{
	private static $memcache = null;
	
	public static function init($port = 11111)
	{
		self::$memcache = new Memcache;
		$res = self::$memcache->connect("127.0.0.1", $port); //连接Memcache服务器

		if (!$res || $res == false) {
			die('please install memcached!');
		}
	}

	public static function setMemCache($value , $time = 1000) {
		if (self::$memcache != null || self::$memcache) {
			return self::$memcache->set($key, $value, 0, $time); // 默认缓存时间为1000s
		} else {
			return false;
		}
		
	}

	public static function getMemCache($key) {
		if (self::$memcache != null || self::$memcache) {
			return self::$memcache->get($key);
		} else {
			return false;
		}
	}

	// final public function releaseMemCache() {

	// 	unset($this->memcache);
	// 	$this->memcache = null;
	// }
}

