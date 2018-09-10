<?php



require_once ("../autoload.php");
//define("SDK_PATH",__DIR__);
//include_once (SDK_PATH."/../src/WxBase/WeixinBase.php");
$base = require_once ("config.php");

//var_dump($base);

use birksCha\wxbase\WeixinBase;

//$sss = new \birksCha\wxbase\WeixinBase();

$wxBase = WeixinBase::instance($base);


//$accessToke = $wxBase->get_access_token($base['appId'],$base['appSecret']);
//$accessToke = $wxBase->get_access_token();
$param = [
    'access_token' => $base['access_token'],
    'begin_date'=> "2018-08-01",
    'page'=> "choujiang_page/fuli_xq/fuli_xq",
    'scene'=> "fe55",
    'end_date'=> "2018-09-01",
];
$accessToke = $wxBase->get_wxa_code($param);

//header('Content-Type: image/jpeg');

echo $accessToke;
exit;
echo 5555;