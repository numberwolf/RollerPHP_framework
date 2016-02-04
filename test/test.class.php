<?php
/*
 * 模板引擎
 */
final class test {
    function __construct() {

    }

    public function drawViews($htmlpath,$dataArray) {
        $handle = fopen($htmlpath, 'r');
        $content = '';
        while(false != ($a = fread($handle, 8080))){//返回false表示已经读取到文件末尾
            $content .= $a; // 获取html内容
        }
        echo "test.html内容:".$content."<hr>";
        fclose($handle);
//        return $content;

        $KeyArr = $this->getVal($content); // 获得html内所有key

        var_dump($KeyArr);

        foreach($KeyArr as $key) {
            if (array_key_exists($key,$dataArray)) {
                $content = $this->replace_to($dataArray[$key],$content);
            } else {
                $content = $this->replace_to("null",$content);
            }
        }

        return $content;
    }

    private function getVal($string) {
        preg_match_all("/\{\{.*?\}\}/ism", $string, $outArr);

        $returnArr = array();

        foreach($outArr[0] as $val) {
            $val = str_replace("{{","",$val);
            $val = str_replace("}}","",$val);

            array_push($returnArr,$val);
        }

        return $returnArr;
    }

    private function replace_to($element,$string) {
        $oldStr = "/\{\{.*?\}\}/ism";

        return preg_replace($oldStr,$element,$string,1);
    }
}




