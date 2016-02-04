<?php
/**
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午7:32
 * 入口文件
 */

define('rollerPHP' , dirname(__FILE__));
define('System' ,'/System');
include(rollerPHP . System . '/system.php');
system::start();