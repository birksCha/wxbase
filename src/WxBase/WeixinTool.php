<?php
/**
 * WeixinController 获取微信接口信息控制器
 * author hhz 2017.10.12
 */
namespace birksCha\wxbase;


class WeixinTool {

    /**
     * curl提交数据
     * @param $url
     * @param array $data
     * @param int $timeout
     * @return mixed
     */
    public function curl_data($url,$data=[],$timeout=30,$useCert=[])
    {
        $ch = curl_init();
        //取数据的地址
        curl_setopt($ch, CURLOPT_URL, $url);
        //传输为post
        curl_setopt($ch, CURLOPT_POST, true);

        //是否提交普通商户证书
        if( isset($useCert['pt']) && $useCert['pt'] == true){
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLCERT, $useCert['sslcert_path']);
            curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLKEY, $useCert['sslkey_path']);
        }

        //是否提交企业商户证书
        if( isset($useCert['is_post']) && $useCert['is_post'] == true ){
            if($useCert['qy']){
                $sslcert = $useCert['qy']['sslcert_path'];
                $sslkey = $useCert['qy']['sslkey_path'];
            }else{
                $sslcert = $useCert['sslcert_path'];
                $sslkey = $useCert['sslkey_path'];
            }
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLCERT, $sslcert);
            curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLKEY, $sslkey);
        }
        //传输数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //隐藏返回结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //限制时间
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        //https支持
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
        //执行
        $handles = curl_exec($ch);
        //断开
        curl_close($ch);

        return $handles;
    }
}