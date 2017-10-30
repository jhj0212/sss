<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 2017/8/16
 * Time: 上午9:44
 */
class HttpCurl{
        /**
         * http_curl get,post 提交方式
         **/
        function http_curl($url,$data=null)
        {
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
            if(!empty($data)){
                curl_setopt($ch,CURLOPT_POST,true);
                curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            }
            $res = curl_exec($ch);
            curl_close($ch);
            $res = json_decode($res,true);
            return $res;

        }

}