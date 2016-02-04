<?php
/**
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午6:56
 */

// 配置默认入口
define('Home','Index');
define('Cont','index');
define('Meth','start');

// 配置数据库
define('DBTYPE','mysql');
define('DBNAME','');
define('DBHOST','127.0.0.1');
define('DBPORT','');
define('DBUSER','root');
define('DBPASS','porsche');
define('DBCHAR','utf8');
define('DBTbBG','');

return array(
    'DBTYPE' => DBTYPE,
    'DBPORT' => DBPORT,
    'DBHOST' => DBHOST,
    'DBUSER' => DBUSER,
    'DBPASS' => DBPASS,
    'DBNAME' => DBNAME,
    'DBCHAR' => DBCHAR,
    'DBTbBG' => DBTbBG
    );


