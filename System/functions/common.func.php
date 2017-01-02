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

function filterParameter($char){
    $m = $char;//令$m等于字符串，如果没有非法字符的话就返回这个字符串
    $len = strlen($char);//计算字符串的长度
    $array = array();
    for($i=0 ; $i<$len ; $i++){
        $array[] = substr($char, $i, 1);
        //echo $array[$i].',';
    }
    foreach($array as $u){
        //需要过滤掉的字符
        if($u == "'" || $u == '"' || $u == '(' || $u == ')' || $u == " " || $u == "<" || $u == "/" || $u == "%" || $u == "?"){
        	
        	return false;
            exit();
        }else{
            continue;
        }
    }
    // 如果字符串是合法的话便返回原值
    return $m;
}
