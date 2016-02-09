<?php

/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 * memcached 
 * APACHE 2.0 LICENSE
 **************************************************************************/

final class memcacheClass
{
	private static $memcache = null;
	
	public static function init($port = 11111)
	{
		self::$memcache = new Memcache;
		$res = self::$memcache->connect("127.0.0.1", $port); //连接Memcache服务器

		if (!$res || $res == false) {
			die('<h1>RollerPHP:memcached连接失败</h1>');
		}
	}

	public static function setMemCache($value , $time = 1000) {

		return self::$memcache->set($key, $value, 0, $time); // 默认缓存时间为1000s
	}

	public static function getMemCache($key) {

		return self::$memcache->get($key);
	}
}

