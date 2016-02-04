<?php
/**************************************************************************
 * Created by PhpStorm.
 * User: Wolf
 * Date: 16-2-4
 * Time: 下午7:32
 * 入口文件
 * 作者：常炎隆
 * Email：porschegt23@foxmail.com
 **************************************************************************/

define('rollerPHP' , dirname(__FILE__));
define('System' ,'/System');
include(rollerPHP . System . '/system.php');
system::start();
