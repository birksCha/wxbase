<?php
define("SDK_PATH",__DIR__);

spl_autoload_register(function ($class) {
//    if (false !== stripos($class, '\\\\WxPay\\\\')||false !== stripos($class, '\\\\Lib\\\\')) {
    //echo DIRECTORY_SEPARATOR;
//    var_dump($class);
    preg_match("/\\\wxbase\\\/",$class,$lib);
    if ( !empty($lib) ) {
        $path = SDK_PATH.DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."WxBase";
        //$path = SDK_PATH."/src/WxPay/Native";
        $files = scandir($path);
//        var_dump($files);
        foreach($files as $k => $v){
            if($v != "." && $v != ".."){
                $class_path = $path.DIRECTORY_SEPARATOR.$v;
//                echo $class_path;
                if(!is_file($class_path)){
                    continue;
                }
                require_once $class_path;
            }
        }
    }
});