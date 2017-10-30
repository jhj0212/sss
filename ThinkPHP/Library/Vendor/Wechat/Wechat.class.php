<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 2017/8/16
 * Time: 上午10:05
 *
 */
class Wechat{
    /**
     * 获取微信用户Access_token，有效时间7200秒
     *获取Access_token并保存到根目录access_token.json
     *
     **/
    function Access_token($appid,$appsecret)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        $data = json_decode(trim(file_get_contents("access_token.json")));
        if($data->expire_time <time()){
            $httpcurl = new HttpCurl();
            $access_token = $httpcurl->http_curl($url)['access_token'];
            if($access_token){
                $data->expire_time = time()+7000;
                $data->access_token = $access_token;
                $fp = fopen("access_token.json", "w");
                fwrite($fp, "" . json_encode($data));
                fclose($fp);
            }
        }else{
            $access_token = $data->access_token;
        }
        return $access_token;
    }

}