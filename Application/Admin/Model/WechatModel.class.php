<?php
namespace Admin\Model;
use Think\Model;

class WechatModel extends Model {
    //protected $appid='wx09150f3513d6d05c';
    //protected $appsecret='02de467c9e45c4010fc65145902cb9e6';
    protected $tableName = 'wechat_session';
    //安全过期时间 微信官方默认为7200，这里做了1200的安全期
    protected $expires = 3600;

    /*
     * 获取微信access_token
     * @return string
     * */
    public function wx_access_token() {
        $timestamp = time();
        $ret = $this -> field(array(
            'val',
            'time'
        )) -> find(1);
        if ($timestamp - $ret['time'] > $this -> expires) {
            $access_token = self::wx_get_access_token();
            $this -> where(array('id' => 1)) -> save(array(
                'val' => $access_token,
                'time' => $timestamp
            ));
            return $access_token;
        } else {
            return $ret['val'];
        }
    }

    public function wx_get_access_token() {
        Vendor('WxpayAPI.lib.WxPayApi');
        Vendor('WxpayAPI.example.WxPayJsApi');
        Vendor('WxpayAPI.lib.WxPayConfig');
        Vendor('Wechat.HttpCurl');
        $appid=\WxPayConfig::APPID;
        $secret=\WxPayConfig::APPSECRET;
        //var_dump($appid);
        //var_dump($secret);
        //$wx_token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . \WxPayConfig::APPID . '&secret=' . \WxPayConfig::APPSECRET;
        $wx_token_url ="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $secret;
        //$wx_token_url ="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appid . "&secret=" . $this->appsecret;
        //var_dump($wx_token_url);
        $wx_return = file_get_contents($wx_token_url);
        //var_dump($wx_return);
        $wx_json = json_decode($wx_return);

        return $wx_json -> access_token;
    }
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
    /*
     * 获取微信ticket
     * @return string
     * */
    public function wx_ticket($access_token) {
        $timestamp = time();
        $ret = $this -> field(array(
            'val',
            'time'
        )) -> find(2);
        if ($timestamp - $ret['time'] > $this -> expires) {
            $ticket = self::wx_get_ticket($access_token);
            if(!empty($ticket)){
                $this -> where(array('id' => 2)) -> save(array(
                    'val' => $ticket,
                    'time' => $timestamp
                ));
                return $ticket;
            }
            return false;
        } else {
            return $ret['val'];
        }
    }

    public function wx_get_ticket($access_token) {
        $wx_ticket_url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $access_token . '&type=jsapi';
        $wx_return = file_get_contents($wx_ticket_url);
        $wx_json = json_decode($wx_return);
        return $wx_json -> ticket;
    }

    /*
     * JS签名config
     * @return array
     * */
    public function wx_get_sign_config($ticket = '', $access_token = '') {
        //appId
        //$config['appId'] = $this->appid;
        $config['appId'] = \WxPayConfig::APPID;
        //时间戳
        $config['timestamp'] = time();
        //随机字符串
        $config['nonceStr'] = substr(md5(uniqid() . rand(100, 100000)), 8, 16);

        //ticket
        if ($ticket == '') {
            $access_token = $access_token ? $access_token : self::wx_access_token();
            $ticket = self::wx_ticket($access_token);
        }
        if($ticket === false){
            return false;
        }
        //签名
        $signature_string = 'jsapi_ticket=' . $ticket . '&noncestr=' . $config['nonceStr'] . '&timestamp=' . $config['timestamp'] . '&url=' . get_url();
        $config['signature'] = sha1($signature_string);
        return $config;
    }

}
