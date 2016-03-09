<?php

/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 * memcached 
 * APACHE 2.0 LICENSE
 * Copyright [2016] [Chang Yanlong]

 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

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

