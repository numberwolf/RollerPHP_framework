<?php

/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 * 这是一个控制器例子
 * APACHE 2.0 LICENSE
 * Copyright [2016] [Chang Yanlong]

 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0
 **************************************************************************/
namespace Controller\Test;

if(!defined('CHMOD_ROLLER')) exit('权限不足!');

class test {

    public function __construct() {
        // echo __METHOD__;
    }

    public function test_cont() {
        echo __METHOD__;
    }
}
?>
