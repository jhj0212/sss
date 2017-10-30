<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 2017/8/16
 * Time: 上午9:49
 */

class WechatOauth{
    /**
     * 获取微信授权临时code，有效时间5分钟
     * $scope 默认显示授权页面，如不显示需要传入snsapi_base
     *
    **/
    function Code($appid,$url,$scope = 'snsapi_userinfo',$state='123')
    {
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$url."&response_type=code&scope=".$scope."&state=".$state."#wechat_redirect";
        return $url;
    }
    /**
     * 获取微信授权用户的openid，默认获取用户全部信息
     * 当scope传入的值snsapi_base，直接获取用户的openid
    **/
    function Openid($appid,$secret,$code,$scope="snsapi_userinfo")
    {
        //获取临时access_token
        $access_token = $this->Access_token($appid,$secret,$code);
        $token = $access_token['access_token'];
        $openid = $access_token['openid'];
        if($scope=="snsapi_userinfo"){
            //获取用户全部信息
            $userinfo =$this->Userinfo($token,$openid);

        }else{
            $userinfo = $openid;
        }
        return $userinfo;

    }
    /**
     * 获取微信授权用户的临时Access_token 不需要存储
     **/
    function Access_token($appid,$secret,$code)
    {
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code";
        $httpcurl = new HttpCurl();
        $res = $httpcurl->http_curl($url);
        return $res;
    }
    /**
     * 获取授权用户的全部信息，scope必须是snsapi_base 否则不会显示全部数据
     **/
    function Userinfo($access_token,$openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $httpcurl = new HttpCurl();
        $res = $httpcurl->http_curl($url);
        return $res;

    }
}