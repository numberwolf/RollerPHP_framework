<?php
/**************************************************************************
 * Created by PhpStorm.
 * 入口文件
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 **************************************************************************/

define('rollerPHP' , dirname(__FILE__));
define('System' ,'/System');
include(rollerPHP . System . '/system.php');
system::start();
