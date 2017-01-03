<?php
/**************************************************************************
 * Created by PhpStorm.
 * 作者：NumberWolf
 * Email：porschegt23@foxmail.com
 * APACHE 2.0 LICENSE
 * Copyright [2016] [Chang Yanlong]

 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

 **************************************************************************/
/*
 * 配置是否在url中展示项目名
 * 如果不展示的话则为true，其他则需要在rewrite中配置了
 * 例如nginx中:rewrite ^/(.*?)$ /RollerPHP_framework/index.php?/$1 last;
 */
define('UNSHOW_PRONAME', false);
return array(
    'URL_MODEL' => '2', 
    );
