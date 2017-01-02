<?php
/**************************************************************************
 * Created by PhpStorm.
 * 入口文件
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 * APACHE 2.0 LICENSE
 * Copyright [2016] [Chang Yanlong]

 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 **************************************************************************/

define('RollerPHP' , dirname(__FILE__));
define('System' ,'/System');
define(
    'URL_HEAD',
    $_SERVER['REQUEST_URI']
);
  
$RollerBootstrap = new Roller();
$RollerParams = $RollerBootstrap->sayroute(URL_HEAD);

include(RollerPHP . System . '/system.php');
\RSystem\system::init();

